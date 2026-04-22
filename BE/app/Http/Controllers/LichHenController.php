<?php

namespace App\Http\Controllers;

use App\Models\BenhNhan;
use App\Models\ChiTietDatLich;
use App\Models\LichLamViec;
use App\Models\PhieuDatLich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LichHenController extends Controller
{
    private function checkPermission($id_chuc_nang = 9)
    {
        $user = Auth::guard('sanctum')->user();

        return \App\Models\PhanQuyen::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->exists();
    }

    private function responseForbidden()
    {
        return response()->json([
            'status' => false,
            'message' => 'Bạn không có quyền thực hiện chức năng này!'
        ]);
    }

    private function baseQuery()
    {
        return PhieuDatLich::join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id');
    }

    public function getLichHenData()
    {
        if (!$this->checkPermission()) return $this->responseForbidden();

        $data = $this->baseQuery()
            ->select(
                'phieu_dat_lichs.*',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'benh_nhans.so_dien_thoai as sdt_benh_nhan',
                'bac_sis.ho_ten as ten_bac_si',
                'chi_tiet_dat_lichs.*'
            )
            ->orderByDesc('phieu_dat_lichs.id')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function timKiemLichHen(Request $request)
    {
        if (!$this->checkPermission()) return $this->responseForbidden();

        $query = $this->baseQuery();

        if ($request->filled('tu_ngay') && $request->filled('den_ngay')) {
            $query->whereBetween('phieu_dat_lichs.ngay_dat_hen', [$request->tu_ngay, $request->den_ngay]);
        }

        if ($request->filled('tinh_trang')) {
            $query->where('phieu_dat_lichs.tinh_trang', $request->tinh_trang);
        }

        if ($request->filled('id_bac_si')) {
            $query->where('chi_tiet_dat_lichs.id_bac_si', $request->id_bac_si);
        }

        $data = $query->select(
                'phieu_dat_lichs.*',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'bac_sis.ho_ten as ten_bac_si',
                'chi_tiet_dat_lichs.*'
            )
            ->orderByDesc('phieu_dat_lichs.created_at')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function createLichHen(Request $request)
    {
        if (!$this->checkPermission()) return $this->responseForbidden();

        DB::beginTransaction();

        try {
            $gio = strlen($request->gio_hen) === 5 ? $request->gio_hen . ':00' : $request->gio_hen;
            $time = $request->ngay_hen . ' ' . $gio;

            $lichLamViec = LichLamViec::where([
                ['id_bac_si', $request->id_bac_si],
                ['ngay_lam_viec', $request->ngay_hen],
                ['thoi_gian_bat_dau', $gio]
            ])->first();

            if (!$lichLamViec) {
                return response()->json(['status' => false, 'message' => 'Không có lịch làm việc']);
            }

            $exists = ChiTietDatLich::where('id_bac_si', $request->id_bac_si)
                ->where('thoi_gian_bat_dau', $time)
                ->whereHas('phieuDatLich', function ($q) {
                    $q->where('tinh_trang', '!=', PhieuDatLich::TINH_TRANG_DA_HUY);
                })
                ->exists();

            if ($exists) {
                return response()->json(['status' => false, 'message' => 'Trùng lịch']);
            }

            $phieu = PhieuDatLich::create([
                'id_benh_nhan' => $request->id_benh_nhan,
                'ly_do_kham' => $request->ly_do_kham,
                'ngay_dat_hen' => $request->ngay_hen,
                'tinh_trang' => PhieuDatLich::TINH_TRANG_CHO_XAC_NHAN
            ]);

            $phieu->update([
                'ma_dat_lich' => 'HDBS' . str_pad($phieu->id, 6, '0', STR_PAD_LEFT)
            ]);

            ChiTietDatLich::create([
                'id_phieu_dat_lich' => $phieu->id,
                'id_bac_si' => $request->id_bac_si,
                'thoi_gian_bat_dau' => $time,
                'thoi_gian_ket_thuc' => $request->ngay_hen . ' ' . $lichLamViec->thoi_gian_ket_thuc
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Tạo lịch thành công'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Lỗi hệ thống']);
        }
    }

    public function changeStatusLichHen(Request $request)
    {
        if (!$this->checkPermission()) return $this->responseForbidden();

        $phieu = PhieuDatLich::find($request->id);

        if (!$phieu) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy']);
        }

        if (in_array($phieu->tinh_trang, [
            PhieuDatLich::TINH_TRANG_DA_HUY,
            PhieuDatLich::TINH_TRANG_DA_THANH_CONG
        ])) {
            return response()->json(['status' => false, 'message' => 'Không thể đổi trạng thái']);
        }

        $map = [
            PhieuDatLich::TINH_TRANG_CHO_XAC_NHAN => PhieuDatLich::TINH_TRANG_DA_XAC_NHAN,
            PhieuDatLich::TINH_TRANG_DA_XAC_NHAN => PhieuDatLich::TINH_TRANG_DA_THANH_CONG
        ];

        if (!isset($map[$phieu->tinh_trang])) {
            return response()->json(['status' => false, 'message' => 'Sai trạng thái']);
        }

        $old = $phieu->tinh_trang;
        $new = $map[$old];

        $phieu->update(['tinh_trang' => $new]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công',
            'data' => [
                'old' => $old,
                'new' => $new
            ]
        ]);
    }

    public function huyLichHen(Request $request)
    {
        if (!$this->checkPermission()) return $this->responseForbidden();

        $phieu = PhieuDatLich::find($request->id);

        if (!$phieu) {
            return response()->json(['status' => false, 'message' => 'Không tồn tại']);
        }

        $phieu->update([
            'tinh_trang' => PhieuDatLich::TINH_TRANG_DA_HUY
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã hủy lịch'
        ]);
    }
}
