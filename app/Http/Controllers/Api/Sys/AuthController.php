<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/01
 */
namespace App\Http\Controllers\Api\Sys;

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
        //todo get token
        
        $token = '';
        $userInfo = [
            'id' => $admin->id,
            'name' => $admin->name,
            'username' => $admin->username,
        ];
        return $this->success(['user'=>$userInfo, 'token'=>$token]);
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
        $admin = Admin::query()->first();   //todo
        $old_pwd = request('old_password');
        $new_pwd = request('new_password');

        if ($admin->password != bcrypt($old_pwd)) {
            return $this->error(ApiErrorCode::OLD_PASSWORD_ERROR, '旧密码错误');
        }
        if ($new_pwd == '' || strlen($new_pwd) < 6 || strlen($new_pwd) > 20) {
            return $this->error(ApiErrorCode::NEW_PASSWORD_ERROR, '新密码错误');
        }
        
        $this->adminRepo->updatePassword($admin, $new_pwd);
        return $this->success();
    }
}