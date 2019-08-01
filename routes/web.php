<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/storage/uploads/{dir}/{path}@{size}', ['uses'=>'FileController@imageShow'])
    ->where('dir', '\d{8}')->where('path', '[a-zA-Z0-9]+\.(jpg|jpeg|bmp|gif|png|mp3|mp4|pdf|xls|doc|xlsx)');

Route::get('/sys', function(){
    return view('sys');
});
Route::get('/test', ['uses'=>'HomeController@test']);
Route::any('/wechat', ['uses'=>'WeixinController@server']);