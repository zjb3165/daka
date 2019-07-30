<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/29
 */
 
namespace App\Services\weixin;

use App\Services\image\ShareImageBuilderInterface;
use App\Models\Member;
use App\Models\Goal;
use App\Repo\MemberRepo;
use App\Repo\CheckInRepo;

class MessageHandler
{
    /**
     * @var \App\Repo\MemberRepo
     */
    private $memberRepo;
    
    /**
     * @var \App\Repo\CheckInRepo
     */
    private $checkinRepo;
    
    /**
     * @var \App\Services\weixin\UserHandler
     */
    private $userClient;

    /**
     * @var \App\Models\Member;
     */
    private $member;
    
    /**
     * @var array   微信消息结构
     */
    private $msg;

    /**
     * @var \App\Services\image\ShareImageBuilderInterface
     */
    private $builder;
    
    /**
     * 
     */
    public function __construct(MemberRepo $memberRepo, CheckInRepo $checkInRepo, UserHandler $userClient, ShareImageBuilderInterface $builder)
    {
        $this->memberRepo = $memberRepo;
        $this->checkinRepo = $checkInRepo;
        $this->userClient = $userClient;
        $this->builder = $builder;
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
            $ticket = $this->getQrTicket();
            if ($ticket != null) {
                $info['parent_id'] = $ticket->member_id;
            }
            $member = $this->memberRepo->newMember($openid, $info);
        }
        $this->member = $member;
    }
    
    private function getQrTicket()
    {
        if (isset($this->msg['qrticket'])) {
            return $this->msg['qrticket'];
        }
        if (isset($this->msg['Ticket'])) {
            $ticket = $this->memberRepo->getQrticketByTicket($this->msg['Ticket']);
            $this->msg['qrticket'] = $ticket;
            return $ticket;
        }
        return null;
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
        $ticket = $this->getQrTicket();
        if ($ticket != null && $ticket->member_id != $this->member->id) {
            $this->memberRepo->makeFriends($this->member->id, $ticket->member_id);
        }
        $this->memberRepo->updateMember($this->member, ['actived_at'=>time()]);
        //todo 关注回复
        return null;
    }
    
    /**
     * 用户取关
     */
    private function unsubscribe()
    {
        $this->memberRepo->updateMember($this->member, ['subscribed_at'=>0, 'actived_at'=>0]);
        //todo 取关回复
        return null;
    }

    /**
     * 扫码事件
     */
    private function scan()
    {
        $ticket = $this->getQrTicket();
        if ($ticket != null && $ticket->member_id != $this->member->id) {
            $this->memberRepo->makeFriends($this->member->id, $ticket->member_id);
        }
        $this->memberRepo->updateMember($this->member, ['actived_at'=>time()]);
        return null;
    }

    /**
     * 菜单点击事件
     */
    private function menuClick()
    {
        //todo 读取对应菜单项,判断菜单功能
        $goal = $this->searchGoal($this->member, intval(date('H')));
        return $this->checkIn($goal);
    }

    /**
     * 文本消息
     */
    private function text()
    {
        if ($text == '去打卡'){
            $goal = $this->searchGoal($this->member, intval(date('H')));
            return $this->checkIn($goal);
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

    /**
     * 打卡
     */
    private function checkIn(Goal $goal)
    {
        if ($goal == null) {
            return null;
        }
        $hour = intval(date('H'));
        if (! $this->checkinRepo->inTime($goal)) {
            //不在打卡时间内
            //todo 回复
        }
        if ($this->checkinRepo->checked($this->member, $goal)) {
            //今日已打过
            //todo 回复
        }
        
        //todo 生成打卡图片
        //$picture = $this->builder->build();
        $picture = '20190730/style3.jpg';
        $record = $this->checkinRepo->checkGoal($this->member, $goal, $picture);
        
        //return message
        return $record;
    }
}