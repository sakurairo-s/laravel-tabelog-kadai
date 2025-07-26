<?php

use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\CompanyController;
use App\Admin\Controllers\SalesReportController;
use App\Admin\Controllers\AdminUserController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

// 独自の管理者ログイン画面用ルート
Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});

// Laravel-Adminのルートを登録（auth: falseでLaravel-Adminの認証をバイパス）
Admin::routes(['auth' => false]);

// 独自の管理者機能ルート
Route::prefix('admin')->group(function () {
    Route::resource('company', CompanyController::class);
    Route::get('sales-report', [SalesReportController::class, 'index']);
    Route::resource('admins', AdminUserController::class);
});
