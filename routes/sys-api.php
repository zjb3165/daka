<?php
/**
 * api for sys control
 */

Route::post('/auth/login', ['uses'=>'AuthController@login']);

Route::group(['prefix'=>'auth', 'middleware'=>'auth.sys'], function(){
    Route::post('/password', ['uses'=>'AuthController@updatePassword']);
    Route::get('/refresh', ['uses'=>'AuthController@refresh']);
    Route::get('/logout', ['uses'=>'AuthController@logout']);
    Route::get('/info', ['uses'=>'AuthController@info']);
});