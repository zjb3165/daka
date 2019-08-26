<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use EasyWeChat\OfficialAccount\Application as WechatApplication;
use App\Repo\MemberRepo;

class WeChatAuthenticate
{
    /**
     * \EasyWeChat\OfficialAccount\Application
     */
    private $wechat;
    
    /**
     * \App\Repo\MemberRepo
     */
    private $repo;

    public function __construct(MemberRepo $repo, WechatApplication $wechat)
    {
        $this->repo = $repo;
        $this->wechat = $wechat;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth('front')->guest()) {
            if (config('app.debug')) {
                $member = auth('front')->user();
                if ($member == null) {
                    $member = $this->repo->getMemberById(4);
                    auth('front')->login($member);
                    return $next($request);
                }
            }
            if ($request->has('code')) {
                $user = $this->wechat->oauth->user();

                $openid = $user->getId();
                $member = $this->repo->getMemberByOpenid($openid);
                if ($member == null) {
                    //未注册用户
                    $newUser = $this->wechat->user->get($openid);
                    if ($newUser['subscribe']) {
                        //关注过公众号的用户
                        $member = $this->repo->newMember($newUser);
                    } else {
                        //未关注过公众号的用户
                        return redirect()->route('front.unsubscribed');
                    }
                }

                auth('front')->login($member);
                return redirect()->to($this->getTargetUrl($request));
            }

            return $this->wechat->oauth->scopes(['snsapi_base'])->redirect($request->fullUrl());
        }
        return $next($request);
    }
    
    protected function getTargetUrl($request)
    {
        $queries = array_except($request->query(), ['code', 'state']);
        return $request->url().(empty($queries) ? '' : '?'.http_build_query($queries));
    }
}
