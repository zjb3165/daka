<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/03
 */
 
namespace App\Http\Requests\Api;

class AdminInsertRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'username' => 'required|unique:admins',
            'name' => 'required',
            'password' => 'required|min:6|max:20'
        ];
    }
    
    public function messages()
    {
        return [
            'username.required' => '未填写用户名',
            'username.unique' => '用户名已存在',
            'name.required' => '未填写姓名',
            'password.required' => '未填写密码',
            'password.min' => '密码不能小于6位',
            'password.max' => '密码不能大于20位',
        ];
    }
}