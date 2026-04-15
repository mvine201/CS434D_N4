<?php

namespace App\Http\Requests\PhongKham;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhongKhamRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'            => 'required|integer|exists:phong_khams,id',
            'ten_phong_kham' => 'required|string|max:255|unique:phong_khams,ten_phong_kham,' . $this->id,
            'email'          => 'required|email|unique:phong_khams,email,' . $this->id,
            'dia_chi'        => 'required|string|max:255|unique:phong_khams,dia_chi,' . $this->id,
            'so_dien_thoai'  => 'required|digits:10|unique:phong_khams,so_dien_thoai,' . $this->id,
            'tinh_trang'     => 'required|boolean',
            'mo_ta'          => 'required|string',
            'anh_banner'     => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ten_phong_kham.required' => 'Tên phòng khám không được để trống.',
            'ten_phong_kham.max' => 'Tên phòng khám không được vượt quá 255 ký tự.',
            'ten_phong_kham.unique' => 'Tên phòng khám đã tồn tại.',

            'id.required' => 'ID không được để trống.',
            'id.integer' => 'ID phải là số.',
            'id.exists' => 'ID không tồn tại.',

            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',

            'dia_chi.required' => 'Địa chỉ không được để trống.',
            'dia_chi.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'dia_chi.unique' => 'Địa chỉ đã tồn tại.',


            'so_dien_thoai.required' => 'Số điện thoại không được để trống.',
            'so_dien_thoai.digits' => 'Số điện thoại phải đúng 10 số.',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại.',


            'mo_ta.required' => 'Mô tả không được để trống.',
            'mo_ta.string' => 'Mô tả phải là chuỗi văn bản.',

            'anh_banner.required' => 'Ảnh banner không được để trống.',
            'anh_banner.image' => 'Ảnh banner phải là tệp hình ảnh.',


            'id.required'              => 'ID không được để trống',
            'id.integer'              => 'ID phải là số',
            'id.exists'               => 'ID đã tồn tại',

            'tinh_trang.required' => 'Trạng thái không được để trống.',
            'tinh_trang.boolean' => 'Trạng thái phải là boolean.',
        ];
    }
}
