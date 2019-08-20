<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/20
 */
namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController as Controller;

class BaseController extends Controller
{
    /**
     * \App\Models\Member
     */
    protected $member;

    public function __construct()
    {
        parent::__construct();
        $this->middleware(function($request, $next){
            $this->member = auth('front')->user();
            return $next($request);
        });
    }
}