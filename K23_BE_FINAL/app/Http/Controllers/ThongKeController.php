<?php

namespace App\Http\Controllers;

use App\Models\PhieuDatLich;
use App\Models\BacSi;
use App\Models\BenhNhan;
use App\Models\ChiTietDatLich;
use App\Models\LichLamViec;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongkeController extends Controller
{
    public function getLichHenTheoChuyenKhoa(Request $request)
    {
        // Kiểm tra quyền: Xem thống kê chi tiết theo chuyên khoa (ID = 13)
        $id_chuc_nang = 13;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = PhieuDatLich::join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
            ->whereDate('phieu_dat_lichs.ngay_dat_hen', '>=', $request->begin)
            ->whereDate('phieu_dat_lichs.ngay_dat_hen', '<=', $request->end)
            ->select('chuyen_khoas.ten_chuyen_khoa', DB::raw('COUNT(phieu_dat_lichs.id) as tong_lich_hen'))
            ->groupBy('chuyen_khoas.ten_chuyen_khoa')
            ->get();

        $array_ten_chuyen_khoa = [];
        $array_tong_lich_hen = [];

        foreach ($data as $value) {
            array_push($array_ten_chuyen_khoa, $value->ten_chuyen_khoa);
            array_push($array_tong_lich_hen, $value->tong_lich_hen);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'array_ten_chuyen_khoa' => $array_ten_chuyen_khoa,
            'array_tong_lich_hen' => $array_tong_lich_hen,
            'message' => 'Lấy dữ liệu thành công',
        ]);
    }
    public function getLichHenTheoBacSi(Request $request)
    {
        // Kiểm tra quyền: Xem thống kê chi tiết theo bác sĩ (ID = 14)
        $id_chuc_nang = 14;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = PhieuDatLich::join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->whereDate('phieu_dat_lichs.ngay_dat_hen', '>=', $request->begin)
            ->whereDate('phieu_dat_lichs.ngay_dat_hen', '<=', $request->end)
            ->select('bac_sis.ho_ten', DB::raw('COUNT(phieu_dat_lichs.id) as tong_lich_hen'))
            ->groupBy('bac_sis.ho_ten')
            ->get();

        $array_ten_bac_si = [];
        $array_tong_lich_hen = [];

        foreach ($data as $key => $value) {
            array_push($array_ten_bac_si, $value->ho_ten);
            array_push($array_tong_lich_hen, $value->tong_lich_hen);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'array_ten_bac_si' => $array_ten_bac_si,
            'array_tong_lich_hen' => $array_tong_lich_hen,
            'message' => 'Lấy dữ liệu thành công',
        ]);
    }
    public function getBacSiTheoPhongKham(Request $request)
    {
        // Kiểm tra quyền: Xem thống kê chi tiết theo phòng khám (ID = 15)
        $id_chuc_nang = 15;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = BacSi::join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
            ->where('bac_sis.id_phong_kham', $request->id_phong_kham)
            ->select(
                'phong_khams.ten_phong_kham',
                DB::raw('COUNT(DISTINCT bac_sis.id) as tong_bac_si')
            )
            ->groupBy('phong_khams.ten_phong_kham')
            ->get();

        $array_ten_phong_kham = [];
        $array_tong_bac_si = [];

        foreach ($data as $value) {
            $array_ten_phong_kham[] = $value->ten_phong_kham;
            $array_tong_bac_si[] = $value->tong_bac_si;
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'array_ten_phong_kham' => $array_ten_phong_kham,
            'array_tong_bac_si' => $array_tong_bac_si,
            'message' => 'Lấy dữ liệu thành công',
        ]);
    }
    public function getBenhNhanTheoBacSi(Request $request)
    {
        // Kiểm tra quyền: Xem thống kê chi tiết theo bác sĩ (ID = 14)
        $id_chuc_nang = 14;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $thongKe = BenhNhan::join('phieu_dat_lichs', 'benh_nhans.id', '=', 'phieu_dat_lichs.id_benh_nhan')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->where('bac_sis.id', $request->id_bac_si)
            ->whereDate('phieu_dat_lichs.ngay_dat_hen', '>=', $request->begin)
            ->whereDate('phieu_dat_lichs.ngay_dat_hen', '<=', $request->end)
            ->select('bac_sis.ho_ten', DB::raw('COUNT(DISTINCT benh_nhans.id) as tong_benh_nhan'))
            ->groupBy('bac_sis.ho_ten')
            ->first();
        $data = BenhNhan::join('phieu_dat_lichs', 'benh_nhans.id', '=', 'phieu_dat_lichs.id_benh_nhan')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->where('bac_sis.id', $request->id_bac_si)
            ->whereDate('phieu_dat_lichs.ngay_dat_hen', '>=', $request->begin)
            ->whereDate('phieu_dat_lichs.ngay_dat_hen', '<=', $request->end)
            ->select(
                'bac_sis.ho_ten as ten_bac_si',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'benh_nhans.so_dien_thoai',
                'benh_nhans.email',
                'phieu_dat_lichs.ngay_dat_hen'
            )
            ->distinct()
            ->orderBy('bac_sis.ho_ten')
            ->orderBy('benh_nhans.ho_ten')
            ->get();

        $array_ten_bac_si = [];
        $array_tong_benh_nhan = [];

        if ($thongKe) {
            array_push($array_ten_bac_si, $thongKe->ho_ten);
            array_push($array_tong_benh_nhan, $thongKe->tong_benh_nhan);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'thong_ke' => $thongKe,
            'array_ten_bac_si' => $array_ten_bac_si,
            'array_tong_benh_nhan' => $array_tong_benh_nhan,
            'message' => 'Lấy dữ liệu thành công',
        ]);
    }
    public function getLichLamViecTheoPhongKham(Request $request)
    {
        // Kiểm tra quyền: Xem thống kê chi tiết theo phòng khám (ID = 15)
        $id_chuc_nang = 15;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = LichLamViec::join('bac_sis', 'lich_lam_viecs.id_bac_si', '=', 'bac_sis.id')
            ->join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
            ->where('bac_sis.id_phong_kham', $request->id_phong_kham)
            ->whereDate('lich_lam_viecs.ngay_lam_viec', '>=', $request->begin)
            ->whereDate('lich_lam_viecs.ngay_lam_viec', '<=', $request->end)
            ->select('phong_khams.ten_phong_kham', DB::raw('COUNT(lich_lam_viecs.id) as tong_lich_lam_viec'))
            ->groupBy('phong_khams.ten_phong_kham')
            ->get();
        $array_ten_phong_kham = [];
        $array_tong_lich_lam_viec = [];

        foreach ($data as $value) {
            array_push($array_ten_phong_kham, $value->ten_phong_kham);
            array_push($array_tong_lich_lam_viec, $value->tong_lich_lam_viec);
        }

        return response()->json([
            'status' => true,
            'data' => $data,
            'array_ten_phong_kham' => $array_ten_phong_kham,
            'array_tong_lich_lam_viec' => $array_tong_lich_lam_viec,
            'message' => 'Lấy dữ liệu thành công',
        ]);
    }
    public function getDashboardData()
    {
        // Kiểm tra quyền: Xem thống kê tổng quan (ID = 12)
        $id_chuc_nang = 12;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = DB::table('phieu_dat_lichs')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->select(
                DB::raw('COUNT(DISTINCT phieu_dat_lichs.id) as tong_lich_hen'),
                DB::raw('COUNT(CASE WHEN MONTH(phieu_dat_lichs.ngay_dat_hen) = MONTH(NOW()) AND YEAR(phieu_dat_lichs.ngay_dat_hen) = YEAR(NOW()) THEN 1 END) as lich_hen_thang_nay'),
                DB::raw('COUNT(CASE WHEN phieu_dat_lichs.tinh_trang = 3 THEN 1 END) as lich_hen_thanh_cong'),
                DB::raw('AVG(chi_tiet_dat_lichs.so_sao_danh_gia) as danh_gia_trung_binh')
            )
            ->first();

        $tyLeThanhCong = $data->tong_lich_hen > 0 ? round(($data->lich_hen_thanh_cong / $data->tong_lich_hen) * 100, 1) : 0;

        $danhGiaTrungBinh = $data->danh_gia_trung_binh ? round($data->danh_gia_trung_binh, 1) : 0;

        return response()->json([
            'data' => $data,
            'tong_lich_hen' => $data->tong_lich_hen,
            'lich_hen_thang_nay' => $data->lich_hen_thang_nay,
            'lich_hen_thanh_cong' => $data->lich_hen_thanh_cong,
            'ty_le_thanh_cong' => $tyLeThanhCong,
            'danh_gia_trung_binh' => $danhGiaTrungBinh,
            'message' => 'Lấy dữ liệu thành công',
        ]);
    }
}
