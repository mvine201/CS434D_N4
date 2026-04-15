<?php

namespace App\Http\Controllers;

use App\Models\BacSi;
use App\Models\LichLamViec;
use App\Models\ChiTietDatLich;
use App\Http\Requests\LichLamViec\CreateLichLamViecRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LichLamViecController extends Controller
{
    public function getNgayLamViecBacSi(Request $request)
    {
        $idBacSi = $request->id_bac_si;
        if (empty($idBacSi)) {
            return response()->json([
                'status' => false,
                'message' => 'Thiếu thông tin bác sĩ'
            ]);
        }

        if (!BacSi::where('id', $idBacSi)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ không tồn tại'
            ]);
        }

        $from = $request->input('from_date', now()->toDateString());
        $to = $request->input('to_date', now()->toDateString());
        $today = Carbon::parse($from)->toDateString();
        $to = Carbon::parse($to)->toDateString();
        $data = LichLamViec::where('id_bac_si', $idBacSi)
            ->whereDate('ngay_lam_viec', '>=', $today)
            ->orderBy('ngay_lam_viec')
            ->orderBy('thoi_gian_bat_dau')
            ->select('ngay_lam_viec', 'thoi_gian_bat_dau', 'thoi_gian_ket_thuc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
    public function getDataLichLamViecBacSi(Request $request)
    {
        // Kiểm tra quyền: Quản lý lịch làm việc bác sĩ (ID = 11)
        $id_chuc_nang = 11;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = LichLamViec::join('bac_sis', 'lich_lam_viecs.id_bac_si', '=', 'bac_sis.id')
            ->select(
                'lich_lam_viecs.id',
                'bac_sis.ho_ten',
                'lich_lam_viecs.ngay_lam_viec',
                'lich_lam_viecs.thoi_gian_bat_dau',
                'lich_lam_viecs.thoi_gian_ket_thuc',
            )
            ->orderBy('lich_lam_viecs.ngay_lam_viec')
            ->orderBy('lich_lam_viecs.thoi_gian_bat_dau')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
    public function createLichLamViecBacSi(CreateLichLamViecRequest $request)
    {
        // Kiểm tra quyền: Quản lý lịch làm việc bác sĩ (ID = 11)
        $id_chuc_nang = 11;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $bacSi = BacSi::find($request->id_bac_si);
        if (!$bacSi) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ không tồn tại'
            ], 404);
        }

        if ($bacSi->is_block) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ đã bị khóa, không thể tạo lịch làm việc'
            ], 400);
        }
        $existingSchedule = LichLamViec::where('id_bac_si', $request->id_bac_si)
            ->where('ngay_lam_viec', $request->ngay_lam_viec)
            ->where(function ($query) use ($request) {
                $query->whereBetween('thoi_gian_bat_dau', [$request->thoi_gian_bat_dau, $request->thoi_gian_ket_thuc])
                    ->orWhereBetween('thoi_gian_ket_thuc', [$request->thoi_gian_bat_dau, $request->thoi_gian_ket_thuc])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('thoi_gian_bat_dau', '<=', $request->thoi_gian_bat_dau)
                            ->where('thoi_gian_ket_thuc', '>=', $request->thoi_gian_ket_thuc);
                    });
            })
            ->exists();
        if ($existingSchedule) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ đã có lịch làm việc trùng thời gian này'
            ], 400);
        }
        $lichLamViec = LichLamViec::create([
            'id_bac_si' => $request->id_bac_si,
            'ngay_lam_viec' => $request->ngay_lam_viec,
            'thoi_gian_bat_dau' => $request->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc' => $request->thoi_gian_ket_thuc,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Tạo lịch làm việc thành công',
            'data' => $lichLamViec
        ], 201);
    }
}
