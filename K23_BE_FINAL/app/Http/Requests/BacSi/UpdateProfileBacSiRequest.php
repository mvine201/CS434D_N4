<?php

namespace App\Http\Requests\BacSi;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileBacSiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ho_ten' => 'required|max:100|min:2',
            'email' => 'required|email|unique:bac_sis,email,' . $this->id,
            'so_dien_thoai' => 'required|digits:10',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|boolean',
            'id_phong_kham' => 'required|exists:phong_khams,id',
            'chuc_danh' => 'required|max:100',
            'so_nam_kinh_nghiem' => 'required|integer|min:0|max:50',
            'mo_ta' => 'required|max:500',
            'kinh_nghiem_lam_viec' => 'required|max:1000',
            'qua_trinh_dao_tao' => 'required|max:1000',
            'chung_chi' => 'required|max:500',
            'thanh_tuu' => 'required|max:500',
            'thanh_vien_to_chuc' => 'required|max:500',
            'tinh_trang' => 'required|boolean',
            'hinh_anh' => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required' => 'Họ tên không được để trống',
            'ho_ten.max' => 'Họ tên không được vượt quá 100 ký tự',
            'ho_ten.min' => 'Họ tên phải có ít nhất 2 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống',
            'so_dien_thoai.digits' => 'Số điện thoại phải có 10 chữ số',
            'ngay_sinh.required' => 'Ngày sinh không được để trống',
            'ngay_sinh.date' => 'Ngày sinh phải là một ngày hợp lệ',
            'gioi_tinh.required' => 'Giới tính không được để trống',
            'gioi_tinh.boolean' => 'Giới tính phải là 0 (Nữ) hoặc 1 (Nam)',
            'id_phong_kham.required' => 'Phòng khám không được để trống',
            'id_phong_kham.exists' => 'Phòng khám không tồn tại trong hệ thống',
            'chuc_danh.required' => 'Chức danh không được để trống',
            'chuc_danh.max' => 'Chức danh không được vượt quá 100 ký tự',
            'so_nam_kinh_nghiem.required' => 'Số năm kinh nghiệm không được để trống',
            'so_nam_kinh_nghiem.integer' => 'Số năm kinh nghiệm phải là số nguyên',
            'so_nam_kinh_nghiem.min' => 'Số năm kinh nghiệm phải lớn hơn 0',
            'so_nam_kinh_nghiem.max' => 'Số năm kinh nghiệm phải nhỏ hơn 50',
            'mo_ta.required' => 'Mô tả không được để trống',
            'mo_ta.max' => 'Mô tả không được vượt quá 500 ký tự',
            'kinh_nghiem_lam_viec.required' => 'Kinh nghiệm làm việc không được để trống',
            'kinh_nghiem_lam_viec.max' => 'Kinh nghiệm làm việc không được vượt quá 1000 ký tự',
            'qua_trinh_dao_tao.required' => 'Quá trình đào tạo không được để trống',
            'qua_trinh_dao_tao.max' => 'Quá trình đào tạo không được vượt quá 1000 ký tự',
            'chung_chi.required' => 'Chứng chỉ không được để trống',
            'chung_chi.max' => 'Chứng chỉ không được vượt quá 500 ký tự',
            'thanh_tuu.required' => 'Thành tựu không được để trống',
            'thanh_tuu.max' => 'Thành tựu không được vượt quá 500 ký tự',
            'thanh_vien_to_chuc.required' => 'Thành viên tổ chức không được để trống',
            'thanh_vien_to_chuc.max' => 'Thành viên tổ chức không được vượt quá 500 ký tự',
            'tinh_trang.required' => 'Trạng thái không được để trống',
            'tinh_trang.boolean' => 'Trạng thái phải là 0 (Không hoạt động) hoặc 1 (Hoạt động)',
            'hinh_anh.required' => 'Hình ảnh không được để trống',
            'hinh_anh.max' => 'Hình ảnh không được vượt quá 255 ký tự',
        ];
    }
}
