<?php

use Encore\Admin\Facades\Admin;
use App\Admin\Controllers\CompanyController;
use App\Admin\Controllers\SalesReportController;
use App\Admin\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'middleware' => ['web', 'nocache']], function () {
    Route::get('login', [\App\Admin\Controllers\AuthController::class, 'showLoginForm']);
    Route::post('login', [\App\Admin\Controllers\AuthController::class, 'postLogin']);
});


// Laravel-admin のルートを登録（'admin' プレフィックス付き）
Admin::routes();

// 独自にルート追加したい場合は prefix は不要
Route::resource('admin/company', CompanyController::class);
Route::get('sales-report', [SalesReportController::class, 'index']);
Route::resource('admins', AdminUserController::class);

