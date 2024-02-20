<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use Socialite;
use App\Models\User;

class GitHubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        try {

            $user = Socialite::driver('github')->user();

            $searchUser = User::where('github_id', $user->id)->first();

            if ($searchUser) {
                Auth::login($searchUser);

                return redirect('/');
            } else {
                $searchUser = User::where('email', $user->email)->first();

                if ($searchUser) {
                    Auth::login($searchUser);
                } else {
                    $gitUser = User::create([
                        'name' => $user->name,
                        'username' => $user->nickname,
                        'email' => $user->email,
                        'github_id' => $user->id,
                        'auth_type' => 'github',
                        'password' => substr(encrypt(md5(uniqid(mt_rand(), true))), 0, config('auth.default_password_length'))
                    ]);

                    Auth::login($gitUser);
                }
                return redirect('/');
            }
        } catch (Exception $e) {
            return redirect('login');
        }
    }
}
