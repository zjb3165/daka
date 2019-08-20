<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/07/29
 */
 
namespace App\Repo;

use App\Models\Member;
use App\Models\SocialLogins;
use App\Models\QrTicket;
use App\Models\MemberFriend;

/**
 * 会员操作
 */
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
        $member->parent_path = '';
        $member->credits = 0;
        $member->balance = 0;
        $member->subscribed_at = isset($info['subscribe_time']) ? $info['subscribe_time'] : 0;
        $member->interaction_at = time();
        $member->actived_at = time();
        if (isset($info['parent_id']) && $info['parent_id'] > 0) {
            $parent = Member::find($info['parent_id']);
            if ($parent != null) {
                $member->parent_id = $parent->id;
                $member->parent_path = $parent->parent_path != '' ? $parent->parent_path . ',' . $parent->id : $parent->id;
            }
        }
        $member->memos = '';
        $member->weixin_infos = $info;
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

        $member = null;
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
     * @param array     $info   ['nickname', 'headimgurl', 'phone', 'sex', 'birthday', 'subscribe_time', 'actived_at', 'memos']
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
        if (isset($info['memos'])) {
            $member->memos = $info['memos'];
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
        
        if ($parent->parent_path != '') {
            $pp_ids = explode(',', $parent->parent_path);
            if (in_array($member->id, $pp_ids)) return; //防止循环设置上级推荐人
        }
        
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

    /**
     * 加为好友
     * @param integer   $member_id
     * @param integer   $friend_id
     */
    public function makeFriends($member_id, $friend_id)
    {
        if ($member_id == $friend_id) return;

        $friend = MemberFriend::where('member_id', $member_id)->where('friend_id', $friend_id)->first();
        if ($friend == null) {
            $f = new MemberFriend();
            $f->member_id = $member_id;
            $f->friend_id = $friend_id;
            $f->save();

            $f = new MemberFriend();
            $f->member_id = $friend_id;
            $f->friend_id = $member_id;
            $f->save();
        }
    }
    
    /**
     * 读取好友列表
     * @param mixed     $member_or_id
     * @param array     $fields         返回字段，默认为全部
     * @return array
     */
    public function getFriendList($member_or_id, $fields=[])
    {
        if (is_numeric($member_or_id)){
            $member_id = $member_or_id;
        } else {
            $member_id = $member_or_id->id;
        }
        
        $friend_ids = MemberFriend::where('member_id', $member_id)->get()
                        ->map(function($item){
                            return $item->friend_id;
                        })-toArray();
        
        if (empty($friend_ids)) return collect([]);
        $cursor = Member::whereIn('id', $friend_ids);
        if (count($fields)) $cursor->select($fields);
        return $cursor->orderBy('id', 'asc')->get();
    }

    /**
     * 读取会员好友id列表
     * @param mixed     $member_or_id
     */
    public function getFriendIds($member_or_id)
    {
        if (is_numeric($member_or_id)){
            $member_id = $member_or_id;
        } else {
            $member_id = $member_or_id->id;
        }

        return MemberFriend::where('member_id', $member_id)
                    ->get()
                    ->map(function($item){
                        return $item->friend_id;
                    })
                    -toArray();
    }
    
    /**
     * 会员列表
     * @param integer   $parent_id      推荐人id,默认0
     * @param string    $nickname       昵称，默认空
     * @param string    $order          排序，默认空，可选subscribed_asc/subscribed_desc/actived_asc/actived_desc
     * @param integer   $page
     * @param integer   $pagesize
     * @param array     $with           关联对象
     * @return array    [$count, $list]
     */
    public function getMemberList($parent_id=0, $nickname='', $order='', $page=1, $pagesize=10, $with=[])
    {
        $cursor = Member::query();
        if ($parent_id > 0) {
            $cursor->where('parent_id', $parent_id);
        }
        if ($nickname != '') {
            $cursor->where('nickname', 'like', '%'. $nickname .'%');
        }
        if (count($with)) {
            $cursor->with($with);
        }
        switch($order) {
            case 'subscribed_asc':
            $cursor->orderBy('subscribed_at', 'asc');
            break;
            case 'subscribed_desc':
            $cursor->orderBy('subscribed_at', 'desc');
            break;
            case 'actived_asc':
            $cursor->orderBy('actived_at', 'asc');
            break;
            case 'actived_desc':
            $cursor->orderBy('actived_at', 'desc');
            break;
        }
        $cursor->orderBy('id', 'desc');
        
        $count = $cursor->count();
        $list = $cursor->skip(($page - 1) * $pagesize)->take($pagesize)->get();
        
        return [$count, $list];
    }
}