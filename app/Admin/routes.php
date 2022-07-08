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


    #api
    Route::get('api/spec','SpecController@getName');
    Route::get('api/spec/value','SpecController@getValue');

});
