<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    #商品
    $router->resource('goods/spu','GoodsController');
    $router->resource('goods/sku','GoodsSkuController');

    #用户
    $router->resource('user/normal','UserNormalController');
    $router->resource('user/user_comment','CommentController'); #用户评论
    $router->resource('user/invoice','InvoiceController'); #用户发票

    #api
    Route::get('api/spec','SpecController@getName');
    Route::get('api/spec/value','SpecController@getValue');

});
