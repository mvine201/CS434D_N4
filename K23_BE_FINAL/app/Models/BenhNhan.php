<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class BenhNhan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'benh_nhans';
    protected $fillable = [
        'ho_ten',
        'email',
        'password',
        'hinh_anh',
        'so_dien_thoai',
        'ngay_sinh',
        'gioi_tinh',
        'dia_chi',
        'tinh_trang',
        'is_active',
        'is_block',
        'hash_reset',
        'hash_active',
    ];
}
