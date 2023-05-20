<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Crypt;

class OnboardingController extends Controller
{
    //
    public function index()
    {
        $update_status = null;
        $prevURL = parse_url(url()->previous(), PHP_URL_PATH);
        $homeURL = parse_url(url('/') . "/home", PHP_URL_PATH);
        $settingURL = parse_url(url('/') . "/setting", PHP_URL_PATH);
        return view('onboarding', compact('prevURL', 'homeURL', 'settingURL'));
    }

    public function update(UpdateUserRequest $request)
    {
        // ユーザのモデル取得
        try {
            $user = User::find(Auth::id());
        } catch (Exception $e) {
        }
        // 値更新
        $user->notion_token = Crypt::encryptString($request->input('input_token'));
        $user->notion_dbid = Crypt::encryptString($request->input('input_dbid'));
        // 保存処理
        try {
            $user->save();
            return redirect()->route('home');
        } catch (Exception $e) {
        }
    }
}
