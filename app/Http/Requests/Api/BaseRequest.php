<?php
/**
 * Author: Jumper Swordwave
 * Date: 2019/08/03
 */
 
namespace App\Http\Requests\Api;

use Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\ApiErrorCode;

class BaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function failedValidation($validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException(response()->json(['code'=>ApiErrorCode::VALIDATE_ERROR, 'message'=>'验证失败，原因：' . implode(',', $errors)]));
    }
}