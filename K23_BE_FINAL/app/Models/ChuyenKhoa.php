<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenKhoa extends Model
{
    protected $table = 'chuyen_khoas';
    protected $fillable = [
        'ten_chuyen_khoa',
        'mo_ta',
        'tinh_trang',
    ];
}
