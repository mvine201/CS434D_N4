<?php

namespace App\Http\Requests\BacSi;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusBacSiRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:bac_sis,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'ID bác sĩ không được để trống',
            'id.exists'   => 'Bác sĩ không tồn tại trong hệ thống'
        ];
    }
}
