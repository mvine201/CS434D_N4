<?php

namespace App\Http\Requests\BenhNhan;

use Illuminate\Foundation\Http\FormRequest;

class DeleteBenhNhanRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:benh_nhans,id',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Bệnh nhân không được để trống',
            'id.exists'   => 'Bệnh nhân không tồn tại trong hệ thống',
        ];
    }
}
