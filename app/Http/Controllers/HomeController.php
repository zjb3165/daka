<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/24
 */
 
namespace App\Http\Controllers;

use App\Services\image\ShareImageBuilder;
use App\Services\image\TextFont;

class HomeController extends Controller
{
    public function test()
    {
        $bg = upload_path('20190724/2017012014754568.jpg');
        $settings = [
            [
                'type' =>'bg',
                'width' => 500,
                'height' => 100,
                'position' => [
                    'x' => 50,
                    'y' => 850
                ],
                'color' => 'rgba(255, 255, 255, 0.7)',
                'radius' => [
                    'r' => 15,
                    'top-left' => true,
                    'top-right' => true,
                    'bottom-left' => true,
                    'bottom-right' => true,
                ],
            ],
            [
                'type' => 'image',
                'path' => 'http://shop.nb800.cn/image/20171215/15133212775a33733dcf4c5.jpg',
                'width' => 100,
                'height' => 100,
                'position' => [
                    'align' => 'top-left',
                    'x' => 910,
                    'y' => 490,
                ],
                'round' => true,
            ],
            [
                'type' => 'image',
                'path' => 'http://shop.nb800.cn/image/20171215/15133212775a33733dcf4c5.jpg',
                'width' => 150,
                'height' => 150,
                'position' => [
                    'align' => 'bottom-right',
                    'x' => 50,
                    'y' => 50,
                ],
                'round' => false,
            ],
            [
                'type' => 'text',
                'content' => 'Jumper',
                'position' => [
                    'x' => 150,
                    'y' => 150,
                ],
                'font' => TextFont::MSYH,
                'size' => 24,
                'color' => '#333333',
                'align' => 'left',
                'valign' => 'middle',
            ],
            [
                'type' => 'text',
                'content' => '日有所思，夜有所梦',
                'position' => [
                    'x' => 100,
                    'y' => 900,
                ],
                'font' => TextFont::MSYH,
                'size' => 28,
                'color' => '#ffffff',
                'align' => 'left',
                'valign' => 'middle',
            ],
            [
                'type' => 'text',
                'content' => '2019-07-24',
                'position' => [
                    'x' => 80,
                    'y' => 50,
                ],
                'font' => TextFont::TNR,
                'size' => 32,
                'color' => '#FFFFFF',
                'align' => 'left',
                'valign' => 'middle',
            ],
        ];

        $build = new ShareImageBuilder();
        $result = $build->build($bg, $settings, true, '223344556677.jpg');
        return '<img src="'. image_url($result) .'" />';
    }
}