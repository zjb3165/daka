<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/23
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 后台管理员
 * @property string     $username
 * @property string     $password
 * @property string     $username
 * @property array      $permissions
 */
class Admin extends Model
{
    protected $casts = [
        'permissions' => 'array',
    ];
}
