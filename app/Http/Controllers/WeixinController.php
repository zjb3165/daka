<?php
/**
 * Author: Jumper Swordwave
 * date: 2019/07/22
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\OfficialAccount\Application;
use EasyWeChat\Kernel\Messages\Transfer;

/**
 * 微信事件处理控制器
 */
class WeixinController extends Controller
{
    /**
     * @var EasyWeChat\OfficialAccount\Application;
     */
    private $server = null;

    public function __construct(EasyWeChat\OfficialAccount\Application $app)
    {
        $this->server = $app->server;
    }

    /**
     * 消息处理
     */
    public function server()
    {
        $this->server->push(function($msg) {
            /**
             * 消息处理
             */
            return new Transfer();
        });
        return $this->server->server();
    }
}
