<?php

namespace App\Http\Requests\BacSi;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaiKhoanBacSiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ho_ten' => 'required|string|max:100|min:2',
            'email' => 'required|email|unique:bac_sis,email',
            'password' => 'required|min:6|max:50',
            're_password' => 'required|same:password',
            'so_dien_thoai' => 'required|digits:10',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|boolean',
            'dia_chi' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required' => 'Họ tên không được để trống',
            'ho_ten.string' => 'Họ tên phải là chuỗi ký tự',
            'ho_ten.max' => 'Họ tên không được vượt quá 100 ký tự',
            'ho_ten.min' => 'Họ tên phải có ít nhất 2 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được vượt quá 50 ký tự',
            're_password.required' => 'Mật khẩu nhập lại không được để trống',
            're_password.same' => 'Mật khẩu nhập lại không khớp',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits' => 'Số điện thoại phải có 10 chữ số',
            'ngay_sinh.required' => 'Ngày sinh không được để trống',
            'ngay_sinh.date' => 'Ngày sinh không hợp lệ',
            'gioi_tinh.required' => 'Giới tính không được để trống',
            'gioi_tinh.boolean' => 'Giới tính phải là 0 (Nữ) hoặc 1 (Nam)',
            'dia_chi.required' => 'Địa chỉ không được để trống',
            'dia_chi.string' => 'Địa chỉ phải là chuỗi ký tự',
        ];
    }
}
