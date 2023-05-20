<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;



class GoogleLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'postLogout']);
    }

    // 省略
    public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->email)->first();
        if ($user == null) {   // ユーザが存在しなければ新しくユーザーを作成
            $user = User::updateOrCreate([
                'email' => $googleUser->email
            ], [
                'lastlogin_at' => now(),
                'created_at' => now(),
            ]);
            Auth::login($user, true);
            return redirect('/onboarding');
        } else {      // ユーザが存在すればログイン日時のみ更新
            $user = User::updateOrCreate([
                'email' => $googleUser->email
            ], [
                'lastlogin_at' => now(),
            ]);
            Auth::login($user, true);
            return redirect('/home');
        }

        Auth::login($user, true);
        return redirect('/home');
    }


    public function postLogout()
    {
        Auth::logout();
        return redirect()->to('/');
    }
}
