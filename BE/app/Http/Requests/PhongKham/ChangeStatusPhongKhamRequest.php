<?php

namespace App\Http\Requests\PhongKham;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusPhongKhamRequest extends FormRequest
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
            'id' => 'required|exists:phong_khams,id'
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'ID phòng khám không được để trống.',
            'id.exists' => 'ID phòng khám không tồn tại.',
        ];
    }
}
