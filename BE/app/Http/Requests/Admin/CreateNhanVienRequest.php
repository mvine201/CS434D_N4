<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateNhanVienRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ho_ten'       => 'required|string|max:50|min:6',
            'email'        => 'required|email|unique:admins,email' . $this->id,
            'so_dien_thoai' => 'required|digits:10|unique:admins,so_dien_thoai' . $this->id,
            'id_chuc_vu'   => 'required|exists:chuc_vus,id',
            'tinh_trang'   => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required'       => 'Họ tên không được để trống',
            'ho_ten.string'         => 'Họ tên phải là chuỗi ký tự',
            'ho_ten.max'            => 'Họ tên không được vượt quá 50 ký tự',
            'ho_ten.min'            => 'Họ tên phải có ít nhất 6 ký tự',
            'email.required'        => 'Email không được để trống',
            'email.email'           => 'Email không hợp lệ',
            'email.unique'          => 'Email đã tồn tại trong hệ thống',
            'so_dien_thoai.required'=> 'Số điện thoại không được để trống',
            'so_dien_thoai.digits'  => 'Số điện thoại phải có 10 chữ số',
            'so_dien_thoai.unique'  => 'Số điện thoại đã tồn tại trong hệ thống',
            'id_chuc_vu.required'   => 'Chức vụ không được để trống',
            'id_chuc_vu.exists'     => 'Chức vụ không tồn tại trong hệ thống',
            'tinh_trang.required'   => 'Trạng thái không được để trống',
            'tinh_trang.boolean'    => 'Trạng thái phải là boolean',
        ];
    }
}
