<?php

use Illuminate\Http\Request;

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

Route::group(['prefix'=>'member'], function(){
    Route::get('/', ['uses'=>'MemberController@getMember']);
    Route::get('/history', ['uses'=>'MemberController@getHistories']);
    Route::get('/today', ['uses'=>'MemberController@getTodayStat']);
    Route::get('/ranks', ['uses'=>'MemberController@getFriendRanks']);
});