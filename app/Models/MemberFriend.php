<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/30
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 好友
 * @property integer    $member_id
 * @property integer    $friend_id
 */
class MemberFriend extends Model
{
    protected $casts = [
        'member_id' => 'integer',
        'friend_id' => 'integer',
    ];
}
