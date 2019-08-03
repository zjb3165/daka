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

    const INSERT_ERROR = 40005; //添加失败
    const UPDATE_ERROR = 40006; //修改失败
    const DELETE_ERROR = 40007; //删除失败
    const GET_ERROR = 40008;    //读取失败
    const VALIDATE_ERROR = 40009;   //验证失败
}