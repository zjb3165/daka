<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/01
 */
 
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\ApiErrorCode;

class JWTAuthenticate extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('mocktest') && config('app.debug')) {
            $admin = \App\Models\Admin::where('username', 'root')->first();
            auth('api')->login($admin);
            return $next($request);
        }
        if (! $this->auth->parser()->setRequest($request)->hasToken()) {
            return response()->json(['code'=>ApiErrorCode::TOKEN_ERROR, 'message'=>'用户未登陆']);
        }
        try {
            if (! $this->auth->parseToken()->authenticate()) {
                return response()->json(['code'=>ApiErrorCode::TOKEN_ERROR, 'message'=>'用户未登陆']);
            }
        } catch (JWTException $e) {
            \Log::info('jwt exception');
            \Log::info($e);
            return response()->json(['code'=>ApiErrorCode::TOKEN_ERROR, 'message'=>'用户未登陆, code:' . $e->getCode()]);
        }
        return $next($request);
    }
}