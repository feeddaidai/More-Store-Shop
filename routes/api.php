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

    });
});



