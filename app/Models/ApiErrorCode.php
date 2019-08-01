<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/01
 */
 
namespace App\Models;

class ApiErrorCode
{
    const LOGIN_ERROR = 40001;  //登陆失败
    const TOKEN_ERROR = 40002;  //TOKEN验证失败

    const OLD_PASSWORD_ERROR = 40003;   //旧密码错误
    const NEW_PASSWORD_ERROR = 40004;   //新密码错误
}