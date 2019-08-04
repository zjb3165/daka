<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/03
 */

namespace App\Repo;

use App\Models\Setting;

class SettingRepo
{
    /**
     * 读取设置
     * @param string    $code
     * @return array
     */
    public function get($code)
    {
        $setting = Setting::where('code', $code)->first();
        if ($setting != null) {
            return $setting->params;
        }
        return null;
    }
    
    /**
     * 保存设置
     * @param string    $code
     * @param array     $params
     * @return boolean
     */
    public function save($code, $params, $title='')
    {
        $setting = Setting::where('code', $code)->first();
        if ($setting == null) {
            $setting = new Setting();
            $setting->code = $code;
            $setting->title = $title;
        } 
        $setting->params = $params;
        $setting->save();
        return true;
    }
}