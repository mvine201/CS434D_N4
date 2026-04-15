<?php

namespace App\Http\Controllers;

use App\Models\BacSi;
use App\Models\BenhNhan;
use App\Models\ChiTietDatLich;
use App\Models\LichLamViec;
use App\Models\PhieuDatLich;
use Illuminate\Http\Request;
use App\Http\Requests\LichHen\CreateLichHenRequest;
use App\Http\Requests\LichHen\ChangeStatusLichHenRequest;
use App\Http\Requests\LichHen\XacNhanLichHenRequest;
use App\Http\Requests\LichHen\HoanThanhLichHenRequest;
use App\Http\Requests\LichHen\HuyLichHenRequest;
use App\Http\Requests\LichHen\TimKiemLichHenRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LichHenController extends Controller
{
    public function getLichHenData(Request $request)
    {
        // Kiểm tra quyền: Quản lý lịch hẹn khám bệnh (ID = 9)
        $id_chuc_nang = 9;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = PhieuDatLich::Join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->Join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->Join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->select(
                'phieu_dat_lichs.id',
                'phieu_dat_lichs.id_benh_nhan',
                'phieu_dat_lichs.ngay_dat_hen',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.tinh_trang',
                'phieu_dat_lichs.is_thanh_toan',
                'phieu_dat_lichs.tong_tien',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'benh_nhans.so_dien_thoai as so_dien_thoai_benh_nhan',
                'bac_sis.ho_ten as ten_bac_si',
                'bac_sis.so_dien_thoai as so_dien_thoai_bac_si',
                'chi_tiet_dat_lichs.id as id_chi_tiet',
                'chi_tiet_dat_lichs.thoi_gian_bat_dau',
                'chi_tiet_dat_lichs.thoi_gian_ket_thuc',
                'chi_tiet_dat_lichs.don_thuoc',
                'chi_tiet_dat_lichs.chuan_doan',
                'chi_tiet_dat_lichs.ghi_chu',
                'chi_tiet_dat_lichs.nhan_xet',
                'chi_tiet_dat_lichs.ngay_danh_gia',
                'chi_tiet_dat_lichs.don_gia_kham',

            )
            ->orderBy('phieu_dat_lichs.id', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
    public function timKiemLichHen(Request $request)
    {
        // Kiểm tra quyền: Quản lý lịch hẹn khám bệnh (ID = 9)
        $id_chuc_nang = 9;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = PhieuDatLich::where(function ($query) use ($request) {
                if ($request->tu_ngay && $request->den_ngay) {
                    $query->whereDate('phieu_dat_lichs.ngay_dat_hen', '>=', $request->tu_ngay)
                          ->whereDate('phieu_dat_lichs.ngay_dat_hen', '<=', $request->den_ngay);
                }
                if ($request->tinh_trang !== null && $request->tinh_trang !== '') {
                    $query->where('phieu_dat_lichs.tinh_trang', $request->tinh_trang);
                }
                if ($request->id_bac_si) {
                    $query->where('chi_tiet_dat_lichs.id_bac_si', $request->id_bac_si);
                }
            })
            ->join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', 'benh_nhans.id')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', 'bac_sis.id')
            ->select(
                'phieu_dat_lichs.*',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'benh_nhans.so_dien_thoai as so_dien_thoai_benh_nhan',
                'bac_sis.ho_ten as ten_bac_si',
                'bac_sis.so_dien_thoai as so_dien_thoai_bac_si',
                'chi_tiet_dat_lichs.thoi_gian_bat_dau',
                'chi_tiet_dat_lichs.thoi_gian_ket_thuc',
                'chi_tiet_dat_lichs.don_thuoc',
                'chi_tiet_dat_lichs.chuan_doan',
                'chi_tiet_dat_lichs.ghi_chu',
                'chi_tiet_dat_lichs.nhan_xet',
                'chi_tiet_dat_lichs.ngay_danh_gia',
                DB::raw('DATE_FORMAT(phieu_dat_lichs.created_at, "%d/%m/%Y") as ngay_dat')
            )
            ->orderByDesc('phieu_dat_lichs.created_at')
            ->get();
        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
    public function createLichHen(CreateLichHenRequest $request)
    {
        // Kiểm tra quyền: Quản lý lịch hẹn khám bệnh (ID = 9)
        $id_chuc_nang = 9;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $idBenhNhan = $request->id_benh_nhan;
        $idBacSi = $request->id_bac_si;
        $ngayHen = $request->ngay_hen;
        $gioHen = $request->gio_hen;
        $lyDoKham = $request->ly_do_kham;

        $gioHopLe = strlen($gioHen) === 5 ? ($gioHen . ':00') : $gioHen;
        $thoiGianHen = $ngayHen . ' ' . $gioHopLe;
        $lichLamViec = LichLamViec::where('id_bac_si', $idBacSi)
            ->whereDate('ngay_lam_viec', $ngayHen)
            ->where('thoi_gian_bat_dau', $gioHopLe)
            ->first();
        if (!$lichLamViec) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ không có lịch làm việc trong thời gian này'
            ]);
        }
        $checkLichLamViec = ChiTietDatLich::join('phieu_dat_lichs', 'chi_tiet_dat_lichs.id_phieu_dat_lich', '=', 'phieu_dat_lichs.id')
            ->where('chi_tiet_dat_lichs.id_bac_si', $idBacSi)
            ->where('chi_tiet_dat_lichs.thoi_gian_bat_dau', $thoiGianHen)
            ->where('phieu_dat_lichs.tinh_trang', '!=', PhieuDatLich::TINH_TRANG_DA_HUY)
            ->exists();
        if ($checkLichLamViec) {
            return response()->json([
                'status' => false,
                'message' => 'Đã có lịch hẹn trong thời gian này'
            ]);
        } else {
            $phieuDatLich = PhieuDatLich::create([
                'id_benh_nhan' => $idBenhNhan,
                'ly_do_kham' => $lyDoKham,
                'ngay_dat_hen' => $ngayHen,
                'tinh_trang' => PhieuDatLich::TINH_TRANG_CHO_XAC_NHAN

            ]);
            $phieuDatLich->ma_dat_lich = 'HDBS' . str_pad($phieuDatLich->id, 6, '0', STR_PAD_LEFT);
            $phieuDatLich->save();
            ChiTietDatLich::create([
                'id_phieu_dat_lich' => $phieuDatLich->id,
                'id_bac_si' => $idBacSi,
                'thoi_gian_bat_dau' => $thoiGianHen,
                'thoi_gian_ket_thuc' => $ngayHen . ' ' . $lichLamViec->thoi_gian_ket_thuc,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Tạo lịch hẹn thành công cho bệnh nhân ' . BenhNhan::find($idBenhNhan)->ho_ten
            ]);
        }
    }
    public function xacNhanLichHen(XacNhanLichHenRequest $request)
    {
        // Kiểm tra quyền: Quản lý lịch hẹn khám bệnh (ID = 9)
        $id_chuc_nang = 9;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $phieuDatLich = PhieuDatLich::find($request->id);
        if (!$phieuDatLich) {
            return response()->json([
                'status' => false,
                'message' => 'Lịch hẹn không tồn tại'
            ]);
        }
        if ($phieuDatLich->tinh_trang != PhieuDatLich::TINH_TRANG_CHO_XAC_NHAN) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể xác nhận lịch hẹn đã hoàn thành hoặc đã hủy'
            ]);
        }
        $phieuDatLich->update([
            'tinh_trang' => PhieuDatLich::TINH_TRANG_DA_XAC_NHAN
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Xác nhận lịch hẹn thành công cho bệnh nhân ' . BenhNhan::find($phieuDatLich->id_benh_nhan)->ho_ten
        ]);
    }
    public function hoanThanhLichHen(HoanThanhLichHenRequest $request)
    {
        // Kiểm tra quyền: Quản lý lịch hẹn khám bệnh (ID = 9)
        $id_chuc_nang = 9;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $chiTietDatLich = ChiTietDatLich::find($request->id);
        if (!$chiTietDatLich) {
            return response()->json([
                'status' => false,
                'message' => 'Lịch hẹn không tồn tại'
            ]);
        }
        $phieuDatLich = PhieuDatLich::find($chiTietDatLich->id_phieu_dat_lich);
        if (!$phieuDatLich) {
            return response()->json([
                'status' => false,
                'message' => 'Phiếu đặt lịch không tồn tại'
            ]);
        }

        if ($phieuDatLich->tinh_trang != PhieuDatLich::TINH_TRANG_DA_XAC_NHAN) {
            return response()->json([
                'status' => false,
                'message' => 'Lịch hẹn này không thể hoàn thành'
            ]);
        }
        $data = [];
        foreach (['don_thuoc', 'chuan_doan', 'ghi_chu'] as $value) {
            if ($request->filled($value)) {
                $data[$value] = $request->$value;
            }
        }
        $chiTietDatLich->update($data);
        $phieuDatLich->update([
            'tinh_trang' => PhieuDatLich::TINH_TRANG_DA_THANH_CONG
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Hoàn thành lịch hẹn thành công cho bệnh nhân ' . BenhNhan::find($phieuDatLich->id_benh_nhan)->ho_ten
        ]);
    }
    public function huyLichHen(HuyLichHenRequest $request)
    {
        // Kiểm tra quyền: Quản lý lịch hẹn khám bệnh (ID = 9)
        $id_chuc_nang = 9;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $phieuDatLich = PhieuDatLich::find($request->id);
        if (!$phieuDatLich) {
            return response()->json([
                'status' => false,
                'message' => 'Lịch hẹn không tồn tại'
            ]);
        } else {
            $phieuDatLich->update([
                'tinh_trang' => PhieuDatLich::TINH_TRANG_DA_HUY,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Hủy lịch hẹn thành công cho bệnh nhân ' . BenhNhan::find($phieuDatLich->id_benh_nhan)->ho_ten
            ]);
        }
    }
    public function changeStatusLichHen(ChangeStatusLichHenRequest $request)
    {
        // Kiểm tra quyền: Quản lý lịch hẹn khám bệnh (ID = 9)
        $id_chuc_nang = 9;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $id = $request->id;
        $phieuDatLich = PhieuDatLich::find($id);
        if (!$phieuDatLich) {
            $chiTiet = ChiTietDatLich::find($id);
            if ($chiTiet) {
                $phieuDatLich = PhieuDatLich::find($chiTiet->id_phieu_dat_lich);
            }
        }

        if (!$phieuDatLich) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy lịch hẹn'
            ], 404);
        }

        $tinhTrangHienTai = $phieuDatLich->tinh_trang;

        if ($tinhTrangHienTai == PhieuDatLich::TINH_TRANG_DA_HUY ||
            $tinhTrangHienTai == PhieuDatLich::TINH_TRANG_DA_THANH_CONG) {
            return response()->json([
                'status' => false,
                'message' => 'Lịch hẹn này không thể thay đổi trạng thái'
            ]);
        }

        $tinhTrangMoi = null;

        if ($tinhTrangHienTai == PhieuDatLich::TINH_TRANG_CHO_XAC_NHAN) {
            $tinhTrangMoi = PhieuDatLich::TINH_TRANG_DA_XAC_NHAN;
        } elseif ($tinhTrangHienTai == PhieuDatLich::TINH_TRANG_DA_XAC_NHAN) {
            $tinhTrangMoi = PhieuDatLich::TINH_TRANG_DA_THANH_CONG;
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Trạng thái hiện tại không hợp lệ'
            ]);
        }

        $phieuDatLich->update(['tinh_trang' => $tinhTrangMoi]);

        $benhNhan = BenhNhan::find($phieuDatLich->id_benh_nhan);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật trạng thái lịch hẹn thành công cho bệnh nhân ' . $benhNhan->ho_ten,
            'data' => [
                'phieu_dat_lich' => $phieuDatLich->fresh(),
                'trang_thai_cu' => $tinhTrangHienTai,
                'trang_thai_moi' => $tinhTrangMoi,
                'ten_benh_nhan' => $benhNhan->ho_ten
            ],
        ]);
    }
}
