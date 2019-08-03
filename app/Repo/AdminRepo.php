<?php
/**
 * Author: Jumper Swordwave
 * Date:2019/08/01
 */
 
namespace App\Repo;

use App\Models\Admin;
use App\Repo\Exceptions\RepoException;

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
        if ($admin == null || ! \Hash::check($password, $admin->password)) return null;

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

    /**
     * 检测用户名是否已存在
     * @param string    $username
     * @return boolean
     */
    public function exists($username)
    {
        $admin = Admin::where('username', $username)->first();
        return $admin != null;
    }

    /**
     * 添加管理员
     * @param string    $username
     * @param string    $name
     * @param string    $password
     * @return \App\Models\Admin
     */
    public function add($username, $name, $password, $permissions=[])
    {
        if ($username == '' || $name == '' || $password == '') {
            throw new RepoException('添加失败，username or name or password 为空');
        }
        if ($this->exists($username)) {
            throw new RepoException('用户名已存在');
        }
        
        $admin = new Admin();
        $admin->username = $username;
        $admin->name = $name;
        $admin->password = bcrypt($password);
        $admin->permissions = [];
        $admin->save();

        return $admin;
    }

    /**
     * 更新管理员信息
     * @param integer|\App\Models\Admin     $admin
     * @param string                        $name
     * @param string                        $password   不修改密码则留空
     * @return \App\Models\Admin
     */
    public function update($admin_or_id, $name, $password='', $permissions=[])
    {
        if (is_numeric($admin_or_id)) {
            $admin = $this->getById($admin_or_id);
        } else {
            $admin = $admin_or_id;
        }
        if ($admin == null) {
            throw new RepoException('修改的管理员信息不存在');
        }
        $admin->name = $name;
        if ($admin->password != '') {
            $admin->password = bcrypt($password);
        }
        $admin->permissions = $permissions;
        $admin->save();
        return $admin;
    }
    
    /**
     * 删除管理员
     * @param integer|\App\Models\Admin     $admin
     * @param boolean
     */
    public function delete($admin_or_id)
    {
        if (is_numeric($admin_or_id)) {
            $admin = $this->getById($admin_or_id);
        } else {
            $admin = $admin_or_id;
        }
        
        if ($admin != null) {
            if ($admin->username === 'root') return false;  //不能删除root用户
            $admin->delete();
        }
        return true;
    }
}