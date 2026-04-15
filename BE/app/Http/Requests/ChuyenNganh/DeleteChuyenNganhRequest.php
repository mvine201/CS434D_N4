<?php

namespace App\Http\Requests\ChuyenNganh;

use Illuminate\Foundation\Http\FormRequest;

class DeleteChuyenNganhRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:chuyen_nganhs,id',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Chuyên ngành không được để trống',
            'id.exists'   => 'Chuyên ngành không tồn tại trong hệ thống',
        ];
    }
}
