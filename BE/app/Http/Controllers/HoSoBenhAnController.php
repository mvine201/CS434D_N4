<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoSoBenhNhan\ChangeStatusHoSoBenhAnRequest;
use App\Http\Requests\HoSoBenhNhan\DeleteHoSoBenhAnRequest;
use App\Http\Requests\HoSoBenhNhan\UpdateHoSoBenhAnRequest;
use App\Http\Requests\HoSoBenhNhan\CreateHoSoBenhAnRequest;
use App\Models\ChiTietDatLich;
use App\Models\PhieuDatLich;
use Illuminate\Http\Request;

class HoSoBenhAnController extends Controller
{
    // Quản lý hồ sơ bệnh án
    public function getDataHoSoBenhAn()
    {
        // Kiểm tra quyền: Quản lý hồ sơ bệnh án (ID = 10)
        $id_chuc_nang = 10;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = ChiTietDatLich::join('phieu_dat_lichs', 'chi_tiet_dat_lichs.id_phieu_dat_lich', '=', 'phieu_dat_lichs.id')
            ->join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->select(
                'chi_tiet_dat_lichs.id',
                'chi_tiet_dat_lichs.id_phieu_dat_lich',
                'chi_tiet_dat_lichs.id_bac_si',
                'chi_tiet_dat_lichs.thoi_gian_bat_dau',
                'chi_tiet_dat_lichs.thoi_gian_ket_thuc',
                'chi_tiet_dat_lichs.so_sao_danh_gia',
                'chi_tiet_dat_lichs.don_thuoc',
                'chi_tiet_dat_lichs.chuan_doan',
                'chi_tiet_dat_lichs.ghi_chu',
                'chi_tiet_dat_lichs.thoi_gian_ket_thuc_kham',
                'chi_tiet_dat_lichs.nhan_xet',
                'chi_tiet_dat_lichs.ngay_danh_gia',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'bac_sis.ho_ten as ten_bac_si',
                'phieu_dat_lichs.id_benh_nhan',
                'phieu_dat_lichs.tinh_trang as trang_thai',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.ngay_dat_hen',
            )
            ->orderBy('phieu_dat_lichs.id', 'desc')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu hồ sơ bệnh án thành công',
            'data' => $data
        ]);
    }

    public function timKiemHoSoBenhAn(Request $request)
    {
        // Kiểm tra quyền: Quản lý hồ sơ bệnh án (ID = 10)
        $id_chuc_nang = 10;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $timKiem = trim($request->noi_dung_tim);

        $data = ChiTietDatLich::join('phieu_dat_lichs', 'chi_tiet_dat_lichs.id_phieu_dat_lich', '=', 'phieu_dat_lichs.id')
            ->join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->where('benh_nhans.ho_ten', 'like', '%' . $timKiem . '%')
            ->orWhere('bac_sis.ho_ten', 'like', '%' . $timKiem . '%')
            ->select(
                'phieu_dat_lichs.id_benh_nhan',
                'chi_tiet_dat_lichs.id',
                'chi_tiet_dat_lichs.id_phieu_dat_lich',
                'chi_tiet_dat_lichs.id_bac_si',
                'chi_tiet_dat_lichs.thoi_gian_bat_dau',
                'chi_tiet_dat_lichs.thoi_gian_ket_thuc',
                'chi_tiet_dat_lichs.so_sao_danh_gia',
                'chi_tiet_dat_lichs.don_thuoc',
                'chi_tiet_dat_lichs.chuan_doan',
                'chi_tiet_dat_lichs.ghi_chu',
                'chi_tiet_dat_lichs.thoi_gian_ket_thuc_kham',
                'chi_tiet_dat_lichs.nhan_xet',
                'chi_tiet_dat_lichs.ngay_danh_gia',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'bac_sis.ho_ten as ten_bac_si',
                'phieu_dat_lichs.tinh_trang as trang_thai',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.ngay_dat_hen'
            )
            ->orderBy('phieu_dat_lichs.id', 'desc')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Tìm thấy ' . $data->count() . ' hồ sơ bệnh án phù hợp',
            'data' => $data
        ]);
    }

    public function createHoSoBenhAn(CreateHoSoBenhAnRequest $request)
    {
        // Kiểm tra quyền: Quản lý hồ sơ bệnh án (ID = 10)
        $id_chuc_nang = 10;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $phieuDatLich = PhieuDatLich::create([
            'id_benh_nhan' => $request->id_benh_nhan,
            'ly_do_kham' => $request->ly_do_kham,
            'ngay_dat_hen' => $request->ngay_dat_hen,
            'tinh_trang' => $request->trang_thai
        ]);
        $chiTietDatLich = ChiTietDatLich::create([
            'id_phieu_dat_lich' => $phieuDatLich->id,
            'id_bac_si' => $request->id_bac_si,
            'chuan_doan' => $request->chuan_doan,
            'don_thuoc' => $request->don_thuoc,
            'danh_gia' => $request->danh_gia,
            'ghi_chu' => $request->ghi_chu
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Thêm hồ sơ bệnh án thành công',
            'data' => $chiTietDatLich,
            'phieu_dat_lich' => $phieuDatLich
        ]);
    }
    public function updateHoSoBenhAn(UpdateHoSoBenhAnRequest $request)
    {
        // Kiểm tra quyền: Quản lý hồ sơ bệnh án (ID = 10)
        $id_chuc_nang = 10;
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
                'message' => 'Không tìm thấy hồ sơ bệnh án'
            ], 404);
        }
        $chiTietDatLich->update([
            'id_bac_si' => $request->id_bac_si,
            'thoi_gian_bat_dau' => $request->ngay_dat_hen,
            'chuan_doan' => $request->chuan_doan,
            'don_thuoc' => $request->don_thuoc,
            'ghi_chu' => $request->ghi_chu,
        ]);
        $phieuDatLich = PhieuDatLich::find($chiTietDatLich->id_phieu_dat_lich);
        if ($phieuDatLich) {
            $phieuDatLich->update([
                'id_benh_nhan' => $request->id_benh_nhan,
                'ly_do_kham' => $request->ly_do_kham,
                'ngay_dat_hen' => $request->ngay_dat_hen,
                'tinh_trang' => $request->trang_thai
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật hồ sơ bệnh án thành công',
            'data' => $chiTietDatLich,
            'phieu_dat_lich' => $phieuDatLich
        ]);
    }
    public function changeStatusHoSoBenhAn(ChangeStatusHoSoBenhAnRequest $request)
    {
        // Kiểm tra quyền: Quản lý hồ sơ bệnh án (ID = 10)
        $id_chuc_nang = 10;
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
                'message' => 'Không tìm thấy hồ sơ bệnh án'
            ], 404);
        }
        $phieuDatLich = PhieuDatLich::find($chiTietDatLich->id_phieu_dat_lich);
        if (!$phieuDatLich) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy phiếu đặt lịch liên quan'
            ], 404);
        }
        switch ($phieuDatLich->tinh_trang) {
            case 0:
                $phieuDatLich->tinh_trang = 1;
                break;
            case 1:
                $phieuDatLich->tinh_trang = 2;
                break;
            case 2:
                $phieuDatLich->tinh_trang = 3;
                break;
            default:
                $phieuDatLich->tinh_trang = 0;
        }
        $phieuDatLich->save();
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật trạng thái hồ sơ bệnh án thành công',
            'data' => [
                'phieu_dat_lich' => $phieuDatLich,
                'chi_tiet_dat_lich' => $chiTietDatLich
            ],
        ]);
    }

    public function deleteHoSoBenhAn(DeleteHoSoBenhAnRequest $request)
    {
        // Kiểm tra quyền: Quản lý hồ sơ bệnh án (ID = 10)
        $id_chuc_nang = 10;
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
                'message' => 'Không tìm thấy hồ sơ bệnh án'
            ], 404);
        }
        $chiTietDatLich->delete();
        $phieuDatLich = PhieuDatLich::find($chiTietDatLich->id_phieu_dat_lich);
        if ($phieuDatLich && !ChiTietDatLich::where('id_phieu_dat_lich', $phieuDatLich->id)->exists()) {
            $phieuDatLich->delete();
        }
        return response()->json([
            'status' => true,
            'message' => 'Xóa hồ sơ bệnh án thành công'
        ]);
    }
}
