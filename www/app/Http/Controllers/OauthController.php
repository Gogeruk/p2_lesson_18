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
 * github auth2
 * https://docs.github.com/en/developers/apps/authorizing-oauth-apps
 *
 */
class OauthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function oauthCallback()
    {
        // url to github and callback
        $my_state = bin2hex(random_bytes(10));
        $git_url_parts = [
            'client_id'    => env('OAUTH_CLIENT_ID'),
            'redirect_uri' => env('OAUTH_REDIRECT_URI'),
            'scope'        => env('OAUTH_SCOPE'),
            'state'        => $my_state,
        ];

        $git_url = "https://github.com/login/oauth/authorize?".http_build_query($git_url_parts);

        return redirect($git_url);
    }

    public function oauth()
    {
        // comeback from github and get a request data to form a url
        $data = request()->all();
        $git_url_parts = [
            'client_id'     => env('OAUTH_CLIENT_ID'),
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
            'redirect_uri'  => env('OAUTH_REDIRECT_URI'),
            'scope'         => env('OAUTH_SCOPE'),
            'code'          => $data['code'],
            'state'         => $data['state'],
        ];

        // ask for a token
        $git_url = "https://github.com/login/oauth/access_token?".http_build_query($git_url_parts);
        $response = Http::post($git_url);

        // if not 200 ERROR
        if (!$response->ok()){
            return redirect()->route('login')
                ->withErrors(['fail' => 'Github login fail']);
        }

        // get a token
        $data = [];
        parse_str($response->body(), $data);

        // go to the api with that token
        // get a user
        $response_user = Http::withHeaders(['Authorization' => 'token '.$data['access_token']])
            ->get('https://api.github.com/user');

        // get an email(s)
        $response_email = Http::withHeaders(['Authorization' => 'token '.$data['access_token']])
            ->get('https://api.github.com/user/emails');

        $credentials = [
            'name'     => json_decode($response_user->body(), 'assoc')['login'],
            'email'    => json_decode($response_email->body(), 'assoc')[0]['email'],
            'password' => 'IF_YOU_WILL_NOT_$@#%ing_CHANGE_THIS_YOU_WILL_LITERALY_SHIT_YOURSELF_DONT_U_DARE_TO_IGNORE_THIS!',
        ];

        // register or login the user
        // check if unique
        if (User::where('email', '=', $credentials['email'])
            ->orwhere('name',    '=', $credentials['name'])
            ->exists()) {
                if (Auth::attempt($credentials)) {
                    return redirect()->route('home')
                        ->with('status', "A user \"{$credentials['name']}\" has successfully logedin using github");
                }
                return redirect()->route('login')->withErrors(['fail'
                    => 'Username and/or Email already exist, but they do not belong to the same user (DO YOU WANT TO ...?)']);
        }

        // create a new user using github data
        $user = new User;
        $user ->email    = $credentials['email'];
        $user ->name     = $credentials['name'];
        $user ->password = Hash::make($credentials['password']);
        $user ->save();

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')
                ->with('status', "A user \"{$credentials['name']}\" has been created");
        }
    }
}
