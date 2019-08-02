<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/01
 */
namespace App\Http\Controllers\Api\Sys;

use App\Repo\AdminRepo;
use App\Http\Controllers\Api\BaseController;
use App\Models\ApiErrorCode;

class AuthController extends BaseController 
{
    /**
     * \App\Repo\AdminRepo
     */
    private $adminRepo;

    public function __construct(AdminRepo $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    /**
     * 用户登陆
     * @route   /api/sys/login
     * @method  post
     * @param string    $username
     * @param string    $password
     * @return json
     */
    public function login()
    {
        $username = request('username');
        $password = request('password');
        $admin = $this->adminRepo->login($username, $password);
        if ($admin == null) {
            return $this->error(ApiErrorCode::LOGIN_ERROR, '用户名或密码错误');
        }
        
        $token = auth('api')->login($admin);
        $expires_in = auth('api')->factory()->getTTL() * 60;
        $userInfo = [
            'id' => $admin->id,
            'name' => $admin->name,
            'username' => $admin->username,
        ];
        return $this->success(['user'=>$userInfo, 'token'=>$token, 'expires'=>$expires_in]);
    }
    
    /**
     * 退出
     */
    public function logout()
    {
        auth('api')->logout();
        return $this->success();
    }
    
    /**
     * 刷新token
     */
    public function refresh()
    {
        $token = auth('api')->refresh();
        $expires_in = auth('api')->factory()->getTTL() * 60;
        return $this->success(['token'=>$token, 'expires'=>$expires_in]);
    }

    /**
     * 修改管理员密码
     * @route   /api/sys/password
     * @method  post
     * @param string    $old_password
     * @param string    $new_password
     * @return json
     */
    public function updatePassword()
    {
        $admin = auth('api')->user();
        $old_pwd = request('old_password');
        $new_pwd = request('new_password');

        if (! \Hash::check($old_pwd, $admin->password)) {
            return $this->error(ApiErrorCode::OLD_PASSWORD_ERROR, '旧密码错误');
        }
        if ($new_pwd == '' || strlen($new_pwd) < 6 || strlen($new_pwd) > 20) {
            return $this->error(ApiErrorCode::NEW_PASSWORD_ERROR, '新密码错误');
        }
        
        $this->adminRepo->updatePassword($admin, $new_pwd);
        return $this->success();
    }

    public function info()
    {
        $admin = auth('api')->user();
        $userInfo = [
            'id' => $admin->id,
            'name' => $admin->name,
            'username' => $admin->username,
        ];
        $token = auth('api')->refresh();
        $expires_in = auth('api')->factory()->getTTL() * 60;
        return $this->success(['user'=>$userInfo, 'token'=>$token, 'expires'=>$expires_in]);
    }
}