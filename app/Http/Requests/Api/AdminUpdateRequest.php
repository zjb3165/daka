<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/03
 */
 
namespace App\Http\Requests\Api;

class AdminUpdateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'sometimes|min:6|max:20',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => '未填写姓名',
            'password.min' => '密码不能小于6位',
            'password.max' => '密码不能大于20位',
        ];
    }
}