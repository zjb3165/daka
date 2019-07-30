<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/29
 */
 
namespace App\Repo;

use App\Models\Member;
use App\Models\SocialLogins;
use App\Models\QrTicket;

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
        
        if (isset($info['nickname'])) {
            $member->nickname = $info['nickname'];
        }
        if (isset($info['headimgurl'])) {
            $member->avatar = $info['headimgurl'];
        }
        if (isset($info['phone'])) {
            $member->phone = $info['phone'];
        }
        if (isset($info['sex'])) {
            $member->gender = $info['sex'];
        }
        if (isset($info['birthday'])) {
            $member->birthday = $info['birthday'];
        }
        if (isset($info['subscribe_time'])) {
            $member->subscribed_at = $info['subscribe_time'];
        }
        if (isset($info['actived_at'])) {
            $member->actived_at = $info['actived_at'];
        }
        $member->save();
        return $member;
    }

    /**
     * 修改会员的上级推荐人
     * @param \App\Models\Member    $member
     * @param integer               $parent_id  新的上级id
     */
    public function updateMemberParent(Member $member, $parent_id)
    {
        if ($member == null) return;
        $parent = Member::find($parent_id);
        if ($parent == null) return;    //上级用户不存在
        
        \DB::beginTransaction();
        try {
            $old_path = $member->parent_path;
            $member->parent_id = $parent->id;
            $member->parent_path = $parent->parent_path != '' ? $parent->parent_path . ',' . $parent->id : $parent->id;
            $member->save();
            $new_path = $member->parent_path;
            $childs = Member::whereRaw('find_in_set('. $member->id .', parent_path)')->get();
            foreach($childs as $_m) {
                $_m->parent_path = str_replace($old_path, $new_path, $_m->parent_path);
                if (substr($_m->parent_path, 0, 1) === ',') {
                    $_m->parent_path = substr($_m->parent_path, 1);
                }
                $_m->save();
            }
            \DB::commit();
        } catch(\Exception $e){
            \Log::info('update parent failed. member id:' . $member->id . ', parent id:' . $parent->id . '. message:' . $e->getMessage());
            \Log::info($e);
            \DB::rollBack();
        }
    }

    /**
     * 读取会员推广二维码
     * @param mixed     $member_or_openid_or_id
     * @return \App\Models\QrTicket
     */
    public function getQrticketByMember($member_or_openid_or_id)
    {
        if (is_numeric($member_or_openid_or_id)) {
            $member_id = $member_or_openid_or_id;
        } else if (is_string($member_or_openid_or_id)) {
            $member = $this->getMemberByOpenid($member_or_openid_or_id);
            if ($member == null) return null;
            $member_id = $member->id;
        } else {
            if ($member == null) return null;
            $member_id = $member->id;
        }
        
        $ticket = QrTicket::where('member_id', $member_id)->orderBy('id', 'desc')->first();
        if ($ticket != null && $ticket->expired_at > time()) {
            return $ticket;
        }
        return null;
    }

    /**
     * 读取会员推广二维码
     * @param string    $ticket
     * @return \App\Models\QrTicket
     */
    public function getQrticketByTicket($ticket)
    {
        return QrTicket::where('ticket', $ticket)->first();
    }
}