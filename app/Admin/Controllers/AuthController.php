<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseAuthController
{
    public function postLogin(Request $request)
    {
        $credentials = [
            'email' => $request->input('username'), // usernameフィールドをemailとして扱う
            'password' => $request->input('password'),
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(admin_url());
        }

        return redirect()->back()->withInput()->withErrors([
            'email' => '認証に失敗しました。',
        ]);
    }
public function showLoginForm()
{
    if (\Auth::guard('admin')->check()) {
        return redirect()->intended(admin_url());
    }

    return view('admin::login');
}


}
