<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/04
 */
 
namespace App\Http\Controllers\Api\Sys;

use App\Http\Controllers\Api\BaseController;
use App\Repo\SettingRepo;
use App\Models\ApiErrorCode;

/**
 * 网站设置控制
 */
class SettingController extends BaseController
{
    /**
     * @var \App\Repo\SettingRepo;
     */
    private $repo;
    
    public function __construct(SettingRepo $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * 读取设置
     * @route   /api/sys/setting
     * @param string    $code
     */
    public function get()
    {
        $code = trim(request()->input('code'));
        $setting = $this->repo->get($code);
        if ($setting == null) {
            return $this->error(ApiErrorCode::GET_ERROR, '设置不存在');
        }

        return $this->success(['setting'=>$setting]);
    }

    /**
     * 更新设置
     * @route   /api/sys/setting
     * @method  post
     * @param string    $code
     * @param array     $params
     */
    public function save()
    {
        $code = trim(request()->input('code'));
        $params = request()->input('params');

        if (is_string($params)) {
            $params = json_decode($params);
        }
        if (! is_array($params) || $code == '') {
            return $this->error(ApiErrorCode::PARAMS_ERROR, '参数错误');
        }

        $this->repo->save($code, $params, $params['title'] ?? $code);
        return $this->success(['setting'=>$params]);
    }
}