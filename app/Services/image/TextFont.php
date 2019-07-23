<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/23
 */

namespace App\Services\image;

class TextFont
{
    const MSYH = 1;
    const TNR = 2;
    
    public static function getPath($font='')
    {
        $fonts = [
            self::MSYH => 'fonts/msyh.ttc',
            self::TNR => 'fonts/times.ttf',
        ];
        
        return resource_path(isset($fonts[$font]) ? $fonts[$font] : $fonts[self::MSYH]);
    }
}