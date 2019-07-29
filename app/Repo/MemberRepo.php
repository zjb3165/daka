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
     * @param mixed     $openid
     * @param string    $type       默认weixin
     * @return App\Models\SocialLogins
     */
    public function getSocial($openid, $type='weixin')
    {
        $cursor = SocialLogins::where('type', $type);
        if (is_array($openid)) {
            $cursor->whereIn('openid', $openid);
        } else {
            $cursor->where('openid', $openid);
        }
        return $cursor->first();
    }

    /**
     * 根据id读取会员信息
     * @param integer   $id
     * @return App\Models\Member
     */
    public function getMemberById($id)
    {
        return Member::find($id);
    }

    /**
     * 读取会员信息
     * @param string    $openid
     * @param string    $type       默认weixin
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
     * @param array     $info
     * @return App\Models\Member
     */
    public function createMember($info)
    {
        if (! isset($info['nickname']) || $info['nickname'] == '')  return null;

        $member = new Member();
        $member->nickname = $info['nickname'];
        $member->avatar = $info['headimgurl'];
        $member->phone = isset($info['phone']) ? $info['phone'] : '';
        $member->gender = $info['sex'];
        $member->birthday = isset($info['birthday']) ? $info['birthday'] : 0;
        $member->parent_id = 0;
        $member->credits = 0;
        $member->balance = 0;
        $member->subscribed_at = isset($info['subscribe_time']) ? $info['subscribe_time'] : 0;
        $member->actived_at = time();
        $member->save();

        return $member;
    }
    
    /**
     * 创建社交登录用户
     * @param integer   $member_id
     * @param string    $openid
     * @param string    $type       默认weixin
     * @return boolean
     */
    public function createOrUpdateSocial($member_id, $openid, $type='weixin')
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
     * @param integer   $member_id
     * @param string    $openid
     * @param string    $type
     */
    public function updateSocial($member_id, $openid, $type='weixin')
    {
        SocialLogins::where('type', $type)->where('openid', $openid)->update(['member_id'=>$member_id]);
    }

    /**
     * 创建新用户
     * @param string    $openid
     * @param array     $info
     * @param string    $type
     */
    public function newMember($info, $type='weixin')
    {
        if (! isset($info['openid'])) return null;
        
        $openid = $info['openid'];
        if (isset($info['unionid']) && $info['unionid'] != '') {
            $openid = [$info['openid'], $info['unionid']];
        }
        $login = $this->getSocial($openid, $type);

        if ($login != null) {
            $member = $this->getMemberById($login->member_id);
        }
        if ($member == null) {
            $member = $this->createMember($info);
        }
        $this->createOrUpdateSocial($member->id, $info['openid'], $type);
        if (isset($info['unionid']) && $info['unionid'] != '') {
            $this->createOrUpdateSocial($member->id, $info['unionid'], $type);
        }
        
        return $member;
    }

    /**
     * 更新会员信息
     * @param mixed     $member_or_id
     * @param array     $info
     * @return App\Models\Member
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