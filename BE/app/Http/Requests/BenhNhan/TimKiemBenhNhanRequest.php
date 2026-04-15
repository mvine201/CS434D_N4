<?php

namespace App\Http\Requests\BenhNhan;

use Illuminate\Foundation\Http\FormRequest;

class TimKiemBenhNhanRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tim_kiem' => 'required|string|min:1|max:100'
        ];
    }

    public function messages()
    {
        return [
            'tim_kiem.required' => 'Vui lòng nhập từ khóa tìm kiếm',
            'tim_kiem.string'   => 'Từ khóa tìm kiếm phải là chuỗi ký tự',
            'tim_kiem.min'      => 'Từ khóa tìm kiếm phải có ít nhất 1 ký tự',
            'tim_kiem.max'      => 'Từ khóa tìm kiếm không được vượt quá 100 ký tự'
        ];
    }
}
