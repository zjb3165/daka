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
    
    Route::group(['prefix'=>'resource'], function(){
        Route::get('/', ['uses'=>'ResourceController@lists']);
        Route::get('/{id}', ['uses'=>'ResourceController@info']);
        Route::delete('/{id}', ['uses'=>'ResourceController@destroy']);
        Route::post('/upload', ['uses'=>'ResourceController@upload']);
    });

    Route::group(['prefix'=>'goal'], function(){
        Route::get('/', ['uses'=>'CheckinController@getGoals']);
        Route::get('/{id}', ['uses'=>'CheckinController@getGoal']);
        Route::post('/{id}', ['uses'=>'CheckinController@updateGoal']);
    });

    Route::group(['prefix'=>'member'], function(){
        Route::get('/', ['uses'=>'MemberController@index']);
        Route::get('/{id}', ['uses'=>'MemberController@show']);
        Route::post('/{id}', ['uses'=>'MemberController@update']);
    });
});