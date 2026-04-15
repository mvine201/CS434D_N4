<?php

namespace App\Http\Controllers;

use App\Http\Requests\BacSi\BacSiDoiMatKhauRequest;
use App\Http\Requests\BacSi\CapNhatLichCaNhanRequest;
use App\Http\Requests\BacSi\CapNhatLichLamViecRequest;
use App\Http\Requests\BacSi\CapNhatThongTinCaNhanRequest;
use App\Http\Requests\BacSi\DangKyRequest;
use App\Http\Requests\BacSi\ThemLichLamViecRequest;
use App\Http\Requests\BacSi\ThemMoiLichCaNhanRequest;
use App\Http\Requests\BacSi\XoaLichLamViecRequest;
use App\Http\Requests\BacSi\UpdateProfileRequest;
use App\Http\Requests\BacSi\ChangePasswordBacSiRequest;
use App\Http\Requests\BacSi\CreateTaiKhoanBacSiRequest;
use App\Http\Requests\BacSi\UpdateProfileBacSiRequest;
use App\Http\Requests\BacSi\ChangeStatusBacSiRequest;
use App\Http\Requests\BacSi\CreateBacSiRequest;
use App\Http\Requests\BacSi\DeleteBacSiRequest;
use App\Http\Requests\BacSi\UpdateBacSiRequest;
use App\Jobs\SendMailJob;
use App\Mail\MasterMail;
use App\Models\BacSi;
use App\Models\BacSiChuyenNganh;
use App\Models\ChucVu;
use App\Models\LichLamViec;
use App\Models\ChiTietDatLich;
use App\Models\BenhNhan;
use App\Models\ChuyenKhoa;
use App\Models\PhongKham;
use App\Models\PhieuDatLich;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BacSiController extends Controller
{

    // Quản lý bác sĩ
    public function getDataBacSi()
    {
        // Kiểm tra quyền: Quản lý bác sĩ (ID = 5)
        $id_chuc_nang = 5;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = BacSi::join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
            ->join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
            ->select(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.email',
                'bac_sis.so_dien_thoai',
                'bac_sis.ngay_sinh',
                'bac_sis.gioi_tinh',
                'bac_sis.chuc_danh',
                'bac_sis.so_nam_kinh_nghiem',
                'bac_sis.mo_ta',
                'bac_sis.kinh_nghiem_lam_viec',
                'bac_sis.qua_trinh_dao_tao',
                'bac_sis.chung_chi',
                'bac_sis.thanh_tuu',
                'bac_sis.thanh_vien_to_chuc',
                'bac_sis.tinh_trang',
                'bac_sis.hinh_anh',
                'bac_sis.id_phong_kham',
                'phong_khams.ten_phong_kham',
                DB::raw("GROUP_CONCAT(chuyen_khoas.ten_chuyen_khoa SEPARATOR ', ') as list_chuyen_khoa")
            )
            ->orderBy('bac_sis.id', 'desc')
            ->groupBy(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.email',
                'bac_sis.so_dien_thoai',
                'bac_sis.ngay_sinh',
                'bac_sis.gioi_tinh',
                'bac_sis.chuc_danh',
                'bac_sis.so_nam_kinh_nghiem',
                'bac_sis.mo_ta',
                'bac_sis.kinh_nghiem_lam_viec',
                'bac_sis.qua_trinh_dao_tao',
                'bac_sis.chung_chi',
                'bac_sis.thanh_tuu',
                'bac_sis.thanh_vien_to_chuc',
                'bac_sis.tinh_trang',
                'bac_sis.hinh_anh',
                'bac_sis.id_phong_kham',
                'phong_khams.ten_phong_kham'
            )
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu bác sĩ thành công',
            'data' => $data,
        ]);
    }
    public function storeBacSi(CreateBacSiRequest $request)
    {
        // Kiểm tra quyền: Quản lý bác sĩ (ID = 5)
        $id_chuc_nang = 5;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $bs = BacSi::create([
            'ho_ten'            => $request->ho_ten,
            'email'             => $request->email,
            'password'          => bcrypt('123456'),
            'so_dien_thoai'     => $request->so_dien_thoai,
            'ngay_sinh'         => $request->ngay_sinh,
            'gioi_tinh'         => $request->gioi_tinh,
            'id_phong_kham'     => $request->id_phong_kham,
            'chuc_danh'         => $request->chuc_danh,
            'so_nam_kinh_nghiem'   => $request->so_nam_kinh_nghiem,
            'mo_ta'             => $request->mo_ta,
            'kinh_nghiem_lam_viec' => $request->kinh_nghiem_lam_viec,
            'qua_trinh_dao_tao' => $request->qua_trinh_dao_tao,
            'chung_chi'         => $request->chung_chi,
            'thanh_tuu'         => $request->thanh_tuu,
            'thanh_vien_to_chuc' => $request->thanh_vien_to_chuc,
            'tinh_trang'        => $request->tinh_trang,
            'hinh_anh'          => $request->hinh_anh,
        ]);
        if (!empty($request->chuyen_khoa)) {
            $items = [];
            foreach ((array) $request->chuyen_khoa as $ck) {
                if ($ck !== null && $ck !== '') {
                    $items[] = [
                        'id_bac_si' => $bs->id,
                        'id_chuyen_khoa' => (int) $ck,
                    ];
                }
            }
            if (!empty($items)) {
                BacSiChuyenNganh::insert($items);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Thêm mới bác sĩ ' . $request->ho_ten . ' thành công',
            'data' => $bs,
        ]);
    }

    public function updateBacSi(UpdateBacSiRequest $request)
    {
        // Kiểm tra quyền: Quản lý bác sĩ (ID = 5)
        $id_chuc_nang = 5;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        BacSi::find($request->id)->update([
            'ho_ten'                => $request->ho_ten,
            'email'                 => $request->email,
            'so_dien_thoai'         => $request->so_dien_thoai,
            'ngay_sinh'             => $request->ngay_sinh,
            'gioi_tinh'             => $request->gioi_tinh,
            'id_phong_kham'         => $request->id_phong_kham,
            'chuc_danh'             => $request->chuc_danh,
            'so_nam_kinh_nghiem'    => $request->so_nam_kinh_nghiem,
            'mo_ta'                 => $request->mo_ta,
            'kinh_nghiem_lam_viec'  => $request->kinh_nghiem_lam_viec,
            'qua_trinh_dao_tao'     => $request->qua_trinh_dao_tao,
            'chung_chi'             => $request->chung_chi,
            'thanh_tuu'             => $request->thanh_tuu,
            'thanh_vien_to_chuc'    => $request->thanh_vien_to_chuc,
            'tinh_trang'            => $request->tinh_trang,
            'hinh_anh'              => $request->hinh_anh,
        ]);
        if ($request->has('chuyen_khoa') && !empty($request->chuyen_khoa)) {
            BacSiChuyenNganh::where('id_bac_si', $request->id)->delete();
            $items = [];
            foreach ((array) $request->chuyen_khoa as $ck) {
                if ($ck !== null && $ck !== '') {
                    $items[] = [
                        'id_bac_si' => (int) $request->id,
                        'id_chuyen_khoa' => (int) $ck,
                    ];
                }
            }
            if (!empty($items)) {
                BacSiChuyenNganh::insert($items);
            }
        }

        return response()->json([
            'status'  => true,
            'message' => 'Cập nhật bác sĩ ' . $request->ho_ten . ' thành công'
        ]);
    }
    public function destroyBacSi(DeleteBacSiRequest $request)
    {
        // Kiểm tra quyền: Quản lý bác sĩ (ID = 5)
        $id_chuc_nang = 5;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        try {
            $bacSi = BacSi::where('id', $request->id)->first();
            if (empty($bacSi)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy bác sĩ'
                ], 404);
            }
            $bacSi->delete();
            return response()->json([
                'status' => true,
                'message' => 'Xóa bác sĩ ' . $bacSi->ho_ten . ' thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi: ' . $e->getMessage()
            ], 500);
        }
    }
    public function changeStatusBacSi(ChangeStatusBacSiRequest $request)
    {
        // Kiểm tra quyền: Quản lý bác sĩ (ID = 5)
        $id_chuc_nang = 5;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $bacSi = BacSi::where('id', $request->id)->first();
        if (empty($bacSi)) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bác sĩ'
            ], 404);
        }
        $bacSi->update([
            'tinh_trang' => $bacSi->tinh_trang == 1 ? 0 : 1
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật trạng thái cho bác sĩ ' . $bacSi->ho_ten . ' thành công'
        ]);
    }
    public function searchBacSi(Request $request)
    {
        // Kiểm tra quyền: Quản lý bác sĩ (ID = 5)
        $id_chuc_nang = 5;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $timKiem = trim($request->noi_dung_tim);
        $data = BacSi::where('ho_ten', 'like', '%' . $timKiem . '%')
            ->join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
            ->join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
            ->select(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.email',
                'bac_sis.so_dien_thoai',
                'bac_sis.ngay_sinh',
                'bac_sis.gioi_tinh',
                'bac_sis.chuc_danh',
                'bac_sis.so_nam_kinh_nghiem',
                'bac_sis.mo_ta',
                'bac_sis.kinh_nghiem_lam_viec',
                'bac_sis.qua_trinh_dao_tao',
                'bac_sis.chung_chi',
                'bac_sis.thanh_tuu',
                'bac_sis.thanh_vien_to_chuc',
                'bac_sis.tinh_trang',
                'bac_sis.hinh_anh',
                'bac_sis.id_phong_kham',
                'phong_khams.ten_phong_kham',
                DB::raw("GROUP_CONCAT(chuyen_khoas.ten_chuyen_khoa SEPARATOR ', ') as list_chuyen_khoa")
            )
            ->orderBy('bac_sis.id', 'desc')
            ->groupBy(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.email',
                'bac_sis.so_dien_thoai',
                'bac_sis.ngay_sinh',
                'bac_sis.gioi_tinh',
                'bac_sis.chuc_danh',
                'bac_sis.so_nam_kinh_nghiem',
                'bac_sis.mo_ta',
                'bac_sis.kinh_nghiem_lam_viec',
                'bac_sis.qua_trinh_dao_tao',
                'bac_sis.chung_chi',
                'bac_sis.thanh_tuu',
                'bac_sis.thanh_vien_to_chuc',
                'bac_sis.tinh_trang',
                'bac_sis.hinh_anh',
                'bac_sis.id_phong_kham',
                'phong_khams.ten_phong_kham'
            )
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Tìm kiếm bác sĩ thành công',
            'data' => $data
        ]);
    }

    // Login
    public function loginBacSi(Request $request)
    {
        $check = Auth::guard('bac_si')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);
        if ($check) {
            $bacSi = Auth::guard('bac_si')->user();
            if($bacSi->is_active == 0){
                return response()->json([
                    'status' => false,
                    'message' => 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email để kích hoạt tài khoạn',
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Đăng nhập thành công',
                'token' => $bacSi->createToken('token_bac_si')->plainTextToken,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản hoặc mật khẩu không đúng'
            ]);
        }
    }
    public function registerBacSi(CreateTaiKhoanBacSiRequest $request)
    {
        $hash_active_account = Str::uuid();
        $bacSi = BacSi::create([
            'ho_ten' => $request->ho_ten,
            'email'  => $request->email,
            'password'  => bcrypt($request->password),
            'so_dien_thoai' => $request->so_dien_thoai,
            'ngay_sinh' => $request->ngay_sinh,
            'gioi_tinh' => $request->gioi_tinh,
            'dia_chi' => $request->dia_chi,
            'hash_active' => $hash_active_account,
        ]);
        //gửi email
        $tieu_de = "kích hoạt tài khoản bác sĩ";
        $data['ho_ten'] = $request->ho_ten;
        $data['link'] = "http://localhost:5173/bac-si/kich-hoat/" . $hash_active_account;
        $view = 'kich_hoat_tai_khoan_bac_si';

        Mail::to($request->email)->send(new MasterMail($tieu_de, $data, $view));
        return response()->json([
            'status'    => true,
            'message' => 'Đăng ký thành công. Vui lòng kiểm tra email để kích hoạt tài khoản',
        ]);
    }
    public function kichHoatBacSi(Request $request)
    {
        $code = $request->ma_code;
        $check = BacSi::where('hash_active', $code)->where('is_active', 0)->first();
        if ($check) {
            $check->is_active = 1;
            $check->hash_active = null;
            $check->save();
            return response()->json([
                'status' => true,
                'message' => 'Kích hoạt tài khoản thành công.Vui lòng đăng nhập hệ thống',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Kích hoạt tài khoản thất bại.Vui lòng kiểm tra lại mã kích hoạt',
            ]);
        }
    }
    // Logout
    public function logoutBacSi()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user && $user->currentAccessToken()) {
            DB::table('personal_access_tokens')
                ->where('id', $user->currentAccessToken()->id)
                ->delete();
            return response()->json([
                'status'  => true,
                'message' => "Đăng xuất thành công",
            ]);
        }
        else {
            return response()->json([
                'status'  => false,
                'message' => "Có lỗi xảy ra",
            ]);
        }
    }
    // Quản Lý Bệnh Nhân
    public function getDataBenhNhan()
    {
        $bacSi = Auth::guard('sanctum')->user();
        if (!$bacSi) {
            return response()->json([
                'status' => false,
                'message' => 'không tìm thấy bác sĩ',
            ]);
        } else {
            $data = BenhNhan::join('phieu_dat_lichs', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
                ->join('chi_tiet_dat_lichs', 'chi_tiet_dat_lichs.id_phieu_dat_lich', '=', 'phieu_dat_lichs.id')
                ->where('chi_tiet_dat_lichs.id_bac_si', $bacSi->id)
                ->select(
                    'benh_nhans.id',
                    'benh_nhans.ho_ten',
                    'benh_nhans.email',
                    'benh_nhans.so_dien_thoai',
                    'benh_nhans.ngay_sinh',
                    'benh_nhans.gioi_tinh',
                    'benh_nhans.dia_chi',
                    'phieu_dat_lichs.ly_do_kham',
                    'phieu_dat_lichs.ngay_dat_hen',
                    'phieu_dat_lichs.tinh_trang',
                    'chi_tiet_dat_lichs.chuan_doan',
                    'chi_tiet_dat_lichs.ghi_chu',
                    'chi_tiet_dat_lichs.nhan_xet',
                    'chi_tiet_dat_lichs.don_thuoc',
                )
                ->orderBy('phieu_dat_lichs.ngay_dat_hen', 'desc')
                ->groupBy(
                    'benh_nhans.id',
                    'benh_nhans.ho_ten',
                    'benh_nhans.email',
                    'benh_nhans.so_dien_thoai',
                    'benh_nhans.ngay_sinh',
                    'benh_nhans.gioi_tinh',
                    'benh_nhans.dia_chi',
                    'phieu_dat_lichs.ly_do_kham',
                    'phieu_dat_lichs.tinh_trang',
                    'phieu_dat_lichs.ngay_dat_hen',
                    'chi_tiet_dat_lichs.chuan_doan',
                    'chi_tiet_dat_lichs.ghi_chu',
                    'chi_tiet_dat_lichs.nhan_xet',
                    'chi_tiet_dat_lichs.don_thuoc',
                )
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Lấy dữ liệu bệnh nhân thành công',
                'data' => $data
            ]);
        }
    }

    // Lấy lịch sử khám bệnh của bệnh nhân
    public function getLichSuKhamBenh(Request $request)
    {
        $bacSi = Auth::guard('sanctum')->user();
        if (!$bacSi) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bác sĩ',
            ]);
        }
        if (!$request->id_benh_nhan) {
            return response()->json([
                'status' => false,
                'message' => 'Thiếu thông tin bệnh nhân',
            ]);
        }
        $benhNhan = BenhNhan::where('id', $request->id_benh_nhan)->first();
        $data = ChiTietDatLich::join('phieu_dat_lichs', 'chi_tiet_dat_lichs.id_phieu_dat_lich', '=', 'phieu_dat_lichs.id')
            ->join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->where('chi_tiet_dat_lichs.id_bac_si', $bacSi->id)
            ->where('benh_nhans.id', $request->id_benh_nhan)
            ->select(
                'chi_tiet_dat_lichs.id',
                'phieu_dat_lichs.ngay_dat_hen',
                'phieu_dat_lichs.tinh_trang',
                'phieu_dat_lichs.ly_do_kham',
                'chi_tiet_dat_lichs.chuan_doan',
                'chi_tiet_dat_lichs.don_thuoc',
                'chi_tiet_dat_lichs.ghi_chu',
            )
            ->orderBy('phieu_dat_lichs.ngay_dat_hen', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Lấy lịch sử khám bệnh thành công',
            'data' => $data,
            'benh_nhan' => $benhNhan
        ]);
    }
    public function timKiemBenhNhan(Request $request)
    {
        $bacSi = Auth::guard('sanctum')->user();
        if (!$bacSi) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bác sĩ',
            ]);
        }

        $timKiem = trim($request->noi_dung_tim);
        $data = BenhNhan::join('phieu_dat_lichs', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->join('chi_tiet_dat_lichs', 'chi_tiet_dat_lichs.id_phieu_dat_lich', '=', 'phieu_dat_lichs.id')
            ->where('chi_tiet_dat_lichs.id_bac_si', $bacSi->id)
            ->where(function ($query) use ($timKiem) {
                $query->where('benh_nhans.ho_ten', 'like', '%' . $timKiem . '%')
                    ->orWhere('benh_nhans.email', 'like', '%' . $timKiem . '%')
                    ->orWhere('benh_nhans.so_dien_thoai', 'like', '%' . $timKiem . '%');
            })
            ->select(
                'benh_nhans.id',
                'benh_nhans.ho_ten',
                'benh_nhans.email',
                'benh_nhans.so_dien_thoai',
                'benh_nhans.ngay_sinh',
                'benh_nhans.gioi_tinh',
                'benh_nhans.dia_chi',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.ngay_dat_hen',
                'phieu_dat_lichs.tinh_trang',
                'chi_tiet_dat_lichs.chuan_doan',
                'chi_tiet_dat_lichs.ghi_chu',
                'chi_tiet_dat_lichs.nhan_xet',
                'chi_tiet_dat_lichs.don_thuoc',
            )
            ->orderBy('benh_nhans.id', 'desc')
            ->groupBy(
                'benh_nhans.id',
                'benh_nhans.ho_ten',
                'benh_nhans.email',
                'benh_nhans.so_dien_thoai',
                'benh_nhans.ngay_sinh',
                'benh_nhans.gioi_tinh',
                'benh_nhans.dia_chi',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.tinh_trang',
                'phieu_dat_lichs.ngay_dat_hen',
                'chi_tiet_dat_lichs.chuan_doan',
                'chi_tiet_dat_lichs.ghi_chu',
                'chi_tiet_dat_lichs.nhan_xet',
                'chi_tiet_dat_lichs.don_thuoc',
            )
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Tìm kiếm bệnh nhân thành công',
            'data' => $data
        ]);
    }

    public function checkTokenBacSi()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user && $user instanceof \App\Models\BacSi) {
            return response()->json([
                'status' => true,
                'ho_ten'    => $user->ho_ten,
                'chuc_danh' => $user->chuc_danh,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập hệ thống!',
            ]);
        }
    }

    // quản lý profile
    public function getProfile()
    {
        $bacSi = Auth::guard('sanctum')->user();
        $data = BacSi::join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
                    ->join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
                    ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
                    ->where('bac_sis.id', $bacSi->id)
                    ->select(
                        'bac_sis.id',
                        'bac_sis.ho_ten',
                        'bac_sis.email',
                        'bac_sis.so_dien_thoai',
                        'bac_sis.ngay_sinh',
                        'bac_sis.gioi_tinh',
                        'bac_sis.chuc_danh',
                        'bac_sis.so_nam_kinh_nghiem',
                        'bac_sis.mo_ta',
                        'bac_sis.kinh_nghiem_lam_viec',
                        'bac_sis.qua_trinh_dao_tao',
                        'bac_sis.chung_chi',
                        'bac_sis.thanh_tuu',
                        'bac_sis.thanh_vien_to_chuc',
                        'bac_sis.tinh_trang',
                        'bac_sis.hinh_anh',
                        'bac_sis.id_phong_kham',
                        'phong_khams.ten_phong_kham',
                        DB::raw("GROUP_CONCAT(chuyen_khoas.ten_chuyen_khoa SEPARATOR ', ') as list_chuyen_khoa")
                    )
                    ->groupBy(
                        'bac_sis.id',
                        'bac_sis.ho_ten',
                        'bac_sis.email',
                        'bac_sis.so_dien_thoai',
                        'bac_sis.ngay_sinh',
                        'bac_sis.gioi_tinh',
                        'bac_sis.chuc_danh',
                        'bac_sis.so_nam_kinh_nghiem',
                        'bac_sis.mo_ta',
                        'bac_sis.kinh_nghiem_lam_viec',
                        'bac_sis.qua_trinh_dao_tao',
                        'bac_sis.chung_chi',
                        'bac_sis.thanh_tuu',
                        'bac_sis.thanh_vien_to_chuc',
                        'bac_sis.tinh_trang',
                        'bac_sis.hinh_anh',
                        'bac_sis.id_phong_kham',
                        'phong_khams.ten_phong_kham'
                    )
                    ->first();
        return response()->json([
            'status' => true,
            'message' => 'Lấy thông tin profile thành công',
            'data' => $data,
        ]);
    }
    public function updateProfile(UpdateProfileBacSiRequest $request)
    {
        $bacSi = Auth::guard('sanctum')->user();
        BacSi::find($bacSi->id)->update([
            'ho_ten'                => $request->ho_ten,
            'email'                 => $request->email,
            'so_dien_thoai'         => $request->so_dien_thoai,
            'ngay_sinh'             => $request->ngay_sinh,
            'gioi_tinh'             => $request->gioi_tinh,
            'id_phong_kham'         => $request->id_phong_kham,
            'chuc_danh'             => $request->chuc_danh,
            'so_nam_kinh_nghiem'    => $request->so_nam_kinh_nghiem,
            'mo_ta'                 => $request->mo_ta,
            'kinh_nghiem_lam_viec'  => $request->kinh_nghiem_lam_viec,
            'qua_trinh_dao_tao'     => $request->qua_trinh_dao_tao,
            'chung_chi'             => $request->chung_chi,
            'thanh_tuu'             => $request->thanh_tuu,
            'thanh_vien_to_chuc'    => $request->thanh_vien_to_chuc,
            'hinh_anh'              => $request->hinh_anh,
        ]);

        if ($request->has('chuyen_khoa') && !empty($request->chuyen_khoa)) {
            BacSiChuyenNganh::where('id_bac_si', $bacSi->id)->delete();
            $items = [];
            foreach ((array) $request->chuyen_khoa as $ck) {
                if ($ck !== null && $ck !== '') {
                    $items[] = [
                        'id_bac_si' => (int) $bacSi->id,
                        'id_chuyen_khoa' => (int) $ck,
                    ];
                }
            }
            if (!empty($items)) {
                BacSiChuyenNganh::insert($items);
            }
        }

        return response()->json([
            'status'  => true,
            'message' => 'Cập nhật thông tin cá nhân ' . $request->ho_ten . ' thành công'
        ]);
    }
    public function changePassword(ChangePasswordBacSiRequest $request)
    {
        $user_login = Auth::guard('sanctum')->user();
        $bacSi = BacSi::where('id', $user_login->id)->first();
        if ($bacSi) {
            if (Hash::check($request->password, $bacSi->password)) {
                if (Hash::check($request->new_password, $bacSi->password)) {
                    return response()->json([
                        'status'    => 0,
                        'message'   => 'Mật khẩu mới phải khác mật khẩu hiện tại!',
                    ]);
                }
                $bacSi->update([
                    'password' => Hash::make($request->new_password)
                ]);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đổi mật khẩu thành công!'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Mật khẩu cũ không đúng!'
                ]);
            }
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Không tìm thấy bác sĩ!'
            ]);
        }
    }
    public function updateProfileAvatar(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $data = $request->all();
        $file = $data['hinh_anh'];
        $file_extention = $file->getClientOriginalExtension();
        $file_name = \Illuminate\Support\Str::slug($user->ho_ten) . "." . $file_extention;
        $cho_luu = "BacSiAVT\\" . $file_name;
        $file->move("BacSiAVT", $file_name);
        $hinh_anh = "http://127.0.0.1:8000/" . $cho_luu;

        BacSi::find($user->id)->update([
            'hinh_anh' => $hinh_anh
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đã đổi ảnh đại diện thành công!'
        ]);
    }
    public function getDataLichHenBenhNhan()
    {
        $bacSi = Auth::guard('sanctum')->user();

        if (!$bacSi) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bác sĩ',
            ], 401);
        }
        $data = PhieuDatLich::join('benh_nhans', 'phieu_dat_lichs.id_benh_nhan', '=', 'benh_nhans.id')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->where('chi_tiet_dat_lichs.id_bac_si', $bacSi->id)
            ->select(
                'phieu_dat_lichs.id',
                'phieu_dat_lichs.ngay_dat_hen',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.tinh_trang',
                'phieu_dat_lichs.created_at',
                'benh_nhans.id as id_benh_nhan',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'benh_nhans.email as email_benh_nhan',
                'benh_nhans.so_dien_thoai as sdt_benh_nhan',
                'benh_nhans.ngay_sinh as ngay_sinh_benh_nhan',
                'benh_nhans.gioi_tinh as gioi_tinh_benh_nhan',
                'chi_tiet_dat_lichs.chuan_doan',
                'chi_tiet_dat_lichs.ghi_chu',
                'chi_tiet_dat_lichs.nhan_xet',
                'chi_tiet_dat_lichs.don_thuoc'
            )
            ->orderBy('phieu_dat_lichs.ngay_dat_hen', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu lịch hẹn thành công',
            'data' => $data
        ]);
    }
    public function getDataPhongKhamBacSi()
    {
        $bacSi = Auth::guard('sanctum')->user();
        $data = PhongKham::all();
        if (!$bacSi) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bác sĩ',
            ], 401);
        }
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu phòng khám thành công',
            'data' => $data
        ]);
    }
    // lấy danh sách chuyên khoa
    public function getDataChuyenKhoaBacSi()
    {
        $bacSi = Auth::guard('sanctum')->user();
        $data = ChuyenKhoa::all();
        if (!$bacSi) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bác sĩ',
            ], 401);
        }
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu chuyên khoa thành công',
            'data' => $data
        ]);
    }
    // lấy lịch làm cá nhân
    public function getDataLichLamViecBacSi(Request $request)
    {
        $bacSi = Auth::guard('sanctum')->user();
        if (empty($bacSi)) {
            return response()->json([
                'status' => false,
                'message' => 'Thiếu thông tin bác sĩ'
            ]);
        }

        if (!BacSi::where('id', $bacSi->id)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Bác sĩ không tồn tại'
            ]);
        }

        $from = $request->input('from_date', now()->toDateString());
        $to = $request->input('to_date', now()->toDateString());
        $today = Carbon::parse($from)->toDateString();
        $to = Carbon::parse($to)->toDateString();
        $data = LichLamViec::where('id_bac_si', $bacSi->id)
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

    public function quenMatKhauBacSi(Request $request)
    {
        $bacSi = BacSi::where('email', $request->email)->first();
        if ($bacSi) {
            $hash_reset = Str::uuid();
            $tieu_de = "đặt lại mật khẩu";
            $data['ho_ten'] = $bacSi->ho_ten;
            $data['link']= "http://localhost:5173/bac-si/doi-mat-khau/" . $hash_reset;
            $view ='quen_mat_khau_bac_si';

            SendMailJob::dispatch($data, $view, $tieu_de, $request->email);
            $bacSi->hash_reset = $hash_reset;
            $bacSi->save();
            return response()->json([
                'status' => true,
                'message' => 'Vui lòng kiểm tra email để đặt lại mật khẩu',
            ]);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Email không tồn tại',
            ]);
        }
    }
    public function doiMatKhauBacSi(BacSiDoiMatKhauRequest $request)
    {
        $bacSi = BacSi::where('hash_reset', $request->id_bac_si)->first();
        if ($bacSi) {
            $bacSi->password = bcrypt($request->password);
            $bacSi->hash_reset = null;
            $bacSi->save();
            return response()->json([
                'status' => true,
                'message' => 'Đổi mật khẩu thành công',
            ]);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Mã không tồn tại',
            ]);
        }
    }
   
}
