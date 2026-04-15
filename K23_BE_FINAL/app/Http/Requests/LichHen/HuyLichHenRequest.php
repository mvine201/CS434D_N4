<?php

namespace App\Http\Requests\LichHen;

use Illuminate\Foundation\Http\FormRequest;

class HuyLichHenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:phieu_dat_lichs,id',
            'ly_do_huy' => 'nullable|string|max:500',
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


