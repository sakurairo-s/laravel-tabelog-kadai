<?php

// routes/admin.php
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\CompanyController;
use Encore\Admin\Facades\Admin;
use App\Admin\Controllers\SalesReportController;
use App\Admin\Controllers\AdminUserController;

// Laravel-Admin のルートを登録
Admin::routes();

Route::middleware(['web', 'auth']) // 必要なら認証など追加
    ->prefix('admin')
    ->group(function () {
        Route::resource('company', CompanyController::class);
    });

// stripe売上管理のルートを登録    
Admin::registerAuthRoutes();

Route::get('sales-report', [SalesReportController::class, 'index']);

Route::resource('admins', AdminUserController::class);
