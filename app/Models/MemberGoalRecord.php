<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/23
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 会员打卡记录
 * @property integer    $member_id      会员id
 * @property integer    $goal_id        打卡目标id
 * @property string     $picture        生成图片地址
 */
class MemberGoalRecord extends Model
{
    protected $casts = [
        'member_id' => 'integer',
        'goal_id' => 'integer',
    ];
}
