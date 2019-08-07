<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/07
 */
 
namespace App\Http\Requests\Api;

class GoalRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'sometimes|required',
            'start_time' => 'required|between:0,24',
            'end_time' => 'required|between:0,24',
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => '打卡目标名称不能为空',
            'start_time' => '打卡开始时间必须在0-24小时内',
            'end_time' => '打卡开始时间必须在0-24小时内',
        ];
    }
}