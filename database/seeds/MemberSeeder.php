<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Repo\MemberRepo;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repo = new MemberRepo();
        $repo->newMember([
            'openid' => date('YmdHis') . uniqid(),
            'nickname' => 'Jumper',
            'headimgurl' => 'https://wx.qlogo.cn/mmopen/vi_32/mSicXFOQ1olia5D7J6zdqNsUzI5QcI6N8MatQjpSlJU5dTDXBC4hm3bQ8ibTvzKGbsBer0fWmENZjWcd9840XtAgQ/132',
            'sex' => 1,
            'subscribe_time' => time() - 6 * 3600,
        ]);

        $repo->newMember([
            'openid' => date('YmdHis') . uniqid(),
            'nickname' => 'Jerry',
            'headimgurl' => 'https://wx.qlogo.cn/mmhead/6ib7kfMGO4epa8kvWIO2GRhJjBhJXFDfHInia2DCDW780/132',
            'sex' => 1,
            'subscribe_time' => time() - 3 * 3600,
        ]);

        $repo->newMember([
            'openid' => date('YmdHis') . uniqid(),
            'nickname' => 'Thomas',
            'headimgurl' => 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTISP5QsW2DYNS432fNvbgkXHMZmCHIiakGGKAzH7MMfcETibibJn4UIVThtcI8LWzQaxE7SicRDgpUufA/132',
            'sex' => 2,
            'subscribe_time' => time() - 5 * 3600,
        ]);
    }
}
