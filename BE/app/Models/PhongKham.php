<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhongKham extends Model
{
    protected $table = 'phong_khams';
    protected $fillable = [
        'ten_phong_kham',
        'email',
        'dia_chi',
        'so_dien_thoai',
        'email',
        'mo_ta',
        'anh_banner',
        'tinh_trang',
    ];
}
