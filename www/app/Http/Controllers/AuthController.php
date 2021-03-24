<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login()
    {
        return view('pages/login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'name'     => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('name', $credentials['name'])->first();
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($credentials['password']);
                $user->save();
            }
            return redirect()->route('home');
        }

        $credentials = $request->validate([
            'name'     => ['unique:users,name'],
            'password' => [],
        ]);

        $user = new User;
        $user ->email    = $request['email'];
        $user ->name     = $credentials['name'];
        $user ->password = Hash::make($credentials['password']);
        $user ->save();
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        };
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
