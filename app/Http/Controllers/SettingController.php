<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use Session;

class SettingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function view()
    {
        $md = new User();
        $old_name = $md->getLoginUser()->name;
        $old_email = $md->getLoginUser()->email;
        $old_token = $md->getLoginUser()->notion_token;
        $old_dbid = $md->getLoginUser()->notion_dbid;

        return view('setting_view', compact('old_name', 'old_email', 'old_token', 'old_dbid'));
    }

    public function update(UpdateUserRequest $request)
    {
        // ユーザのモデル取得
        try {
            $user = User::find(Auth::id());
        } catch (Exception $e) {
        }
        // 値更新
        $user->name = $request->input('input_name');
        $user->email = $request->input('input_email');
        // 保存処理
        try {
            $user->save();
            return view('setting_complete');
        } catch (Exception $e) {
        }
    }
}
