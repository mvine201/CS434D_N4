<?php

namespace App\Http\Controllers;

use App\Models\BacSi;
use App\Models\ChuyenKhoa;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function homePageData()
    {
       $data = BacSi::join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
            ->join('phong_khams', 'phong_khams.id', '=', 'bac_sis.id_phong_kham')
            ->select(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.mo_ta',
                'bac_sis.hinh_anh',
                'bac_sis.so_nam_kinh_nghiem',
                'bac_sis.chuc_danh',
                'bac_sis.thanh_tuu',
                'bac_sis.thanh_vien_to_chuc',
                'bac_sis.kinh_nghiem_lam_viec',
                'bac_sis.qua_trinh_dao_tao',
                'chuyen_khoas.ten_chuyen_khoa',
            )
            ->get();
        $data_chuyen_khoa = ChuyenKhoa::join('bac_si_chuyen_nganhs', 'chuyen_khoas.id', '=', 'bac_si_chuyen_nganhs.id_chuyen_khoa')
            ->join('bac_sis', 'bac_si_chuyen_nganhs.id_bac_si', '=', 'bac_sis.id')
            ->select(
                'bac_sis.id as id_bac_si',
                'chuyen_khoas.ten_chuyen_khoa',
                'bac_sis.ho_ten',
                'bac_sis.hinh_anh',
                'chuyen_khoas.mo_ta',
            )
            ->get();
        $data_slide = Slide::where('tinh_trang', 1)->get();
        return response()->json([
            'data' => $data,
            'data_chuyen_khoa' => $data_chuyen_khoa,
            'data_slide' => $data_slide,
        ]);
    }
    public function getChuyenKhoaClient()
    {
        $data_chuyen_khoa = ChuyenKhoa::leftJoin('bac_si_chuyen_nganhs', 'chuyen_khoas.id', '=', 'bac_si_chuyen_nganhs.id_chuyen_khoa')
        ->leftJoin('bac_sis', 'bac_si_chuyen_nganhs.id_bac_si', '=', 'bac_sis.id')
        ->select(
            'chuyen_khoas.id',
            'chuyen_khoas.ten_chuyen_khoa',
        )
        ->groupBy(
            'chuyen_khoas.id',
            'chuyen_khoas.ten_chuyen_khoa',
        )
        ->orderBy('chuyen_khoas.ten_chuyen_khoa')
        ->get();
        $data_slide = Slide::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $data_chuyen_khoa,
            'data_slide' => $data_slide,
        ]);
    }
    public function getBacSiClient()
    {
        $data = BacSi::join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
            ->join('phong_khams', 'phong_khams.id', '=', 'bac_sis.id_phong_kham')
            ->select(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.mo_ta',
                'bac_sis.hinh_anh',
                'bac_sis.so_nam_kinh_nghiem',
                'bac_sis.chuc_danh',
                'bac_sis.thanh_tuu',
                'bac_sis.thanh_vien_to_chuc',
                'bac_sis.kinh_nghiem_lam_viec',
                'bac_sis.qua_trinh_dao_tao',
                'chuyen_khoas.ten_chuyen_khoa',
                'phong_khams.ten_phong_kham',
            )
            ->groupBy(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.mo_ta',
                'bac_sis.hinh_anh',
                'bac_sis.so_nam_kinh_nghiem',
                'bac_sis.chuc_danh',
                'bac_sis.thanh_tuu',
                'bac_sis.thanh_vien_to_chuc',
                'bac_sis.kinh_nghiem_lam_viec',
                'bac_sis.qua_trinh_dao_tao',
                'chuyen_khoas.ten_chuyen_khoa',
                'phong_khams.ten_phong_kham',
            )
            ->get();
        $data_slide = Slide::where('tinh_trang', 1)->get();

        return response()->json([
            'data' => $data,
            'data_slide' => $data_slide,


        ]);
    }
    public function getChuyenKhoaClientById($id)
    {
        $data = ChuyenKhoa::join('bac_si_chuyen_nganhs', 'chuyen_khoas.id', '=', 'bac_si_chuyen_nganhs.id_chuyen_khoa')
        ->join('bac_sis', 'bac_si_chuyen_nganhs.id_bac_si', '=', 'bac_sis.id')
        ->select(
            'chuyen_khoas.id',
            'chuyen_khoas.ten_chuyen_khoa',
            'bac_sis.ho_ten',
            'bac_sis.hinh_anh',
            'chuyen_khoas.mo_ta',
        )
        ->where('chuyen_khoas.id', $id)
        ->first();

        $data_bac_si = BacSi::join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
        ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
        ->join('phong_khams', 'phong_khams.id', '=', 'bac_sis.id_phong_kham')
        ->where('chuyen_khoas.id', $id)
        ->select(
            'bac_sis.id',
            'bac_sis.ho_ten',
            'bac_sis.mo_ta',
            'bac_sis.hinh_anh',
            'bac_sis.so_nam_kinh_nghiem',
            'bac_sis.chuc_danh',
            'bac_sis.thanh_tuu',
            'bac_sis.thanh_vien_to_chuc',
            'bac_sis.kinh_nghiem_lam_viec',
            'bac_sis.qua_trinh_dao_tao',
            'chuyen_khoas.ten_chuyen_khoa',
            'phong_khams.ten_phong_kham',
        )
        ->groupBy(
            'chuyen_khoas.id',
            'chuyen_khoas.ten_chuyen_khoa',
            'bac_sis.ho_ten',
            'bac_sis.hinh_anh',
            'chuyen_khoas.mo_ta',
        )
        ->get();
        return response()->json([
            'data' => $data,
            'data_bac_si' => $data_bac_si,
        ]);
    }
    public function getBacSiClientByIds($id)
    {
        $data = BacSi::join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
        ->join('phong_khams', 'phong_khams.id', '=', 'bac_sis.id_phong_kham')
        ->select(
            'bac_sis.id',
            'bac_sis.ho_ten',
            'bac_sis.mo_ta',
            'bac_sis.hinh_anh',
            'bac_sis.so_nam_kinh_nghiem',
            'bac_sis.chuc_danh',
            'bac_sis.thanh_tuu',
            'bac_sis.thanh_vien_to_chuc',
            'bac_sis.kinh_nghiem_lam_viec',
            'bac_sis.qua_trinh_dao_tao',
            'chuyen_khoas.ten_chuyen_khoa',
            'phong_khams.ten_phong_kham',
        )
        ->groupBy(
            'bac_sis.id',
            'bac_sis.ho_ten',
            'bac_sis.mo_ta',
            'bac_sis.hinh_anh',
            'bac_sis.so_nam_kinh_nghiem',
            'bac_sis.chuc_danh',
            'bac_sis.thanh_tuu',
            'bac_sis.thanh_vien_to_chuc',
            'bac_sis.kinh_nghiem_lam_viec',
            'bac_sis.qua_trinh_dao_tao',
            'chuyen_khoas.ten_chuyen_khoa',
            'phong_khams.ten_phong_kham',
        )
        ->where('bac_sis.id', $id)
        ->first();
        return response()->json([
            'data' => $data,
        ]);
    }
}
