<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichLamViec extends Model
{
    protected $table = 'lich_lam_viecs';
    protected $fillable = [
        'id_bac_si',
        'ngay_lam_viec',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
    ];
}
