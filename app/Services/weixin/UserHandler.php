<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/29
 */
 
namespace App\Services\weixin;

use EasyWeChat\OfficialAccount\Application;

/**
 * 微信用户服务
 */
class UserHandler
{
    /**
     * @var EasyWeChat\OfficialAccount\User\UserClient
     */
    private $userClient;

    public function __construct(Application $app)
    {
        $this->userClient = $app->user;
    }
    
    /**
     * 读取微信用户信息
     * @param String    $openid
     * @return Array
     */
    public function get($openid)
    {
        $user = $this->userClient->get($openid);
    }
}