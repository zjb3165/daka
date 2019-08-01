<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/23
 */
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * 后台管理员
 * @property string     $username
 * @property string     $password
 * @property string     $username
 * @property array      $permissions
 */
class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $casts = [
        'permissions' => 'array',
    ];
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
}
