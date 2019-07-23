<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/23
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 后台管理员
 * @property String     $username
 * @property String     $password
 * @property String     $username
 * @property Array      $permissions
 */
class Admin extends Model
{
    protected $casts = [
        'permissions' => 'array',
    ];
}
