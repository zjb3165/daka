<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/08
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 会员登陆日志
 * @property integer    $member_id
 * @property integer    $ip
 */
class MemberLoginRecord extends Model
{
    protected $casts = [
        'member_id' => 'integer',
        'ip' => 'integer',
    ];
}
