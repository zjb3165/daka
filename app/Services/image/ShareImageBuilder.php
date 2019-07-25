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
 *      'type' => 'bg',
 *      'width' => 500,
 *      'height' => 500,
 *      'color' => 'rgba(255,255,255,0.7)',
 *      'position' => [
 *          'x' => 50,
 *          'y' => 50,
 *      ],
 *      'radius' => [
 *          'r' => 15,
 *          'top-left' => true,
 *          'top-right' => true,
 *          'bottom-left' => true,
 *          'bottom-right' => true,
 *      ],
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
        if (! is_array($settings)) {
            throw new ShareImageException('param settings error. must be an array.');
        }

        $bg_img = \Image::make($bgfile);
        foreach($settings as $setting) {
            if (!isset($setting['type'])) continue;

            if ($setting['type'] == 'image') {
                $this->image($bg_img, $setting);
            } else if ($setting['type'] == 'text') {
                $this->text($bg_img, $setting);
            } else if ($setting['type'] == 'bg') {
                $this->bg($bg_img, $setting);
            }
        }

        if ($save) {
            $new_file_path = date('Ymd') . '/' . ($savefile !== '' ? $savefile : time().uniqid() . '.jpg');
            $dir = pathinfo(upload_path($new_file_path), PATHINFO_DIRNAME);
            if (! is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
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
        if (! isset($setting['content']) || $setting['content'] == '') return;

        if (! isset($setting['font'])){
            $setting['font'] = TextFont::MSYH;
        }
        if (! isset($setting['position'])) {
            $setting['position'] = [
                'x' => 0,
                'y' => 0,
            ];
        }
        if (! isset($setting['size'])) {
            $setting['size'] = 20;
        }
        if (! isset($setting['color'])) {
            $setting['color'] = '#ffffff';
        }
        if (! isset($setting['align'])) {
            $setting['align'] = 'top-left';
        }

        $box = imagettfbbox($setting['size'], 0, TextFont::getPath($setting['font']), $setting['content']);
        $h = $box[3] - $box[5];
        $w = ($box[4] - $box[6]);
        if (strlen($setting['content']) <= 15) {
            $w = $w * 0.8;
        } else {
            $w = $w * 0.75;
        }

        $text_img = \Image::canvas($w, $h);
        //$text_img->fill('rgba(0, 0, 0, 0.7)');
        $text_img->text($setting['content'], 0, 0, function($font)use($setting){
            $font->file(TextFont::getPath($setting['font']));
            $font->size($setting['size']);
            $font->color($setting['color']);
            $font->align('left');
            $font->valign('top');
        });
        $img->insert($text_img, $setting['align'], $setting['position']['x'], $setting['position']['y']);

        /*$img->text($setting['content'], $setting['position']['x'], $setting['position']['y'], function($font)use($setting){
            $font->file(TextFont::getPath($setting['font']));
            $font->size($setting['size']);
            $font->color($setting['color']);
            $font->align($setting['align']);
            $font->valign($setting['valign']);
        });*/
    }
    
    /**
     * 添加背景颜色框
     */
    private function bg($bg, $setting)
    {
        if (!isset($setting['width']) || !isset($setting['height'])
            || $setting['width'] <= 0 || $setting['height'] <= 0) return;
        
        $width = intval($setting['width']);
        $height = intval($setting['height']);
        $color = 'rgba(255,255,255,0.5)';
        if (isset($setting['color'])) $color = $setting['color'];
        if (! isset($setting['align'])) $setting['align'] = 'top-left';
        if (! isset($setting['position'])) {
            $setting['position'] = [
                'x' => 0,
                'y' => 0,
            ];
        }

        $img = \Image::canvas($width, $height);
        //如果设置了圆角，则将圆角外部分填充为透明
        if (isset($setting['radius']) && isset($setting['radius']['r']) && $setting['radius']['r'] > 0) {
            $r = intval($setting['radius']['r']);
            $r = min($r, $width, $height);
            $rects = [[0, 0, $width, $height]];
            if (isset($setting['radius']['top-left'])) {
                for($x = 0; $x < $r; $x++) {
                    for($y = 0; $y < $r; $y++) {
                        if ((($r - $x) * ($r - $x) + ($r - $y) * ($r - $y)) < $r * $r){
                            $img->pixel($color, $x, $y);
                        }
                    }
                }
                $rects[0] = [$r, 0, $width, $r];
                $rects[1] = [0, $r, $width, $height];
            }
            if (isset($setting['radius']['top-right'])) {
                $x1 = $width - $r;
                $y1 = $r;
                for($x = $x1; $x < $width; $x++){
                    for($y = 0; $y < $r; $y++) {
                        if ((($x1 - $x) * ($x1 - $x) + ($y - $y1) * ($y - $y1)) < $r * $r) {
                            $img->pixel($color, $x, $y);
                        }
                    }
                }
                $rects[0][2] = $width - $r;
                if (! isset($rects[1])) {
                    $rects[1] = [0, $r, $width, $height];
                }
            }
            if (isset($setting['radius']['bottom-left'])) {
                $x1 = $r;
                $y1 = $height - $r;
                for($x = 0; $x < $r; $x++) {
                    for($y = $y1; $y < $height; $y++){
                        if ((($x - $x1) * ($x - $x1) + ($y - $y1) * ($y - $y1)) < $r * $r) {
                            $img->pixel($color, $x, $y);
                        }
                    }
                }
                if (isset($rects[1])) {
                    $rects[1][3] = $height - $r;
                    $rects[2] = [$r, $height - $r, $width, $height];
                } else {
                    $rects[0][3] = $height - $r;
                    $rects[1] = [$r, $height - $r, $width, $height];
                }
            }
            if (isset($setting['radius']['bottom-right'])) {
                $x1 = $width - $r;
                $y1 = $height - $r;
                for($x = $x1; $x < $width; $x++) {
                    for($y = $y1; $y < $height; $y++) {
                        if ((($x - $x1) * ($x - $x1) + ($y - $y1) * ($y - $y1)) < $r * $r) {
                            $img->pixel($color, $x, $y);
                        }
                    }
                }
                if (isset($rects[2])) {
                    $rects[2][2] = $width - $r;
                } else if (isset($rects[1])) {
                    $rects[1][2] = $width - $r;
                } else {
                    $rects[0][3] = $height - $r;
                    $rects[1] = [0, $height - $r, $width - $r, $height];
                }
            }
            //dd($rects);

            foreach($rects as $rect) {
                for($x = $rect[0]; $x < $rect[2]; $x++) {
                    for($y = $rect[1]; $y < $rect[3]; $y++) {
                        $img->pixel($color, $x, $y);
                    }
                }
            }
        } else {
            $img->fill($color);
        }
        $bg->insert($img, $setting['align'], $setting['position']['x'], $setting['position']['y']);
    }
}