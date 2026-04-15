<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateChucVuRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ten_chuc_vu' => 'required|string|max:100|min:6|unique:chuc_vus,ten_chuc_vu',
        ];
    }
    public function messages()
    {
        return [
            'ten_chuc_vu.required' => 'Tên chức vụ không được để trống',
            'ten_chuc_vu.string'   => 'Tên chức vụ phải là chuỗi ký tự',
            'ten_chuc_vu.unique'   => 'Tên chức vụ đã tồn tại trong hệ thống',
            'ten_chuc_vu.max'      => 'Tên chức vụ không được vượt quá 100 ký tự',
            'ten_chuc_vu.min'      => 'Tên chức vụ phải có ít nhất 6 ký tự',
        ];
    }
}
