<?php

namespace App\Http\Requests\BenhNhan;

use Illuminate\Foundation\Http\FormRequest;

class BenhNhanDoiMatKhauRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'id_benh_nhan' => 'required|exists:benh_nhans,hash_reset',
            'password' => 'required|min:6|max:50',
            're_password' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'id_benh_nhan.required' => 'ID bệnh nhân không được để trống',
            'id_benh_nhan.exists' => 'ID bệnh nhân không tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được quá 50 ký tự',
            're_password.required' => 'Nhập lại mật khẩu không được để trống',
            're_password.same' => 'Nhập lại mật khẩu không đúng',
        ];
    }
}
