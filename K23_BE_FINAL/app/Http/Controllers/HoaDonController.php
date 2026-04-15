<?php

namespace App\Http\Controllers;

use App\Models\PhieuDatLich;
use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    public function getDataHoaDon()
    {
        $data = PhieuDatLich::join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->select(
                'benh_nhans.ho_ten',
                'benh_nhans.so_dien_thoai',
                'phieu_dat_lichs.ma_dat_lich',
                'phieu_dat_lichs.tong_tien',
                'bac_sis.ho_ten as ten_bac_si',
                'chi_tiet_dat_lichs.*'
            )
            ->where('phieu_dat_lichs.is_thanh_toan', 1)
            ->orderBy('phieu_dat_lichs.id')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}
