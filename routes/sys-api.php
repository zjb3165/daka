<?php
/**
 * api for sys control
 */

Route::post('/login', ['uses'=>'AuthController@login']);