<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/03
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 资源文件
 * @property string     $category   文件类型: image/audio/video
 * @property string     $title      文件标题
 * @property string     $path       文件保存位置
 * @property string     $src_path   原文件保存位置
 * @property integer    $size       文件大小
 * @property string     $cover      视频文件封面截图
 * @property integer    $duration   视频/音频文件时间长度
 * @property string     $mime   
 * @property integer    $status     处理状态: 1:正常文件/2:新文件、待处理文件/3:处理中文件
 */
class FileResource extends Model
{
    const NORMAL = 1;
    const NEWS = 2;
    const PROCESSING = 3;

    const IMAGE = 'image';
    const VIDEO = 'video';
    const AUDIO = 'audio';
    
    protected $casts = [
        'size' => 'integer',
        'duration' => 'integer',
        'status' => 'integer',
    ];

    public function tags()
    {
        return $this->belongsTo(FileResourceTag::class, 'file_resource_tags_resources', 'resource_id', 'tag_id');
    }
}
