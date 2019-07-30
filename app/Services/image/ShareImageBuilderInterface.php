<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/30
 */
 
namespace App\Services\image;

/**
 * 分享图片生成接口
 */
interface ShareImageBuilderInterface
{
    /**
     * @param string    $bgfile
     * @param array     $setting
     * @param boolean   $save
     * @param string    $savefile
     * @return mixed
     */
    public function build($bgfile, $settings=[], $save=true, $savefile='');
}