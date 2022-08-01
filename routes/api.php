<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('Api')->group(function () {
    #登陆注册
    Route::post('/get/verifycode',[\App\Api\v1\ToolsApi::class,'getCode']);
    Route::post('/login',[\App\Api\v1\UserApi::class,'login']);
    Route::post('/register',[\App\Api\v1\UserApi::class,'pcRegister'])->middleware(['register','checkCode']);

    #商品类
    Route::post('/goods/detail',[\App\Api\v1\GoodsApi::class,'goodsDetail']);

    //登录后页面 ---   个人中心等
    Route::middleware('frontend')->group(function () {
        //购物车
        Route::post('/car/add',[\App\Api\v1\CarApi::class,'addGoods']);
        Route::post('/car',[\App\Api\v1\CarApi::class,'carList']);
        Route::post('/car/plus',[\App\Api\v1\CarApi::class,'addCount']);
        Route::post('/car/sub',[\App\Api\v1\CarApi::class,'subCount']);

        //购物车结束
        //其他接口
        Route::post('/consignee',[\App\Api\v1\ConsigneeApi::class,'find']);
        Route::post('/order/confirm',[\App\Api\v1\OrderApi::class,'confirm']);
    });
});



