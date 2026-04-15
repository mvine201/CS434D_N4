<?php

namespace App\Http\Requests\ChuyenKhoa;

use Illuminate\Foundation\Http\FormRequest;

class CreateChuyenKhoaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ten_chuyen_khoa' => 'required|string|unique:chuyen_khoas,ten_chuyen_khoa',
            'mo_ta'           => 'required|string|min:10',
            'tinh_trang'      => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'ten_chuyen_khoa.required' => 'Tên chuyên khoa không được để trống',
            'ten_chuyen_khoa.string'   => 'Tên chuyên khoa phải là chuỗi ký tự',
            'ten_chuyen_khoa.unique'   => 'Tên chuyên khoa đã tồn tại trong hệ thống',
            'mo_ta.required'           => 'Mô tả không được để trống',
            'mo_ta.string'             => 'Mô tả phải là chuỗi ký tự',
            'mo_ta.min'                => 'Mô tả phải có ít nhất 10 ký tự',
            'tinh_trang.required'     => 'Trạng thái không được để trống',
            'tinh_trang.boolean'      => 'Trạng thái phải là boolean',
        ];
    }
}
