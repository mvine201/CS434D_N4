<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeleteChucVuRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:chuc_vus,id',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Chức vụ không được để trống',
            'id.exists'   => 'Chức vụ không tồn tại trong hệ thống',
        ];
    }
}
