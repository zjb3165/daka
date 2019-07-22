<?php
/**
 * Author: Jumper Swordwave
 * date: 2019/07/22
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 会员登录记录
 */
class MemberLoginRecord extends Model
{
    protected $casts = [
        'member_id' => 'integer',
    ];
}
