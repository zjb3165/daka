<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/08
 */
 
namespace App\Http\Controllers\Api\Sys;

use App\Http\Controllers\Api\BaseController;
use App\Models\ApiErrorCode;
use App\Models\Member;
use App\Repo\MemberRepo;

class MemberController extends BaseController
{
    /**
     * @var \App\Repo\MemberRepo;
     */
    private $repo;
    
    public function __construct(MemberRepo $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * 会员列表
     * @route /api/sys/member
     * @param integer   $parent_id
     * @param string    $nickname
     * @param string    $order
     * @param integer   $page
     * @param integer   $pagesize
     */
    public function index()
    {
        $parent_id = intval(request('parent_id'));
        $nickname = request('nickname');
        $order = request('order');
        $page = max(1, intval(request('page')));
        $pagesize = max(1, intval(request('pagesize', 10)));

        list($count, $list) = $this->repo->getMemberList($parent_id, $nickname, $order, $page, $pagesize, ['parent']);
        $list = $list->map(function($m){
            return $m->getInfo();
        })->toArray();
        
        return $this->success(['list'=>$list, 'count'=>$count, 'pages'=>ceil($count / $pagesize)]);
    }
    
    /**
     * 会员详情
     * @route /api/sys/member/{id}
     * @param integer   $id
     */
    public function show($id)
    {
        $member = $this->repo->getMemberById($id);
        if ($member == null) {
            return $this->error(ApiErrorCode::NOTFOUND, '会员不存在');
        }
        
        return $this->success(['member'=>$member->getInfo()]);
    }
    
    /**
     * 更新会员信息
     * @route /api/sys/member/{id}
     * @method post
     * @param integer   $id
     */
    public function update($id)
    {
        $member = $this->repo->getMemberById($id);
        if ($member == null) {
            return $this->error(ApiErrorCode::NOTFOUND, '会员不存在');
        }
        
        $member = $this->repo->updateMember($member, request()->all());

        return $this->success(['member'=>$member->getInfo()]);
    }
}