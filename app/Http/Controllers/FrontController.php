<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/20
 */
namespace App\Http\Controllers;
use App\Repo\MemberRepo;
use App\Repo\SettingRepo;
use App\Models\Member;

class FrontController extends Controller {
    /**
     * @var \App\Repo\MemberRepo
     */
    private $repo;
    
    /**
     * @var \App\Repo\SettingRepo
     */
    private $setting;

    /**
     * @var \App\Models\Member
     */
    private $member;
    
    public function __construct(MemberRepo $repo, SettingRepo $setting)
    {
        $this->repo = $repo;
        $this->setting = $setting;
    }
    
    /**
     * @route /
     */
    public function index()
    {
        return view('front');
    }

    /**
     * @route /unsubscribed
     */
    public function unsubscribed()
    {
        $params = $this->setting->get('wechat');
        return view('unsubscribed', ['setting'=>$params]);
    }
}