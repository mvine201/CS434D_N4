<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BacSiChuyenNganh extends Model
{
    protected $table = 'bac_si_chuyen_nganhs';
    protected $fillable = [
        'id_bac_si',
        'id_chuyen_khoa',
        'thoi_gian_du_kien',
    ];
}
