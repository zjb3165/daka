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
        $bg = upload_path('20190725/734352.jpg');
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

        $style1 = [
            [
                'type' => 'image',
                'path' => upload_path('20190725/avatar.png'),
                'width' => 100,
                'height' => 100,
                'position' => [
                    'align' => 'top-left',
                    'x' => 30,
                    'y' => 30,
                ],
                'round' => true,
            ],
            [
                'type' => 'image',
                'path' => upload_path('20190725/qr.jpg'),
                'width' => 100,
                'height' => 100,
                'position' => [
                    'align' => 'bottom-right',
                    'x' => 25,
                    'y' => 25,
                ],
            ],
            [
                'type' => 'text',
                'content' => date('d'),
                'position' => [
                    'x' => 20,
                    'y' => 30,
                ],
                'align' => 'top-right',
                'font' => TextFont::TNR,
                'size' => 60,
                'color' => '#ffffff',
            ],
            [
                'type' => 'text',
                'content' => date('Y.m'),
                'position' => [
                    'x' => 20,
                    'y' => 85,
                ],
                'align' => 'top-right',
                'font' => TextFont::TNR,
                'size' => 24,
                'color' => '#ffffff',
            ],
            [
                'type' => 'text',
                'content' => '风雨里像个大人，阳光下像个孩子',
                'position' => [
                    'x' => 155,
                    'y' => 75,
                ],
                'color' => '#ffffff',
                'font' => TextFont::MSYH,
                'size' => 24,
                'align' => 'bottom-right',
            ],
            [
                'type' => 'text',
                'content' => '扫码和我互道早安',
                'position' => [
                    'x' => 155,
                    'y' => 30,
                ],
                'color' => '#ffffff',
                'size' => 20,
                'align' => 'bottom-right',
                'font' => TextFont::MSYH,
            ],
            [
                'type' => 'text',
                'content' => '连续早起',
                'position' => [
                    'x' => 30,
                    'y' => 190,
                ],
                'color' => '#ffffff',
                'font' => TextFont::MSYH,
                'size' => 22,
            ],
            [
                'type' => 'text',
                'content' => [
                    [
                        'content' => '6',
                        'color' => '#ffffff',
                        'font' => TextFont::MSYH,
                        'size' => 70,
                    ],
                    [
                        'content' => '天',
                        'color' => '#ffffff',
                        'font' => TextFont::MSYH,
                        'size' => 24,
                    ]
                ],
                'position' => [
                    'x' => 30,
                    'y' => 240,
                ],
            ],
            [
                'type' => 'text',
                'content' => '今日早起',
                'position' => [
                    'x' => 30,
                    'y' => 320,
                ],
                'color' => '#ffffff',
                'font' => TextFont::MSYH,
                'size' => 24,
            ],
            [
                'type' => 'text',
                'content' => date('H:i'),
                'position' => [
                    'x' => 30,
                    'y' => 360,
                ],
                'color' => '#ffffff',
                'font' => TextFont::TNR,
                'size' => 70,
            ],
            [
                'type' => 'bg',
                'width' => 240,
                'height' => 1,
                'color' => '#ffffff',
                'position' => [
                    'x' => 30,
                    'y' => 445,
                ],
            ],
            [
                'type' => 'text',
                'content' => '3455223人正在参与',
                'position' => [
                    'x' => 30,
                    'y' => 465,
                ],
                'color' => '#ffffff',
                'font' => TextFont::MSYH,
                'size' => 24,
            ],
            [
                'type' => 'text',
                'content' => '比123万人起的早',
                'position' => [
                    'x' => 30,
                    'y' => 505,
                ],
                'color' => '#ffffff',
                'font' => TextFont::MSYH,
                'size' => 24,
            ]
        ];

        //$b = imagettfbbox(28, 0, TextFont::getPath(TextFont::MSYH), '风雨里像个大人，阳光下像个孩子');
        //dd($b);

        $build = new ShareImageBuilder();
        $result = $build->build($bg, $style1, true, 'style1.jpg');
        return '<img src="'. image_url($result) .'" />';
    }
}