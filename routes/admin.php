<?php

use Illuminate\Routing\Router;
use Encore\Admin\Facades\Admin;
use App\Admin\Controllers\HomeController;
use App\Admin\Controllers\CompanyController;
use App\Admin\Controllers\SalesReportController;
use App\Admin\Controllers\AdminUserController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('custom_admin.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('custom_admin.login.post');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('custom_admin.logout');
});

// ✅ Laravel-Admin のルートを定義
Admin::routes();

// ✅ Laravel-AdminのTOP（/admin）表示用ルートを正しく追加
Route::group([
    'prefix'        => config('admin.route.prefix'),     // 'admin'
    'namespace'     => config('admin.route.namespace'),  // 'App\Admin\Controllers'
    'middleware'    => config('admin.route.middleware'), // ['web', 'admin']
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
});

// ✅ 独自の管理機能ルート
Route::prefix('admin')
    ->middleware('auth:admin')
    ->as('admin.')
    ->group(function () {
        Route::resource('company', CompanyController::class);
        Route::get('sales-report', [SalesReportController::class, 'index']);
        Route::resource('admins', AdminUserController::class);
    });
