<?php
/**
 * Author: Jumper Swordwave
 * date: 2019/07/22
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 会员登录记录
 * @property Integer    $member_id
 * @property String     $type       web=网页,chat=公众号窗口
 * @property String     $source
 */
class MemberLoginRecord extends Model
{
    protected $casts = [
        'member_id' => 'integer',
    ];
}
