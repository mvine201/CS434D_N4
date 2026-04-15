<?php

namespace App\Http\Requests\LichLamViec;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateLichLamViecRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_bac_si' => 'required|integer|exists:bac_sis,id',
            'ngay_lam_viec' => 'required|date|after_or_equal:today',
            'thoi_gian_bat_dau' => 'required|date_format:H:i',
            'thoi_gian_ket_thuc' => 'required|date_format:H:i|after:thoi_gian_bat_dau',
        ];
    }

    public function messages(): array
    {
        return [
            'id_bac_si.required' => 'ID bác sĩ là bắt buộc',
            'id_bac_si.integer' => 'ID bác sĩ phải là số nguyên',
            'id_bac_si.exists' => 'Bác sĩ không tồn tại',
            'ngay_lam_viec.required' => 'Ngày làm việc là bắt buộc',
            'ngay_lam_viec.date' => 'Ngày làm việc phải là định dạng ngày hợp lệ',
            'ngay_lam_viec.after_or_equal' => 'Ngày làm việc phải từ hôm nay trở đi',
            'thoi_gian_bat_dau.required' => 'Thời gian bắt đầu là bắt buộc',
            'thoi_gian_bat_dau.date_format' => 'Thời gian bắt đầu phải có định dạng HH:MM',
            'thoi_gian_ket_thuc.required' => 'Thời gian kết thúc là bắt buộc',
            'thoi_gian_ket_thuc.date_format' => 'Thời gian kết thúc phải có định dạng HH:MM',
            'thoi_gian_ket_thuc.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu',
        ];
    }
}
