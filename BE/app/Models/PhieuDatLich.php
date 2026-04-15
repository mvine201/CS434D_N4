<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuDatLich extends Model
{
    protected $table = 'phieu_dat_lichs';
    protected $fillable = [
        'ma_dat_lich',
        'id_benh_nhan',
        'ngay_dat_hen',
        'ly_do_kham',
        'tinh_trang',
        'is_thanh_toan',
        'tong_tien',
    ];
    const TINH_TRANG_CHO_XAC_NHAN = 0;
    const TINH_TRANG_DA_XAC_NHAN = 1;
    const TINH_TRANG_DA_HUY = 2;
    const TINH_TRANG_DA_THANH_CONG = 3;

    const IS_THANH_TOAN_CHUA_THANH_TOAN = 0;
    const IS_THANH_TOAN_DA_THANH_TOAN = 1;
}
