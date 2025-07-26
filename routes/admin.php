<?php

use Illuminate\Support\Facades\Route;
use Encore\Admin\Facades\Admin;
use App\Admin\Controllers\CompanyController;
use App\Admin\Controllers\SalesReportController;
use App\Admin\Controllers\AdminUserController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

// Laravel-Admin が提供するルーティング群（/admin/loginなどを含む）
Admin::routes();

// ✅ カスタム管理機能用ルート（adminログイン中のみアクセス可能）
Route::middleware('auth:admin')->group(function () {
    Route::resource('company', CompanyController::class);
    Route::get('sales-report', [SalesReportController::class, 'index']);
    Route::resource('admins', AdminUserController::class);
});

// ✅ 管理者ログイン用 独自ログイン画面ルート
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('cutom_admin.login');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('admin.login.post');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('custom_admin.logout');
