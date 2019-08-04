<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/04
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 资源文件标签
 * @property string     $title
 * @property integer    $count
 */
class FileResourceTag extends Model
{
    protected $casts = [
        'count' => 'integer',
    ];
}
