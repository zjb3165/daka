<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/08
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 会员交互记录
 * @property integer    $member_id
 * @property integer    $category
 * @property string     $content
 */
class MemberInteractionRecords extends Model
{
    const CATEGORY_SUBSCRIBE = 1;   //关注
    const CATEGORY_UNSUBSCRIBE = 2; //取关
    const CATEGORY_QRSCAN = 3;      //扫码
    const CATEGORY_MENU = 4;        //点击菜单
    const CATEGORY_TEXT = 5;        //回复文字

    protected $casts = [
        'member_id' => 'integer',
        'category' => 'integer',
    ];
}
