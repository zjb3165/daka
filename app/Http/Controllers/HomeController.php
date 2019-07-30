<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/24
 */
 
namespace App\Http\Controllers;

use App\Services\image\ShareImageBuilderInterface;
use App\Services\image\TextFont;

class HomeController extends Controller
{
    private $builder;
    public function __construct(ShareImageBuilderInterface $builder){
        $this->builder = $builder;
    }

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
                'path' => upload_path('20190725/avatar2.jpg'),
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
        
        $style2 = [
            [
                'type' => 'bg',
                'width' => 95,
                'height' => 95,
                'color' => 'rgba(0,0,0,0.5)',
                'position' => [
                    'x' => 45,
                    'y' => 0,
                ],
                'align' => 'top-right',
                'radius' => [
                    'r' => 8,
                    'bottom-left' => true,
                    'bottom-right' => true,
                ],
            ],
            [
                'type' => 'text',
                'content' => date('d'),
                'size' => 60,
                'color' => '#ffffff',
                'position' => [
                    'x' => 58,
                    'y' => 15,
                ],
                'align' => 'top-right',
            ],
            [
                'type' => 'text',
                'content' => date('Y.m'),
                'size' => 20,
                'color' => '#ffffff',
                'position' => [
                    'x' => 50,
                    'y' => 70,
                ],
                'align' => 'top-right',
            ],
            [
                'type' => 'bg',
                'width' => 670,
                'height' => 170,
                'position' => [
                    'x' => 40,
                    'y' => 280,
                ],
                'align' => 'top-left',
                'color' => 'rgba(255,255,255,0.5)',
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
                'path' => upload_path('20190725/avatar2.jpg'),
                'width' => 120,
                'height' => 120,
                'position' => [
                    'align' => 'top-left',
                    'x' => 70,
                    'y' => 300,
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
                    'x' => 30,
                    'y' => 30,
                ],
            ],
            [
                'type' => 'text',
                'content' => [
                    [
                        'content' => date('H:i'),
                        'size' => 60,
                        'color' => '#34362c',
                    ],
                    [
                        'content' => '连续早起',
                        'size' => 24,
                        'color' => '#34362c',
                        'padding' => [
                            'left' => 15,
                            'bottom' => 5,
                            'right' => 15,
                        ],
                    ],
                    [
                        'content' => 6,
                        'size' => 60,
                        'color' => '#34362c'
                    ],
                    [
                        'content' => '天',
                        'size' => 24,
                        'color' => '#34362c',
                        'padding' => [
                            'left' => 15,
                            'bottom' => 5,
                        ],
                    ]
                ],
                'position' => [
                    'x' => 220,
                    'y' => 310,
                ],
            ],
            [
                'type' => 'text',
                'content' => '132433人正在参与，比12万人起的早',
                'size' => 28,
                'color' => '#816463',
                'position' => [
                    'x' => 220,
                    'y' => 395,
                ],
            ],
            [
                'type' => 'text',
                'content' => '所求皆如愿，所行皆坦途，多喜乐、长安宁',
                'size' => 24,
                'color' => '#000000',
                'position' => [
                    'x' => 145,
                    'y' => 70,
                ],
                'align' => 'bottom-right',
            ],
            [
                'type' => 'text',
                'content' => '扫码与我互道早安',
                'color' => '#6b6965',
                'size' => 24,
                'position' => [
                    'x' => 145,
                    'y' => 30,
                ],
                'align' => 'bottom-right',
            ]
        ];

        $style3 = [
            [
                'type' => 'image',
                'path' => upload_path('20190725/avatar2.jpg'),
                'width' => 60,
                'height' => 60,
                'position' => [
                    'align' => 'top-left',
                    'x' => 30,
                    'y' => 30,
                ],
                'round' => true,
            ],
            [
                'type' => 'text',
                'content' => '时光，浓淡相宜，人心，远近相安',
                'size' => 24,
                'color' => '#333333',
                'position' => [
                    'x' => 115,
                    'y' => 50,
                ],
            ],
            [
                'type' => 'text',
                'content' => date('d'),
                'color' => '#333333',
                'size' => 60,
                'position' => [
                    'x' => 25,
                    'y' => 30,
                ],
                'align' => 'top-right',
            ],
            [
                'type' => 'text',
                'content' => date('Y.m月'),
                'color' => '#333333',
                'size' => 20,
                'position' => [
                    'x' => 25,
                    'y' => 85,
                ],
                'align' => 'top-right',
            ],
            [
                'type' => 'bg',
                'width' => 670,
                'height' => 170,
                'position' => [
                    'x' => 30,
                    'y' => 30,
                ],
                'align' => 'bottom-left',
                'color' => 'rgba(255,255,255,0.7)',
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
                'path' => upload_path('20190725/qr.jpg'),
                'width' => 100,
                'height' => 100,
                'position' => [
                    'align' => 'bottom-right',
                    'x' => 65,
                    'y' => 45,
                ],
            ],
            [
                'type' => 'text',
                'content' => '今日早起',
                'size' => 24,
                'color' => '#333333',
                'position' => [
                    'x' => 65,
                    'y' => 155,
                ],
                'align' => 'bottom-left',
            ],
            [
                'type' => 'text',
                'content' => '连续早起',
                'size' => 24,
                'color' => '#333333',
                'position' => [
                    'x' => 305,
                    'y' => 155,
                ],
                'align' => 'bottom-left',
            ],
            [
                'type' => 'text',
                'content' => date('H:i'),
                'size' => 60,
                'color' => '#333333',
                'align' => 'bottom-left',
                'position' => [
                    'x' => 65,
                    'y' => 80,
                ],
            ],
            [
                'type' => 'text',
                'content' => [
                    [
                        'content' => 6,
                        'size' => 60,
                        'color' => '#333333',
                    ],
                    [
                        'content' => '天',
                        'size' => 24,
                        'color' => '#7e7e7e',
                        'padding' => [
                            'bottom' => 10,
                            'left' => 15,
                        ]
                    ]
                ],
                'position' => [
                    'x' => 305,
                    'y' => 80,
                ],
                'align' => 'bottom-left',
            ],
            [
                'type' => 'text',
                'content' => '124232人正在参与，比12万人起的早',
                'color' => '#7e7e7e',
                'size' => 24,
                'position' => [
                    'x' => 65,
                    'y' => 45,
                ],
                'align' => 'bottom-left',
            ],
            [
                'type' => 'text',
                'content' => '扫码与我互道早安',
                'size' => 24,
                'color' => '#7e7e7e',
                'position' => [
                    'x' => 65,
                    'y' => 155,
                ],
                'align' => 'bottom-right',
            ]
        ];

        $result = $this->builder->build($bg, $style3, true, 'style3.jpg');
        return '<img src="'. image_url($result) .'" />';
    }
}