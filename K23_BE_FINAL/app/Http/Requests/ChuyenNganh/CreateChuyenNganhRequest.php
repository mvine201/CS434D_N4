<?php

namespace App\Http\Requests\ChuyenNganh;

use Illuminate\Foundation\Http\FormRequest;

class CreateChuyenNganhRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ten_chuyen_nganh' => 'required|string|max:255',
            'tinh_trang'       => 'required|boolean',
            'id_chuyen_khoa'   => 'required|integer|exists:chuyen_khoas,id',
        ];
    }
    public function messages():array
    {
        return[
            'ten_chuyen_nganh.required' => 'Tên chuyên ngành là bắt buộc',
            'tinh_trang.required'       => 'Tình trạng là bắt buộc',
            'id_chuyen_khoa.required'   => 'Chuyên khoa không tồn tại',
        ];
    }

}
