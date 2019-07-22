<?php
/**
 * Author: Jumper Swordwave
 * date: 2019/07/22
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 社交登陆信息
 */
class SocialLogins extends Model
{
    protected $casts = [
        'member_id' => 'integer',
    ];
    
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
