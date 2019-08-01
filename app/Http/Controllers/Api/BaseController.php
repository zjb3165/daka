<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/01
 */
 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 请求返回成功
     * @param array     $result
     */
    protected function success($result=[])
    {
        return response()->json(array_merge(['code'=>0], $result));
    }
    
    /**
     * 请求失败
     * @param integer   $code
     * @param string    $msg
     */
    protected function error($code, $msg='')
    {
        return response()->json(['code'=>$code, 'message'=>$msg]);
    }
}