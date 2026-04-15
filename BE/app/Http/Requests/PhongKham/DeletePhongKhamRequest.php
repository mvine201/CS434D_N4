<?php

namespace App\Http\Requests\PhongKham;

use Illuminate\Foundation\Http\FormRequest;

class DeletePhongKhamRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:phong_khams,id',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Phòng khám không được để trống',
            'id.exists'   => 'Phòng khám không tồn tại trong hệ thống',
        ];
    }
}
