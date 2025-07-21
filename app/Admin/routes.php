<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\ShopController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\ReviewController;
use App\Admin\Controllers\CompanyController;
use Encore\Admin\Facades\Admin;


Admin::routes();



Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', CategoryController::class);
    $router->resource('shops', ShopController::class);
    $router->resource('users', UserController::class);
    $router->post('shops/import', [ShopController::class, 'csvImport']);
    $router->resource('reviews', ReviewController::class);
    $router->resource('companies', CompanyController::class);
    

});
