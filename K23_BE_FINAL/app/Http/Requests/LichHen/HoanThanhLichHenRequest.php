<?php

namespace App\Http\Requests\LichHen;

use Illuminate\Foundation\Http\FormRequest;

class HoanThanhLichHenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:chi_tiet_dat_lichs,id',
            'don_thuoc' => 'nullable|string',
            'chuan_doan' => 'nullable|string',
            'ghi_chu' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'ID lịch hẹn là bắt buộc',
            'id.exists' => 'Lịch hẹn không tồn tại',
        ];
    }
}


