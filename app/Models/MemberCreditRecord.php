<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/20
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 用户积分记录
 * @property integer    $member_id  会员id
 * @property integer    $credit     积分
 * @property integer    $type       1增加积分/2扣除积分
 * @property integer    $category   1积分/2余额
 * @property string     $remark     备注
 */
class MemberCreditRecord extends Model
{
    const TYPE_INC = 1;
    const TYPE_DEC = 2;
    const CATEGORY_CREDIT = 1;
    const CATEGORY_BALANCE = 2;

    protected $casts = [
        'member_id' => 'integer',
        'credit' => 'integer',
        'type' => 'integer',
        'category' => 'integer',
    ];
}
