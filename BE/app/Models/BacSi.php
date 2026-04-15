<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class BacSi extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'bac_sis';
    protected $fillable = [
        'ho_ten',
        'email',
        'password',
        'so_dien_thoai',
        'ngay_sinh',
        'gioi_tinh',
        'mo_ta',
        'hinh_anh',
        'chuc_danh',
        'so_nam_kinh_nghiem',
        'kinh_nghiem_lam_viec',
        'qua_trinh_dao_tao',
        'chung_chi',
        'thanh_tuu',
        'thanh_vien_to_chuc',
        'tinh_trang',
        'id_phong_kham',
        'is_active',
        'is_block',
        'hash_reset',
        'hash_active',
        'don_gia_kham',
    ];
}
