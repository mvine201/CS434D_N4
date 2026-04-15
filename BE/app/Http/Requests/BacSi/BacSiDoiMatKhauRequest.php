<?php

namespace App\Http\Requests\BacSi;

use Illuminate\Foundation\Http\FormRequest;

class BacSiDoiMatKhauRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_bac_si' => 'required|exists:bac_sis,hash_reset',
            'password' => 'required|min:6|max:50',
            're_password' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'id_bac_si.required' => 'ID bác sĩ không được để trống',
            'id_bac_si.exists' => 'ID bác sĩ không tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được quá 50 ký tự',
            're_password.required' => 'Nhập lại mật khẩu không được để trống',
            're_password.same' => 'Nhập lại mật khẩu không đúng',
        ];
    }
}
