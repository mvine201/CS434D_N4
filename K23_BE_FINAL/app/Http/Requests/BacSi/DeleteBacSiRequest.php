<?php

namespace App\Http\Requests\BacSi;

use Illuminate\Foundation\Http\FormRequest;

class DeleteBacSiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'id.exists' => 'ID bác sĩ không tồn tại trong hệ thống'
        ];
    }
}
