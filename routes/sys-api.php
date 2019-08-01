<?php
/**
 * api for sys control
 */

Route::post('/login', ['uses'=>'AuthController@login']);
Route::post('/password', ['sues'=>'AuthController@password']);