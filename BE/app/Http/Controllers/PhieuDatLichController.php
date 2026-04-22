<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Models\ChiTietDatLich;
use App\Models\PhieuDatLich;
use App\Models\BacSi;
use App\Models\BenhNhan;
use App\Models\LichLamViec;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PhieuDatLichController extends Controller
{
    // Update backend by CONGQUOC
    public function datLichKhamBenhNhan(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin người dùng'
            ], 401);
        }
        $ngayHen = $request->ngay_dat_hen;
        $gioBd = $request->thoi_gian_bat_dau;
        $gioKt = $request->thoi_gian_ket_thuc;
        $idBacSi = $request->id_bac_si;
        $gioBd = strlen($gioBd) === 5 ? ($gioBd . ':00') : $gioBd;
        $gioKt = strlen($gioKt) === 5 ? ($gioKt . ':00') : $gioKt;
        $batDau = $ngayHen . ' ' . $gioBd;
        $ketThuc = $ngayHen . ' ' . $gioKt;
        $slot = LichLamViec::where('id_bac_si', $idBacSi)
            ->whereDate('ngay_lam_viec', $ngayHen)
            ->where('thoi_gian_bat_dau', $gioBd)
            ->where('thoi_gian_ket_thuc', $gioKt)
            ->first();
        if (!$slot) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ không có lịch làm việc tại khung giờ đã chọn'
            ], 400);
        }
        $isBooked = DB::table('chi_tiet_dat_lichs')
            ->join('phieu_dat_lichs', 'chi_tiet_dat_lichs.id_phieu_dat_lich', '=', 'phieu_dat_lichs.id')
            ->where('chi_tiet_dat_lichs.id_bac_si', $idBacSi)
            ->where('chi_tiet_dat_lichs.thoi_gian_bat_dau', $batDau)
            ->where('phieu_dat_lichs.tinh_trang', '!=', PhieuDatLich::TINH_TRANG_DA_HUY)
            ->exists();
        if ($isBooked) {
            return response()->json([
                'status' => false,
                'message' => 'Khung giờ đã có lịch hẹn'
            ], 400);
        }


        // Lấy đơn giá khám từ bác sĩ
        $bacSi = BacSi::find($idBacSi);
        $tongTien = $bacSi->don_gia_kham;
        $phieuDatLich = PhieuDatLich::create([
            'id_benh_nhan' => $user->id,
            'ngay_dat_hen' => $ngayHen,
            'ly_do_kham' => $request->ly_do_kham,
            'tong_tien' => $tongTien,
            'tinh_trang' => PhieuDatLich::TINH_TRANG_CHO_XAC_NHAN,
            'is_thanh_toan' => PhieuDatLich::IS_THANH_TOAN_CHUA_THANH_TOAN,
        ]);

        $phieuDatLich->ma_dat_lich = 'HDBS' . str_pad($phieuDatLich->id, 6, '0', STR_PAD_LEFT);
        $phieuDatLich->save();

        ChiTietDatLich::create([
            'id_phieu_dat_lich' => $phieuDatLich->id,
            'id_bac_si' => $idBacSi,
            'thoi_gian_bat_dau' => $batDau,
            'thoi_gian_ket_thuc' => $ketThuc,
            'don_gia_kham' => $tongTien,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đặt lịch khám thành công',
            'data' => $phieuDatLich
        ]);
    }

    public function getBacSiTheoChuyenKhoa(Request $request)
    {
        $idChuyenKhoa = $request->id_chuyen_khoa;
        if (empty($idChuyenKhoa)) {
            return response()->json([
                'status' => false,
                'message' => 'Thiếu id_chuyen_khoa'
            ], 400);
        }
        $from = $request->input('from_date', now()->toDateString());
        $today = \Carbon\Carbon::parse($from)->toDateString();

        $bacSis = BacSi::join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->join('chuyen_khoas', 'chuyen_khoas.id', '=', 'bac_si_chuyen_nganhs.id_chuyen_khoa')
            ->join('phong_khams', 'phong_khams.id', '=', 'bac_sis.id_phong_kham')
            ->where('bac_si_chuyen_nganhs.id_chuyen_khoa', $idChuyenKhoa)
            ->where('bac_sis.is_block', 0)
            ->select(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.hinh_anh',
                'bac_sis.chuc_danh',
                'bac_sis.so_nam_kinh_nghiem',
                'bac_sis.don_gia_kham',
                'phong_khams.ten_phong_kham',
                'chuyen_khoas.ten_chuyen_khoa'
            )
            ->distinct()
            ->orderBy('bac_sis.ho_ten')
            ->get();
        if ($bacSis->isEmpty()) {
            return response()->json([
                'status' => true,
                'data' => []
            ]);
        }

        $doctorIds = $bacSis->pluck('id')->all();
        $lichTheoBacSi = LichLamViec::whereIn('id_bac_si', $doctorIds)
            ->whereDate('ngay_lam_viec', '>=', $today)
            ->orderBy('ngay_lam_viec')
            ->orderBy('thoi_gian_bat_dau')
            ->select(
                'id_bac_si',
                'ngay_lam_viec',
                'thoi_gian_bat_dau',
                'thoi_gian_ket_thuc'
            )
            ->get()
            ->groupBy('id_bac_si');

        $data = [];
        foreach ($bacSis as $bs) {
            $data[] = [
                'id' => $bs->id,
                'ho_ten' => $bs->ho_ten,
                'hinh_anh' => $bs->hinh_anh,
                'chuc_danh' => $bs->chuc_danh,
                'so_nam_kinh_nghiem' => $bs->so_nam_kinh_nghiem,
                'don_gia_kham' => $bs->don_gia_kham,
                'don_gia_kham_formatted' => number_format($bs->don_gia_kham, 0, ',', '.') . ' VNĐ',
                'ten_phong_kham' => $bs->ten_phong_kham,
                'ten_chuyen_khoa' => $bs->ten_chuyen_khoa,
                'lich_lam_viec' => ($lichTheoBacSi->get($bs->id) ?? collect())->values()
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
    public function huyLichKhamBenhNhan(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin người dùng'
            ], 401);
        }
        $phieuDatLich = PhieuDatLich::where('id_benh_nhan', $user->id)
            ->where('id', $request->id)
            ->first();
        if (!$phieuDatLich) {
            return response()->json([
                'status' => false,
                'message' => 'Lịch hẹn không tồn tại'
            ], 400);
        }
        $phieuDatLich->update([
            'tinh_trang' => PhieuDatLich::TINH_TRANG_DA_HUY
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Hủy lịch khám thành công'
        ]);
    }
    public function autoThanhToanLichHen()
    {
        $payload = [
            "USERNAME"  => "THANHTRUONG2311",
            "PASSWORD"  => "TruongCuaMaiLinh2809",
            "DAY_BEGIN" => Carbon::now()->format('d/m/Y'),
            "DAY_END"   => Carbon::now()->format('d/m/Y'),
            "NUMBER_MB" => "1910061030119"
        ];
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', "https://api-mb.midstack.io.vn/api/transactions", [
            'json' => $payload
        ]);

        $data = json_decode($res->getBody(), true);
        $list_history = $data['data']["transactionHistoryList"];
        foreach ($list_history as $index => $value) {
            if (preg_match('/TTKB(\d+)/', $value["description"], $matches)) {
                $id_don_hang = (int)$matches[1];
            } else {
                $id_don_hang = null; // hoặc xử lý nếu không tìm thấy
            }
            $row = PhieuDatLich::where('id', $id_don_hang)
                ->where('is_thanh_toan', 0)
                ->where('tong_tien', "=", $value["creditAmount"])
                ->where('tinh_trang', 1)
                ->first();
            if ($row) {
                $row->is_thanh_toan = 1;
                $row->save();
                $benhNhan = BenhNhan::where('id', $row->id_benh_nhan)->first();
                $xxx['ho_ten'] = $benhNhan->ho_ten;
                $xxx['so_tien'] = $row->tong_tien;
                $xxx['ly_do_kham'] = $row->ly_do_kham;

                SendMailJob::dispatch($xxx, 'thanh_toan_lich_hen', 'Thông báo thanh toán', $benhNhan->email);
            }
        }

        return $data;
    }

    public function kiemTraMaDatLich(Request $request)
    {
        $maDatLich = trim((string)($request->ma_dat_lich ?? ''));
        if ($maDatLich === '') {
            return response()->json([
                'status' => false,
                'message' => 'Vui lòng nhập mã đặt lịch'
            ], 422);
        }

        $row = PhieuDatLich::leftJoin('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->leftJoin('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->leftJoin('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->leftJoin('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
            ->leftJoin('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->leftJoin('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
            ->where('phieu_dat_lichs.ma_dat_lich', $maDatLich)
            ->select(
                'phieu_dat_lichs.ma_dat_lich',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.is_thanh_toan',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'bac_sis.ho_ten as ten_bac_si',
                'chuyen_khoas.ten_chuyen_khoa',
                'phong_khams.ten_phong_kham',
                'chi_tiet_dat_lichs.thoi_gian_bat_dau',
                'chi_tiet_dat_lichs.thoi_gian_ket_thuc'
            )
            ->first();

        if (!$row) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy phiếu đặt lịch phù hợp'
            ], 404);
        }

        $data = [
            'ma_dat_lich' => $row->ma_dat_lich,
            'ten_benh_nhan' => $row->ten_benh_nhan,
            'ten_bac_si' => $row->ten_bac_si,
            'ten_chuyen_khoa' => $row->ten_chuyen_khoa,
            'ten_phong_kham' => $row->ten_phong_kham,
            'thoi_gian_bat_dau' => $row->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc' => $row->thoi_gian_ket_thuc,
            'ly_do_kham' => $row->ly_do_kham,
            'is_thanh_toan' => (int) $row->is_thanh_toan,
        ];
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Kiểm tra phiếu đặt lịch thành công'
        ]);
    }
    public function GUImaillichhen()
    {
        //         SELECT benh_nhans.email, benh_nhans.ho_ten, phieu_dat_lichs.ly_do_kham, phieu_dat_lichs.ngay_dat_hen
        // FROM `phieu_dat_lichs` join benh_nhans on phieu_dat_lichs.id_benh_nhan  = benh_nhans.id
        // where phieu_dat_lichs.is_thanh_toan = 1 AND phieu_dat_lichs.ngay_dat_hen = "2025-09-28"
        $data = PhieuDatLich::join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->where('phieu_dat_lichs.is_thanh_toan', 1)
            ->whereDate('phieu_dat_lichs.ngay_dat_hen', Carbon::now()->addDays(2))
            ->select('benh_nhans.email', 'benh_nhans.ho_ten', 'phieu_dat_lichs.ly_do_kham', 'phieu_dat_lichs.ngay_dat_hen')
            ->get();

        foreach ($data as $key => $value) {
            $xxx['ho_ten']  = $value->ho_ten;
            $xxx['ngay_dat_hen']  = $value->ngay_dat_hen;
            $xxx['ly_do_kham']  = $value->ly_do_kham;
            SendMailJob::dispatch($xxx, 'gui_mail_thong_bao_lich_hen', 'Thông BÁO Lịch Khám', $value->email);
        }
    }
    public function hoaDonChiTiet(Request $request)
    {
        $data = PhieuDatLich::join('benh_nhans', 'benh_nhans.id', '=', 'phieu_dat_lichs.id_benh_nhan')
            ->join('chi_tiet_dat_lichs', 'chi_tiet_dat_lichs.id_phieu_dat_lich', '=', 'phieu_dat_lichs.id')
            ->join('bac_sis', 'bac_sis.id', '=', 'chi_tiet_dat_lichs.id_bac_si')
            ->leftJoin('bac_si_chuyen_nganhs', 'bac_si_chuyen_nganhs.id_bac_si', '=', 'bac_sis.id')
            ->leftJoin('chuyen_khoas', 'chuyen_khoas.id', '=', 'bac_si_chuyen_nganhs.id_chuyen_khoa')
            ->join('phong_khams', 'phong_khams.id', '=', 'bac_sis.id_phong_kham')
            ->select(
                'benh_nhans.ho_ten as ten_benh_nhan',
                'benh_nhans.so_dien_thoai as so_dien_thoai_benh_nhan',
                'benh_nhans.email as email_benh_nhan',
                'phieu_dat_lichs.id as ma_dat_lich',
                'benh_nhans.gioi_tinh',
                'benh_nhans.ngay_sinh',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.tinh_trang',
                'chi_tiet_dat_lichs.chuan_doan',
                'chi_tiet_dat_lichs.don_thuoc',
                'chi_tiet_dat_lichs.ghi_chu',
                'chi_tiet_dat_lichs.don_gia_kham',
                'bac_sis.ho_ten as ten_bac_si',
                'bac_sis.so_dien_thoai as so_dien_thoai_bac_si',
                'chuyen_khoas.ten_chuyen_khoa',
                'phong_khams.ten_phong_kham',
                DB::raw('DATE_FORMAT(phieu_dat_lichs.ngay_dat_hen, "%d/%m/%Y") as ngay_dat_hen'),
                DB::raw('DATE_FORMAT(chi_tiet_dat_lichs.thoi_gian_bat_dau, "%H:%i") as thoi_gian_bat_dau'),
                DB::raw('DATE_FORMAT(chi_tiet_dat_lichs.thoi_gian_ket_thuc, "%H:%i") as thoi_gian_ket_thuc')
            )
            ->where('phieu_dat_lichs.id', $request->id) // nhận id từ request
            ->first();
        if ($data) {
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy hóa đơn'
            ]);
        }
    }
}
