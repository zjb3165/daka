<?php
/**
 * api for sys control
 */

Route::post('/login', ['uses'=>'AuthController@login']);

Route::group(['middleware'=>'auth.sys'], function(){
    Route::post('/password', ['uses'=>'AuthController@updatePassword']);
    Route::get('/refresh', ['uses'=>'AuthController@refresh']);
    Route::get('/logout', ['uses'=>'AuthController@logout']);
});