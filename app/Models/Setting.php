<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/04
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 系统设置
 * @property string         $title      标题
 * @property string         $code       唯一标识代码
 * @property array          $params     参数
 */
class Setting extends Model
{
    protected $casts = [
        'params' => 'array',
    ];
}
