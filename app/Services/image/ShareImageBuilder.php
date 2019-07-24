<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/23
 */
 
namespace App\Services\image;

/**
 * $share = new ShareImageBuilder();
 * $share->build(upload_path('20190724/sdflkj12l34jazldjfa.jpg'), [
 *  [
 *      'type' => 'image',
 *      'path' => upload_path('20190724/laldskfjl.jpg'),    //http://www.aaa.com/adsfal.jpg
 *      'width' => 150,
 *      'height' => 150,
 *      'position' => [
 *          'align' => 'top-left',
 *          'x' => 0,
 *          'y' => 0,
 *      ],
 *      'round' => true/false   //是否圆形图片
 *  ],
 *  [
 *      'type' => 'text',
 *      'content' => '不积跬步，无以至千里',
 *      'font' => TextFont::MSYH,
 *      'position' => [
 *          'x' => 0,
 *          'y' => 0,
 *      ],
 *      'size' => 30,
 *      'color' => '#000000',
 *      'align' => 'left',
 *      'valign' => 'middle',
 *  ]
 * ]);
 */
class ShareImageBuilder
{
    /**
     * 生成分享图片
     * @param String    $bg    背景图片地址
     * @param Array     $settings   贴图文字设置
     * @param Bool      $save   是否保存图片
     * @param String    $savefile   
     */
    public function build($bgfile, $settings=[], $save=true, $savefile='')
    {
        if (!file_exists($bgfile)) {
            throw new ShareImageException('background image is not exists');
        }

        $bg_img = \Image::make($bgfile);
        foreach($settings as $setting) {
            if (!isset($setting['type'])) continue;

            if ($setting['type'] == 'image') {
                $this->image($bg_img, $setting);
            } else if ($setting['type'] == 'text') {
                $this->text($bg_img, $setting);
            }
        }

        if ($save) {
            $new_file_path = date('Ymd') . '/' . ($savefile !== '' ? $savefile : time().uniqid() . '.jpg');
            $bg_img->save(upload_path($new_file_path), 60, 'jpg');
            return $new_file_path;
        }
        return $bg_img->stream('jpg', 60);
    }
    
    /**
     * 添加图片
     */
    private function image($img, $setting)
    {
        if (!isset($setting['path']) || $setting['path'] == '') return;
        $source = $setting['path'];
        
        if (!isset($setting['width'])) {
            $setting['width'] = 150;
        }
        if (!isset($setting['height'])) {
            $setting['height'] = $setting['width'];
        }
        if (!isset($setting['position'])) {
            $setting['position'] = [
                'align' => 'top-left',
                'x' => 0,
                'y' => 0,
            ];
        }

        $src_img = \Image::make($source)->resize($setting['width'], $setting['height']);
        if (isset($setting['round']) && $setting['round']) {
            $src_img = $this->roundImage($src_img);
        }
        $img->insert($src_img, $setting['position']['align'], $setting['position']['x'], $setting['position']['y']);
    }

    /**
     * 制作圆形图片
     */
    private function roundImage($img)
    {
        $width = $img->width();
        $new_img = \Image::canvas($width, $width);
        $radius = $width / 2;

        for($x=0; $x<$width; $x++) {
            for($y=0; $y<$width; $y++) {
                if ((($x - $radius) * ($x - $radius) + ($y - $radius) * ($y - $radius)) < ($radius * $radius)) {
                    $color = $img->pickColor($x, $y, 'array');
                    $new_img->pixel($color, $x, $y);
                }
            }
        }
        return $new_img;
    }
    
    /**
     * 添加文字
     */
    private function text($img, $setting)
    {
        if (!isset($setting['content']) || $setting['content'] == '') return;

        if (!isset($setting['font'])){
            $setting['font'] = TextFont::MSYH;
        }
        if (!isset($setting['position'])) {
            $setting['position'] = [
                'x' => 0,
                'y' => 0,
            ];
        }
        if (!isset($setting['size'])) {
            $setting['size'] = 20;
        }
        if (!isset($setting['color'])) {
            $setting['color'] = '#ffffff';
        }
        if (!isset($setting['align'])) {
            $setting['align'] = 'left';
        }
        if (!isset($setting['valign'])) {
            $setting['valign'] = 'middle';
        }

        $img->text($setting['content'], $setting['position']['x'], $setting['position']['y'], function($font)use($setting){
            $font->file(TextFont::getPath($setting['font']));
            $font->size($setting['size']);
            $font->color($setting['color']);
            $font->align($setting['align']);
            $font->valign($setting['valign']);
        });
    }
}