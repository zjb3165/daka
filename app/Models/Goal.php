<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/23
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 打卡目标
 * @property    string  $title          目标名称
 * @property    integer $start_time     打卡开始时间,小时
 * @property    integer $end_time       打卡结束时间,小时
 * @property    integer $credits        可得到的积分
 * @property    string  $order_index    排序位置
 */
class Goal extends Model
{
    protected $casts = [
        'start_time' => 'integer',
        'end_time' => 'integer',
        'credits' => 'integer',
        'order_index' => 'integer',
    ];
}
