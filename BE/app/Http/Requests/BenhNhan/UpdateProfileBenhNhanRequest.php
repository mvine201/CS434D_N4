<?php

namespace App\Http\Requests\BenhNhan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileBenhNhanRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ho_ten' => 'required|max:255',
            'so_dien_thoai' => 'required|digits:10',
            'email' => 'required|email|unique:benh_nhans,email,' . $this->id,
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|boolean',
            'dia_chi' => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required' => 'Họ và tên không được để trống',
            'ho_ten.max' => 'Họ và tên không được quá 255 ký tự',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits' => 'Số điện thoại phải có 10 chữ số',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'ngay_sinh.required' => 'Ngày sinh không được để trống',
            'ngay_sinh.date' => 'Ngày sinh phải là một ngày hợp lệ',
            'gioi_tinh.required' => 'Giới tính không được để trống',
            'gioi_tinh.boolean' => 'Giới tính phải là true hoặc false',
            'dia_chi.required' => 'Địa chỉ không được để trống',
            'dia_chi.max' => 'Địa chỉ không được quá 255 ký tự',
        ];
    }
}
