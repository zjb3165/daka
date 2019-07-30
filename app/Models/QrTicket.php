<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/30
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 微信二维码ticket
 * @property integer     $member_id     会员id
 * @property string      $ticket        
 * @property string      $locale        生成的本地图片地址
 * @property string      $remote        远程图片地址
 * @property integer     $expired_at    过期时间
 */
class QrTicket extends Model
{
    protected $casts = [
        'member_id' => 'integer',
        'expired_at' => 'integer',
    ];
}
