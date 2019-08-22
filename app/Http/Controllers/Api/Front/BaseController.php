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
        if (config('app.debug') && request('mock')) {
            $this->member = \App\Models\Member::query()->orderBy('id', 'asc')->first();
        } else {
            $this->middleware(function($request, $next){
                $this->member = auth('front')->user();
                return $next($request);
            });
        }
    }
}