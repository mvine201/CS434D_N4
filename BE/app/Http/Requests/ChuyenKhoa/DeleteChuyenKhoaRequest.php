<?php

namespace App\Http\Requests\ChuyenKhoa;

use Illuminate\Foundation\Http\FormRequest;

class DeleteChuyenKhoaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:chuyen_khoas,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Chuyên khoa không được để trống',
            'id.exists'   => 'Chuyên khoa không tồn tại trong hệ thống',
        ];
    }
}
