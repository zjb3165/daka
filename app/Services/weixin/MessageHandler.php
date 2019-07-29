<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/29
 */
 
namespace App\Services\weixin;

use App\Models\Member;
use App\Repo\MemberRepo;

class MessageHandler
{
    /**
     * @var App\Repo\MemberRepo
     */
    private $memberRepo;
    
    /**
     * @var App\Services\weixin\UserHandler
     */
    private $userClient;

    /**
     * @var App\Models\Member;
     */
    private $member;
    
    /**
     * @var Array   微信消息结构
     */
    private $msg;
    
    /**
     * 
     */
    public function __construct(MemberRepo $memberRepo, UserHandler $userClient)
    {
        $this->memberRepo = $memberRepo;
        $this->userClient = $userClient;
    }
    
    /**
     * 消息处理
     * @params Array    $msg    微信消息结构
     */
    public function handle($msg)
    {
        $this->msg = $msg;
        $this->init();

        switch(strtolower($msg['MsgType'])) {
            case 'event':
                return $this->event();
            break;
            case 'text':
            return $this->text();
            break;
            case 'location':
            break;
            case 'link':
            return $this->link();
            break;
        }
        
        return null;
    }

    /**
     * 根据消息初始化
     */
    private function init()
    {
        $openid = $this->msg['FromUserName'];
        $member = $this->memberRepo->getMemberByOpenid($openid);
        if ($member == null) {  //创建新用户
            $info = $this->userClient->get($openid);
            $member = $this->memberRepo->newMember($openid, $info);
        }
        $this->member = $member;
    }

    /**
     * 事件处理
     */
    private function event()
    {
        switch(strtolower($this->msg['Event'])) {
            case 'subscribe':
                return $this->subscribe();
            break;
            case 'unsubscribe':
                return $this->unsubscribe();
            break;
            case 'scan':
                return $this->scan();
            break;
            case 'location':
            break;
            case 'click':
                return $this->menuClick();
            break;
            case 'view':
            break;
        }
        return null;
    }
    
    /**
     * 用户关注
     */
    private function subscribe()
    {
        return null;
    }
    
    /**
     * 用户取关
     */
    private function unsubscribe()
    {
        
        return null;
    }

    /**
     * 扫码事件
     */
    private function scan()
    {
        return null;
    }

    /**
     * 菜单点击事件
     */
    private function menuClick()
    {
        return null;
    }

    /**
     * 文本消息
     */
    private function text()
    {
        if ($text == '去打卡'){

        }
        return null;
    }

    /**
     * 链接消息
     */
    private function link()
    {
        return null;
    }
}