<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/20
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 用户打卡记录
 * @property integer    $member_id  
 * @property integer    $goal_id        目标id
 * @property integer    $total_count    总打卡天数
 * @property integer    $link_count     连续打卡天数
 */
class MemberRecordStat extends Model
{
    protected $casts = [
        'member_id' => 'integer',
        'goal_id' => 'integer',
        'total_count' => 'integer',
        'link_count' => 'integer',
    ];
}
