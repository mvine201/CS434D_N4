<?php

namespace App\Http\Requests\BenhNhan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBenhNhanRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'ho_ten'        => 'required|string|max:50|min:6',
            'email'         => 'required|email|unique:benh_nhans,email,' . $this->id,
            'so_dien_thoai' => 'required|digits:10',
            'tinh_trang'    => 'required|boolean',
            'ngay_sinh'     => 'required|date',
            'gioi_tinh'     => 'required|boolean',
            'dia_chi'       => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'ho_ten.required'        => 'Họ tên không được để trống',
            'ho_ten.string'          => 'Họ tên phải là chuỗi ký tự',
            'ho_ten.max'             => 'Họ tên không được vượt quá 50 ký tự',
            'ho_ten.min'             => 'Họ tên phải có ít nhất 6 ký tự',
            'email.required'         => 'Email không được để trống',
            'email.email'            => 'Email không hợp lệ',
            'email.unique'           => 'Email đã tồn tại trong hệ thống',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits'   => 'Số điện thoại phải có 10 chữ số',
            'tinh_trang.required'    => 'Tình trạng không được để trống',
            'tinh_trang.boolean'     => 'Tình trạng phải là true hoặc false',
            'ngay_sinh.required'     => 'Ngày sinh không được để trống',
            'ngay_sinh.date'         => 'Ngày sinh phải là một ngày hợp lệ',
            'gioi_tinh.required'     => 'Giới tính không được để trống',
            'gioi_tinh.boolean'      => 'Giới tính phải là true hoặc false',
            'dia_chi.required'       => 'Địa chỉ không được để trống',
            'dia_chi.string'         => 'Địa chỉ phải là chuỗi ký tự',
        ];
    }
}
