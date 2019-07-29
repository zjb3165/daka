<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/23
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 打卡目标
 * @property    String  $title          目标名称
 * @property    Integer $start_time     打卡开始时间,小时
 * @property    Integer $end_time       打卡结束时间,小时
 * @property    Integer $credits        可得到的积分
 * @property    String  $order_index    排序位置
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
