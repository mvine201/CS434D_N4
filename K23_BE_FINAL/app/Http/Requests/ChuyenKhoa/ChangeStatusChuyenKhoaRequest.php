<?php

namespace App\Http\Requests\ChuyenKhoa;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusChuyenKhoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:chuyen_khoas,id'
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'ID chuyên khoa không được để trống',
            'id.exists'   => 'Chuyên khoa không tồn tại trong hệ thống'
        ];
    }
}
