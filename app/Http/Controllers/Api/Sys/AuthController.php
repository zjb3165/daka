<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/01
 */
namespace App\Http\Controllers\Api\Sys;

use App\Http\Controllers\Controller;

class AuthController extends Controller 
{
    public function login()
    {
        $username = request('username');
        $password = request('password');
    }
}