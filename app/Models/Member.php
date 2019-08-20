<?php
/**
 * Author: Jumper Swordwave
 * date: 2019/07/22
 */
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 会员信息
 * @property string     $nickname       昵称
 * @property string     $avatar         头像
 * @property string     $phone          电话
 * @property integer    $parent_id      推荐人id
 * @property string     $parent_path    推荐人路径
 * @property integer    $gender         性别
 * @property integer    $birthday       出生日期
 * @property integer    $credits        当前积分
 * @property integer    $balance        当前余额
 * @property integer    $subscribed_at  关注时间
 * @property integer    $actived_at     最后一次活跃时间
 * @property integer    $interaction_at 最后一次交互动作时间
 * @property string     $memos          管理员备注
 * @property array      $weixin_infos   微信原始信息
 */
class Member extends Authenticatable
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
        'interaction_at' => 'integer',
        'weixin_infos' => 'array',
    ];

    /**
     * 推荐人
     */
    public function parent()
    {
        return $this->belongsTo(Member::class);
    }

    public function getInfo()
    {
        $_parent = null;
        if ($this->parent != null) {
            $_parent = [
                'id' => $this->parent->id,
                'nickname' => $this->parent->nickname,
                'avatar' => $this->parent->avatar,
            ];
        }
        return [
            'id' => $this->id,
            'nickname' => $this->nickname,
            'avatar' => $this->avatar,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'credits' => $this->credits,
            'balance' => $this->balance,
            'subscribed_at' => $this->subscribed_at,
            'actived_at' => $this->actived_at,
            'interaction_at' => $this->interaction_at,
            'memos' => $this->memos,
            'parent' => $_parent,
        ];
    }
}
