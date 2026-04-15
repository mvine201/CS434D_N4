<?php

namespace App\Http\Requests\BacSi;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordBacSiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'password' => 'required|min:6|max:50',
            'new_password' => 'required|min:6|max:50',
            're_newpassword' => 'required|min:6|max:50|same:new_password',
        ];
    }
    public function messages()
    {
        return[
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được quá 50 ký tự',
            'new_password.required' => 'Mật khẩu mới không được để trống',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
            'new_password.max' => 'Mật khẩu mới không được quá 50 ký tự',
            're_newpassword.required' => 'Nhập lại mật khẩu không được để trống',
            're_newpassword.min' => 'Nhập lại mật khẩu phải có ít nhất 6 ký tự',
            're_newpassword.max' => 'Nhập lại mật khẩu không được quá 50 ký tự',
            're_newpassword.same' => 'Nhập lại mật khẩu không đúng'
        ];
    }
}
