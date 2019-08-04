<?php

use Illuminate\Database\Seeder;

use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->title = '微信设置';
        $setting->code = 'wechat';
        $setting->params = [
            'appid' => '',
            'appsecret' => '',
            'token' => '',
            'aeskey' => '',
            'qrcode' => '',
            'name' => '',
            'url' => '',
        ];
        $setting->save();
    }
}
