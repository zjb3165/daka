<?php
/**
 * Author: Jumper Swordwave
 * Date:2019/08/01
 */
 
namespace App\Repo;

use App\Models\Admin;

class AdminRepo
{
    /**
     * 管理员登陆判断
     * @param string    $username
     * @param string    $password
     * @return \App\Models\Admin
     */
    public function login($username, $password)
    {
        $admin = Admin::where('username', $username)->first();
        if ($admin == null) return null;
        
        if ($admin->password != bcrypt($password)) return null;

        return $admin;
    }

    /**
     * 修改密码
     * @param \App\Models\Admin     $admin
     * @param string                $pwd
     * @return boolean
     */
    public function updatePassword(Admin $admin, $pwd)
    {
        $admin->password = bcrypt($pwd);
        $admin->save();
        return true;
    }
    
    /**
     * 根据id读取管理员信息
     * @param integer   $id
     * @return \App\Models\Admin
     */
    public function getById($id)
    {
        return Admin::find($id);
    }
    
    /**
     * 读取管理员列表
     * @return array
     */
    public function getList()
    {
        return Admin::query()->orderBy('id', 'asc')->get();
    }
}