<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/20
 */
namespace App\Http\Controllers\Api\Front;

class MemberController extends BaseController
{
    /**
     * 返回登陆用户信息
     * @router /api/front/member
     */
    private function getMember()
    {
        $member = [
            'id' => $this->member->id,
            'nickname' => $this->member->nickname,
            'avatar' => $this->member->avatar,
        ];
        return $this->success(['member'=>$member]);
    }
}