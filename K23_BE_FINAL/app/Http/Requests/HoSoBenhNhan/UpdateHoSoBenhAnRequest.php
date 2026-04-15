<?php

namespace App\Http\Requests\HoSoBenhNhan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHoSoBenhAnRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:chi_tiet_dat_lichs,id',
            'id_benh_nhan' => 'required|exists:benh_nhans,id',
            'id_bac_si' => 'required|exists:bac_sis,id',
            'ngay_dat_hen' => 'required|date',
            'trang_thai' => 'required|integer|between:0,3',
            'ly_do_kham' => 'required|string|max:500',
            'chuan_doan' => 'required|string|max:1000',
            'don_thuoc' => 'required|string|max:1000',
            'ghi_chu' => 'required|string|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'ID hồ sơ bệnh án là bắt buộc',
            'id.exists' => 'Hồ sơ bệnh án không tồn tại',
            'id_benh_nhan.required' => 'Vui lòng chọn bệnh nhân',
            'id_benh_nhan.exists' => 'Bệnh nhân không tồn tại',
            'id_bac_si.required' => 'Vui lòng chọn bác sĩ',
            'id_bac_si.exists' => 'Bác sĩ không tồn tại',
            'ngay_dat_hen.required' => 'Vui lòng chọn ngày đặt hẹn',
            'ngay_dat_hen.date' => 'Ngày đặt hẹn không hợp lệ',
            'trang_thai.required' => 'Vui lòng chọn trạng thái',
            'trang_thai.integer' => 'Trạng thái phải là số nguyên',
            'trang_thai.between' => 'Trạng thái phải từ 0 đến 3',
            'ly_do_kham.required' => 'Vui lòng nhập lý do khám',
            'ly_do_kham.max' => 'Lý do khám không được quá 500 ký tự',
            'chuan_doan.required' => 'Vui lòng nhập chuẩn đoán',
            'chuan_doan.max' => 'Chuẩn đoán không được quá 1000 ký tự',
            'don_thuoc.max' => 'Đơn thuốc không được quá 1000 ký tự',
            'ghi_chu.required' => 'Vui lòng nhập ghi chú',
            'ghi_chu.max' => 'Ghi chú không được quá 1000 ký tự'
        ];
    }
}
