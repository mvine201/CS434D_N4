<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDatLich extends Model
{
    protected $table = 'chi_tiet_dat_lichs';
    protected $fillable = [
        'id_phieu_dat_lich',
        'id_bac_si',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        'so_sao_danh_gia',
        'nhan_xet',
        'ngay_danh_gia',
        'don_thuoc',
        'chuan_doan',
        'ghi_chu',
        'thoi_gian_ket_thuc_kham',
        'don_gia_kham',
    ];
}
