<?php

namespace App\Http\Requests\LichHen;

use Illuminate\Foundation\Http\FormRequest;

class CreateLichHenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_benh_nhan' => 'required|exists:benh_nhans,id',
            'id_bac_si' => 'required|exists:bac_sis,id',
            'ngay_hen' => 'required|date',
            'gio_hen' => ['required','regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'ly_do_kham' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'id_benh_nhan.required' => 'Vui lòng chọn bệnh nhân',
            'id_benh_nhan.exists' => 'Bệnh nhân không tồn tại',
            'id_bac_si.required' => 'Vui lòng chọn bác sĩ',
            'id_bac_si.exists' => 'Bác sĩ không tồn tại',
            'ngay_hen.required' => 'Vui lòng chọn ngày hẹn',
            'gio_hen.required' => 'Vui lòng chọn giờ hẹn',
            'gio_hen.regex' => 'Giờ hẹn không hợp lệ (HH:mm hoặc HH:mm:ss)',
            'ly_do_kham.required' => 'Vui lòng nhập lý do khám',
            'ly_do_kham.max' => 'Lý do khám tối đa 500 ký tự',
        ];
    }
}


