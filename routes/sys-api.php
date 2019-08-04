<?php
/**
 * api for sys control
 */

Route::post('/auth/login', ['uses'=>'AuthController@login']);

Route::group(['middleware'=>'auth.sys'], function(){
    Route::group(['prefix'=>'auth'], function(){
        Route::post('/password', ['uses'=>'AuthController@updatePassword']);
        Route::get('/refresh', ['uses'=>'AuthController@refresh']);
        Route::get('/logout', ['uses'=>'AuthController@logout']);
        Route::get('/info', ['uses'=>'AuthController@info']);
    });
    
    Route::group(['prefix'=>'admin'], function(){
        Route::post('/check', ['uses'=>'AdminController@checkUserName']);
        Route::get('/', ['uses'=>'AdminController@index']);
        Route::post('/', ['uses'=>'AdminController@store']);
        Route::post('/{id}', ['uses'=>'AdminController@update']);
        Route::delete('/{id}', ['uses'=>'AdminController@destroy']);
        Route::get('/{id}', ['uses'=>'AdminController@getInfo']);
    });

    Route::group(['prefix'=>'setting'], function(){
        Route::get('/', ['uses'=>'SettingController@get']);
        Route::post('/', ['uses'=>'SettingController@save']);
    });
});