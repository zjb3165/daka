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
 * @property    string  $reply          打卡回复
 * @property    string  $checked_reply  已打过卡回复
 * @property    string  $not_in_time_reply  不在打卡时间内回复
 * @property    string  $code           打卡目标唯一编号
 * @property    boolean $repeat         当天是否可重复打卡
 * @property    string  $order_index    排序位置
 */
class Goal extends Model
{
    protected $fillable = ['start_time', 'end_time', 'credits', 'reply', 'checked_reply', 'not_in_time_reply', 'order_index', 'repeat'];
    protected $casts = [
        'start_time' => 'integer',
        'end_time' => 'integer',
        'credits' => 'integer',
        'order_index' => 'integer',
        'repeat' => 'boolean',
    ];
}
