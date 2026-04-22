<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PhieuDatLich;
use App\Models\BacSi;
use App\Models\BenhNhan;
use App\Models\LichLamViec;

class ThongKeController extends Controller
{
    /* ================== COMMON ================== */

    private function checkPermission($id)
    {
        $user = auth('sanctum')->user();

        return \App\Models\PhanQuyen::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id)
            ->exists();
    }

    private function deny()
    {
        return response()->json([
            'status' => false,
            'message' => 'Bạn không có quyền!'
        ]);
    }

    private function formatChart($data, $label, $value)
    {
        return [
            'labels' => $data->pluck($label),
            'values' => $data->pluck($value)
        ];
    }

    /* ================== CHUYÊN KHOA ================== */

    public function getLichHenTheoChuyenKhoa(Request $request)
    {
        if (!$this->checkPermission(13)) return $this->deny();

        $request->validate([
            'begin' => 'required|date',
            'end'   => 'required|date'
        ]);

        $data = PhieuDatLich::join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
            ->whereBetween('phieu_dat_lichs.ngay_dat_hen', [$request->begin, $request->end])
            ->select('chuyen_khoas.ten_chuyen_khoa', DB::raw('COUNT(*) as tong'))
            ->groupBy('chuyen_khoas.ten_chuyen_khoa')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
            ...$this->formatChart($data, 'ten_chuyen_khoa', 'tong')
        ]);
    }

    /* ================== BÁC SĨ ================== */

    public function getLichHenTheoBacSi(Request $request)
    {
        if (!$this->checkPermission(14)) return $this->deny();

        $request->validate([
            'begin' => 'required|date',
            'end'   => 'required|date'
        ]);

        $data = PhieuDatLich::join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->whereBetween('phieu_dat_lichs.ngay_dat_hen', [$request->begin, $request->end])
            ->select('bac_sis.ho_ten', DB::raw('COUNT(*) as tong'))
            ->groupBy('bac_sis.ho_ten')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
            ...$this->formatChart($data, 'ho_ten', 'tong')
        ]);
    }

    /* ================== PHÒNG KHÁM ================== */

    public function getBacSiTheoPhongKham(Request $request)
    {
        if (!$this->checkPermission(15)) return $this->deny();

        $data = BacSi::join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
            ->where('bac_sis.id_phong_kham', $request->id_phong_kham)
            ->select('phong_khams.ten_phong_kham', DB::raw('COUNT(DISTINCT bac_sis.id) as tong'))
            ->groupBy('phong_khams.ten_phong_kham')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
            ...$this->formatChart($data, 'ten_phong_kham', 'tong')
        ]);
    }

    /* ================== BỆNH NHÂN THEO BÁC SĨ ================== */

    public function getBenhNhanTheoBacSi(Request $request)
    {
        if (!$this->checkPermission(14)) return $this->deny();

        $request->validate([
            'id_bac_si' => 'required',
            'begin' => 'required|date',
            'end'   => 'required|date'
        ]);

        $thongKe = BenhNhan::join('phieu_dat_lichs', 'benh_nhans.id', '=', 'phieu_dat_lichs.id_benh_nhan')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->where('bac_sis.id', $request->id_bac_si)
            ->whereBetween('phieu_dat_lichs.ngay_dat_hen', [$request->begin, $request->end])
            ->select('bac_sis.ho_ten', DB::raw('COUNT(DISTINCT benh_nhans.id) as tong'))
            ->groupBy('bac_sis.ho_ten')
            ->first();

        $data = BenhNhan::join('phieu_dat_lichs', 'benh_nhans.id', '=', 'phieu_dat_lichs.id_benh_nhan')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->where('bac_sis.id', $request->id_bac_si)
            ->whereBetween('phieu_dat_lichs.ngay_dat_hen', [$request->begin, $request->end])
            ->select(
                'bac_sis.ho_ten as ten_bac_si',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'benh_nhans.so_dien_thoai',
                'benh_nhans.email',
                'phieu_dat_lichs.ngay_dat_hen'
            )
            ->distinct()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
            'thong_ke' => $thongKe,
            'labels' => $thongKe ? [$thongKe->ho_ten] : [],
            'values' => $thongKe ? [$thongKe->tong] : []
        ]);
    }

    /* ================== LỊCH LÀM VIỆC ================== */

    public function getLichLamViecTheoPhongKham(Request $request)
    {
        if (!$this->checkPermission(15)) return $this->deny();

        $data = LichLamViec::join('bac_sis', 'lich_lam_viecs.id_bac_si', '=', 'bac_sis.id')
            ->join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
            ->where('bac_sis.id_phong_kham', $request->id_phong_kham)
            ->whereBetween('lich_lam_viecs.ngay_lam_viec', [$request->begin, $request->end])
            ->select('phong_khams.ten_phong_kham', DB::raw('COUNT(*) as tong'))
            ->groupBy('phong_khams.ten_phong_kham')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
            ...$this->formatChart($data, 'ten_phong_kham', 'tong')
        ]);
    }

    /* ================== DASHBOARD ================= */

    public function getDashboardData()
    {
        if (!$this->checkPermission(12)) return $this->deny();

        $data = DB::table('phieu_dat_lichs')
            ->selectRaw("
                COUNT(*) as tong,
                SUM(CASE WHEN MONTH(ngay_dat_hen)=MONTH(NOW()) THEN 1 ELSE 0 END) as thang_nay,
                SUM(CASE WHEN tinh_trang=3 THEN 1 ELSE 0 END) as thanh_cong
            ")
            ->first();

        $tyLe = $data->tong > 0 ? round(($data->thanh_cong / $data->tong) * 100, 1) : 0;

        return response()->json([
            'tong_lich_hen' => $data->tong,
            'lich_thang_nay' => $data->thang_nay,
            'lich_thanh_cong' => $data->thanh_cong,
            'ty_le_thanh_cong' => $tyLe
        ]);
    }
}
