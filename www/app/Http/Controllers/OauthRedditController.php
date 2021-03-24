<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*
 *
 * reddit auth2
 * https://github.com/reddit-archive/reddit/wiki/OAuth2
 *
 */
class OauthRedditController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function oauthRedditCallback()
    {
        // url to reddit and callback
        $my_state = bin2hex(random_bytes(10));
        $reddit_url_parts = [
            'client_id'     => env('OAUTH_REDDIT_CLIENT_ID'),
            'redirect_uri'  => env('OAUTH_REDDIT_REDIRECT_URI'),
            'scope'         => env('OAUTH_REDDIT_SCOPE'),
            'response_type' => 'code',
            'state'         => $my_state,
        ];

        $redit_url = "https://www.reddit.com/api/v1/authorize?".http_build_query($reddit_url_parts);

        return redirect($redit_url);
    }

    public function oauthReddit()
    {
        // comeback from reddit and get a request data to form a url
        $data = request()->all();
        $reddit_url_parts = [
            'client_id'     => env('OAUTH_REDDIT_CLIENT_ID'),
            'redirect_uri'  => env('OAUTH_REDDIT_REDIRECT_URI'),
            'scope'         => env('OAUTH_REDDIT_SCOPE'),
            'code'          => $data['code'],
            'state'         => $data['state'],
            'grant_type'    => 'authorization_code',
        ];

        // ask for a token
        $redit_url = "https://www.reddit.com/api/v1/access_token?".http_build_query($reddit_url_parts);
        $response = Http::withBasicAuth(env('OAUTH_REDDIT_CLIENT_ID'), env('OAUTH_REDDIT_CLIENT_SECRET'))
            ->post($redit_url);

        // if not 200 ERROR
        if (!$response->ok()){
            return redirect()->route('login')
                ->withErrors(['fail' => 'reddit login fail']);
        }

        // get a token
        $token = json_decode($response->body(), 'assoc');

        // go to the api with that token
        // get a user
        $response_username = Http::withHeaders(['Authorization' => 'bearer '.$token['access_token']])
            ->get('https://oauth.reddit.com/api/v1/me');
        $user = json_decode($response_username->body(), 'assoc');

        $credentials = [
            'name'     => $user['name'],
            'email'    => "SUPER_PLACEHOLDER@mail.com",
            'password' => 'IF_YOU_WILL_NOT_$@#%ing_CHANGE_THIS_YOU_WILL_LITERALY_SHIT_YOURSELF_DONT_U_DARE_TO_IGNORE_THIS!',
        ];

        // register or login the user
        // check if unique
        if (User::where('name', '=', $credentials['name'])
            ->exists()) {
                if (Auth::attempt($credentials)) {
                    return redirect()->route('home')
                        ->with('status', "A user \"{$credentials['name']}\" has successfully logedin using reddit");
                }
                return redirect()->route('login')->withErrors(['fail'
                    => 'Somethig went wrong!']);
        }

        // create a new user using reddit data
        $user = new User;
        $user ->name     = $credentials['name'];
        $user ->email    = $credentials['email'];
        $user ->password = Hash::make($credentials['password']);
        $user ->save();

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')
                ->with('status', "A user \"{$credentials['name']}\" has been created");
        }
    }
}
