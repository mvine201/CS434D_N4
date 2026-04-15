<?php

namespace App\Http\Requests\BacSi;

use Illuminate\Foundation\Http\FormRequest;

class TimKiemBacSiRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'noi_dung_tim' => 'required|string|min:1|max:100'
        ];
    }

    public function messages()
    {
        return [
            'noi_dung_tim.required' => 'Vui lòng nhập từ khóa tìm kiếm',
            'noi_dung_tim.string'   => 'Từ khóa tìm kiếm phải là chuỗi ký tự',
            'noi_dung_tim.min'      => 'Từ khóa tìm kiếm phải có ít nhất 1 ký tự',
            'noi_dung_tim.max'      => 'Từ khóa tìm kiếm không được vượt quá 100 ký tự'
        ];
    }
}
