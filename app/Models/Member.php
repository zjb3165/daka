<?php
/**
 * Author: Jumper Swordwave
 * date: 2019/07/22
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 会员信息
 * @property String     $nickname
 * @property String     $avatar
 * @property String     $phone
 * @property Integer    $parent_id
 * @property Integer    $gender
 * @property Integer    $birthday
 * @property Integer    $credits
 * @property Integer    $balance
 * @property Integer    $subscribed_at
 * @property Integer    $actived_at
 */
class Member extends Model
{
    protected $casts = [
        'parent_id' => 'integer',
        'gender' => 'integer',
        'birthday' => 'integer',
        'credits' => 'integer',
        'balance' => 'integer',
        'subscribed_at' => 'integer',
        'actived_at' => 'integer',
    ];

    /**
     * 推荐人
     */
    public function parent()
    {
        return $this->belongsTo(Member::class);
    }
}
