<?php

namespace App\Http\Requests\BenhNhan;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaiKhoanBenhNhanRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
                'email'        => 'required|email|unique:benh_nhans,email',
                'password'     => 'required|min:6|max:50',
                're_password'  => 'required|same:password',
                'ho_ten'    => 'required|max:255',
                'so_dien_thoai'=> 'required|digits:10',
                'ngay_sinh'    => 'required|date',
                'gioi_tinh'    => 'required|boolean',
                'dia_chi'      => 'required|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required'            => "Bạn chưa nhập email.",
            'email.email'               => "Email không hợp lệ.",
            'email.unique'              => "Email đã được sử dụng.",
            'password.required'         => "Bạn chưa nhập mật khẩu.",
            'password.min'              => "Mật khẩu phải có ít nhất 6 ký tự.",
            'password.max'              => "Mật khẩu không được quá 50 ký tự.",
            're_password.required'      => "Mật khẩu nhập lại chưa nhập",
            're_password.same'          => "Mật khẩu nhập lại không khớp",
            'ho_ten.required'           => "Bạn chưa nhập họ và tên.",
            'ho_ten.max'                => "Họ và tên không được quá 255 ký tự.",
            'so_dien_thoai.required'    => "Bạn chưa nhập số điện thoại.",
            'so_dien_thoai.digits'      => "Số điện thoại phải có 10 chữ số.",
            'ngay_sinh.required'        => "Bạn chưa nhập ngày sinh.",
            'ngay_sinh.date'            => "Ngày sinh không hợp lệ.",
            'gioi_tinh.required'        => "Bạn chưa chọn giới tính.",
            'gioi_tinh.boolean'         => "Giới tính không hợp lệ.",
            'dia_chi.required'          => "Bạn chưa nhập địa chỉ.",
            'dia_chi.max'               => "Địa chỉ không được quá 255 ký tự.",
        ];
    }
}
