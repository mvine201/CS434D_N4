<?php

namespace App\Http\Requests\HoSoBenhNhan;

use Illuminate\Foundation\Http\FormRequest;

class DeleteHoSoBenhAnRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:chi_tiet_dat_lichs,id'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'ID hồ sơ bệnh án là bắt buộc',
            'id.exists' => 'Hồ sơ bệnh án không tồn tại'
        ];
    }
}
