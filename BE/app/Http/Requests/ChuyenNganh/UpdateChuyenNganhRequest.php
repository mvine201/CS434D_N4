<?php

namespace App\Http\Requests\ChuyenNganh;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChuyenNganhRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'              => 'required|integer|exists:chuyen_nganhs, id',
            'ten_chuyen_nganh' => 'required|string|max:100|min:6|unique:chuyen_khoas,ten_chuyen_khoa',
            'ten_chuyen_nganh' => 'required|string|max:100|min:6|unique:chuyen_nganhs,ten_chuyen_nganh',
        ];
    }
    public function messages()
    {
        return [
            'ten_chuyen_khoa.required' => 'Tên chuyên khoa không được để trống',
            'ten_chuyen_khoa.string'   => 'Tên chuyên khoa phải là chuỗi ký tự',
            'ten_chuyen_khoa.unique'   => 'Tên chuyên khoa đã tồn tại trong hệ thống',
            'ten_chuyen_khoa.max'      => 'Tên chuyên khoa không được vượt quá 100 ký tự',
            'ten_chuyen_khoa.min'      => 'Tên chuyên khoa phải có ít nhất 6 ký tự',
            'id.required'              => 'ID không được để trống',
            'id.integer'              => 'ID phải là số',
            'id.exists'               => 'ID đã tồn tại',
            'ten_chuyen_nganh.required' => 'Tên chuyên nganh không được để trống',
            'ten_chuyen_nganh.string'   => 'Tên chuyên nganh phải là chuỗi ký tự',
            'ten_chuyen_nganh.unique'   => 'Tên chuyên nganh đã tồn tại trong hệ thống',
            'ten_chuyen_nganh.max'      => 'Tên chuyên nganh không được vượt quá 100 ký tự',
            'ten_chuyen_nganh.min'      => 'Tên chuyên nganh phải có ít nhất 6 ký tự',
        ];
    }
}
