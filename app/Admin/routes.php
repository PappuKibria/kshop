<?php

use Illuminate\Routing\Router;
//use App\Admin\Controllers\ProductController;
//use App\Admin\Controllers\ProductCategoryController;
//use App\Admin\Controllers\ProductSubCategoryController;
use App\Http\Controllers\CommonController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('/products', ProductController::class);
    $router->resource('/product-categories', ProductCategoryController::class);
    $router->resource('/products-sub-categories', ProductSubCategoryController::class);

});
Route::get('/home', [CommonController::class,'home'])->name('main');
