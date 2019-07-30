<?php
/**
 * Author: Jumper Swordwave
 * date: 2019/07/22
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\OfficialAccount\Application;
use EasyWeChat\Kernel\Messages\Transfer;
use App\Services\weixin\MessageHandler;

/**
 * 微信事件处理控制器
 */
class WeixinController extends Controller
{
    /**
     * @var EasyWeChat\OfficialAccount\Application;
     */
    private $server = null;

    /**
     * @var App\Services\weixin\MessageHandler;
     */
    private $handler = null;

    public function __construct(Application $app, MessageHandler $handler)
    {
        $this->server = $app->server;
        $this->handler = $handler;
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
            $result = $this->handler->handle($msg);
            if ($result != null) {
                return $result;
            }
            return new Transfer();
        });
        return $this->server->server();
    }
}
