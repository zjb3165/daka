<?php
/**
 * Author: Jumper Swordwave
 * date: 2019/07/22
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 会员信息
 * @property string     $nickname
 * @property string     $avatar
 * @property string     $phone
 * @property integer    $parent_id
 * @property string     $parent_path
 * @property integer    $gender
 * @property integer    $birthday
 * @property integer    $credits
 * @property integer    $balance
 * @property integer    $subscribed_at
 * @property integer    $actived_at
 */
class Member extends Model
{
    protected $fillable = ['nickname', 'avatar', 'phone', 'gender', 'birthday',];
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
