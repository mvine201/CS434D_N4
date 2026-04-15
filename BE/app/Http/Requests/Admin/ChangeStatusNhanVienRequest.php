<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusNhanVienRequest extends FormRequest
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
            'id' => 'required|exists:admins,id',
            'tinh_trang' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'ID không được để trống.',
            'id.exists' => 'ID không tồn tại.',
            'tinh_trang.required' => 'Trạng thái không được để trống.',
            'tinh_trang.boolean' => 'Trạng thái phải là boolean.',
        ];
    }
}
