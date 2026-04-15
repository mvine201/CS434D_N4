<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeleteNhanVienRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:admins,id',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Nhân viên không được để trống',
            'id.exists'   => 'Nhân viên không tồn tại trong hệ thống',
        ];
    }
}
