<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateProfileRequest extends FormRequest
{
   public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ho_ten' => 'required|max:100|min:2',
            'email' => 'required|email|unique:admins,email,' . $this->id,
            'so_dien_thoai' => 'required|digits:10',
            'hinh_anh' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required' => 'Họ tên không được để trống',
            'ho_ten.max' => 'Họ tên không được vượt quá 100 ký tự',
            'ho_ten.min' => 'Họ tên phải có ít nhất 2 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits' => 'Số điện thoại phải có 10 chữ số',
            'hinh_anh.required' => 'Ảnh không được để trống',
        ];
    }
}
