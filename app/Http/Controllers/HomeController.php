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
        $bg = '20190724/2017012014754568.jpg';
        $settings = [
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
                'size' => 32,
                'color' => '#333333',
                'align' => 'left',
                'valign' => 'middle',
            ],
        ];

        $build = new ShareImageBuilder();
        $result = $build->build($bg, $settings);
        return '<img src="'. image_url($result) .'" />';
    }
}