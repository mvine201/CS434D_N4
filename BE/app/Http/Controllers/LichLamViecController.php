<?php

namespace App\Http\Controllers;

use App\Http\Requests\LichLamViec\CreateLichLamViecRequest;
use App\Models\BacSi;
use App\Models\LichLamViec;
use App\Models\PhanQuyen;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class LichLamViecController extends Controller
{
    private const QUYEN_QUAN_LY_LICH_BAC_SI = 11;

    private function checkPermission(int $idChucNang): bool
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return false;
        }

        return PhanQuyen::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $idChucNang)
            ->exists();
    }

    /**
     * API công khai/lấy lịch làm việc theo bác sĩ
     * Route nên truyền id bác sĩ bằng param
     */
    public function getNgayLamViecBacSi(Request $request, int $id_bac_si): JsonResponse
    {
        $bacSi = BacSi::query()->find($id_bac_si);

        if (!$bacSi) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ không tồn tại',
            ], 404);
        }

        $fromDate = $request->input('from_date', now()->toDateString());
        $toDate   = $request->input('to_date', $fromDate);

        try {
            $fromDate = Carbon::parse($fromDate)->toDateString();
            $toDate   = Carbon::parse($toDate)->toDateString();
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Khoảng thời gian không hợp lệ',
            ], 422);
        }

        if ($fromDate > $toDate) {
            return response()->json([
                'status' => false,
                'message' => 'from_date phải nhỏ hơn hoặc bằng to_date',
            ], 422);
        }

        $data = LichLamViec::query()
            ->ofDoctor($id_bac_si)
            ->fromDate($fromDate)
            ->toDate($toDate)
            ->orderDefault()
            ->get([
                'id',
                'ngay_lam_viec',
                'thoi_gian_bat_dau',
                'thoi_gian_ket_thuc',
            ]);

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    /**
     * API admin lấy toàn bộ lịch làm việc bác sĩ
     */
    public function getDataLichLamViecBacSi(Request $request): JsonResponse
    {
        if (!$this->checkPermission(self::QUYEN_QUAN_LY_LICH_BAC_SI)) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không có quyền thực hiện chức năng này!',
            ], 403);
        }

        $query = LichLamViec::query()
            ->with('bacSi:id,ho_ten')
            ->orderDefault();

        if ($request->filled('id_bac_si')) {
            $query->where('id_bac_si', $request->id_bac_si);
        }

        if ($request->filled('from_date')) {
            $query->fromDate($request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->toDate($request->to_date);
        }

        $data = $query->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'id_bac_si' => $item->id_bac_si,
                'ho_ten' => optional($item->bacSi)->ho_ten,
                'ngay_lam_viec' => $item->ngay_lam_viec?->format('Y-m-d'),
                'thoi_gian_bat_dau' => $item->thoi_gian_bat_dau,
                'thoi_gian_ket_thuc' => $item->thoi_gian_ket_thuc,
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }

    /**
     * Tạo lịch làm việc cho bác sĩ
     */
    public function createLichLamViecBacSi(CreateLichLamViecRequest $request): JsonResponse
    {
        if (!$this->checkPermission(self::QUYEN_QUAN_LY_LICH_BAC_SI)) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không có quyền thực hiện chức năng này!',
            ], 403);
        }

        $bacSi = BacSi::query()->find($request->id_bac_si);

        if (!$bacSi) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ không tồn tại',
            ], 404);
        }

        if ((int) $bacSi->is_block === 1) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ đã bị khóa, không thể tạo lịch làm việc',
            ], 400);
        }

        try {
            $lichLamViec = DB::transaction(function () use ($request) {
                $isOverlapping = LichLamViec::query()
                    ->overlapping(
                        $request->id_bac_si,
                        $request->ngay_lam_viec,
                        $request->thoi_gian_bat_dau,
                        $request->thoi_gian_ket_thuc
                    )
                    ->lockForUpdate()
                    ->exists();

                if ($isOverlapping) {
                    return null;
                }

                return LichLamViec::query()->create([
                    'id_bac_si' => $request->id_bac_si,
                    'ngay_lam_viec' => $request->ngay_lam_viec,
                    'thoi_gian_bat_dau' => $request->thoi_gian_bat_dau,
                    'thoi_gian_ket_thuc' => $request->thoi_gian_ket_thuc,
                ]);
            });

            if (!$lichLamViec) {
                return response()->json([
                    'status' => false,
                    'message' => 'Bác sĩ đã có lịch làm việc trùng thời gian này',
                ], 409);
            }

            return response()->json([
                'status' => true,
                'message' => 'Tạo lịch làm việc thành công',
                'data' => $lichLamViec,
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể tạo lịch làm việc',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
