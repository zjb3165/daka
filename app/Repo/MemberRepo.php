<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/29
 */
 
namespace App\Repo;

use App\Models\Member;
use App\Models\SocialLogins;

class MemberRepo
{
    /**
     * 读取社交登录表openid记录
     * @param String    $openid
     * @param String    $type       默认weixin
     * @return App\Models\SocialLogins
     */
    public function getSocial($openid, $type='weixin')
    {
        return SocialLogins::where('type', $type)->where('openid', $openid)->first();
    }

    /**
     * 根据id读取会员信息
     * @param Integer   $id
     * @return App\Models\Member
     */
    public function getMemberById($id)
    {
        return Member::find($id);
    }

    /**
     * 读取会员信息
     * @param String    $openid
     * @param String    $type       默认weixin
     * @return App\Models\Member;
     */
    public function getMemberByOpenid($openid, $type='weixin')
    {
        $login = $this->getSocial($openid, $type);
        if ($login == null) return null;
        
        return $this->getMemberById($login->member_id);
    }
    
    /**
     * 创建用户
     * @param Array     $info
     * @return App\Models\Member
     */
    public function createMember($info)
    {
        if (! isset($info['nickname']) || $info['nickname'] == '')  return null;

        $member = new Member();
        $member->fill($info);
        $member->credits = 0;
        $member->balance = 0;
        $member->subscribed_at = isset($info['subscribed']) ? time() : 0;
        $member->actived_at = time();
        $member->save();

        return $member;
    }
    
    /**
     * 创建社交登录用户
     * @param Integer   $member_id
     * @param String    $openid
     * @param String    $type       默认weixin
     * @return Boolean
     */
    public function createSocial($member_id, $openid, $type='weixin')
    {
        $login = $this->getSocial($openid, $type);
        if ($login == null) {
            $login = new SocialLogins();
            $login->member_id = $member_id;
            $login->openid = $openid;
            $login->type = $type;
        } else {
            $login->member_id = $member_id;
        }
        $login->save();
        return $login;
    }

    /**
     * 更新社交登录会员关联
     * @param Integer   $member_id
     * @param String    $openid
     * @param String    $type
     */
    public function updateSocial($member_id, $openid, $type='weixin')
    {
        SocialLogins::where('type', $type)->where('openid', $openid)->update(['member_id'=>$member_id]);
    }

    /**
     * 创建新用户
     * @param String    $openid
     * @param Array     $info
     * @param String    $type
     */
    public function newMember($openid, $info, $type='weixin')
    {
        $login = $this->getSocial($openid, $type);
        if ($login != null) {
            $member = $this->getMemberById($login->member_id);
        }
        if ($member == null) {
            $member = $this->createMember($info);
        }
        if ($login == null) {
            $login = $this->createSocial($member->id, $openid, $type);
        } else {
            $this->updateSocial($member->id, $openid, $type);
        }
        
        return $member;
    }

    /**
     * 更新会员信息
     * @param mixed     $member_or_id
     * @param Array     $info
     */
    public function updateMember($member_or_id, $info)
    {
        if (is_integer($member_or_id)){
            $member = $this->getMemberById($member_or_id);
        } else {
            $member = $member_or_id;
        }
        
        $member->fill($info);
        $member->save();
        return $member;
    }
}