<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        // ついでに他端末ログアウトしたい場合（任意）:
        // $request->user()->tokens()?->delete(); // Sanctum等
        // $request->session()->regenerate();

        return back()->with('status', 'パスワードを更新しました');
    }
}
