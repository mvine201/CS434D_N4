<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateBenhNhanRequest;
use App\Http\Requests\Admin\CreateNhanVienRequest;
use App\Http\Requests\Admin\UpdateNhanVienRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\BacSi;
use App\Models\BenhNhan;
use App\Models\PhieuDatLich;
use App\Models\ChiTietDatLich;
use App\Models\LichLamViec;
use App\Models\PhongKham;
use App\Models\ChuyenKhoa;
use Carbon\Carbon;
use App\Http\Requests\Admin\CreateBacSiRequest;
use App\Http\Requests\Admin\UpdateBacSiRequest;
use App\Http\Requests\Admin\TimKiemBacSiRequest;
use App\Http\Requests\Admin\ChangeStatusBacSiRequest;
use App\Http\Requests\Admin\ChangeStatusNhanVienRequest;
use App\Http\Requests\Admin\CreateHoSoBenhAnRequest;
use App\Http\Requests\Admin\DeleteNhanVienRequest;
use App\Http\Requests\Admin\AdminUpdateProfileRequest;
use App\Http\Requests\Admin\AdminChangePassWordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    public function layGioLamViec()
    {
        try {
            // Giả sử cấu hình được lưu trong bảng settings hoặc file config
            $gioLamViec = [
                'gio_mo_cua' => '08:00',
                'gio_dong_cua' => '17:00',
                'thoi_gian_kham' => 30, // 30 phút/lượt khám
                'so_luong_toi_da' => 8, // Số lượng bệnh nhân tối đa/giờ
                'lich_lam_viec' => [
                    'thu_2' => true,
                    'thu_3' => true,
                    'thu_4' => true,
                    'thu_5' => true,
                    'thu_6' => true,
                    'thu_7' => true,
                    'chu_nhat' => false
                ]
            ];

            return response()->json([
                'status' => true,
                'message' => 'Lấy cấu hình giờ làm việc thành công',
                'data' => $gioLamViec
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    // Quản lý chuyên khoa
    public function getDataChuyenKhoa()
    {
        $data = ChuyenKhoa::all();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu chuyên khoa thành công',
            'data' => $data
        ]);
    }

    // Quản lý lịch sử khám bệnh
    public function lichSuKhamBenh(Request $request, $id)
    {
        try {
            $lichSuKham = ChiTietDatLich::join('phieu_dat_lichs', 'chi_tiet_dat_lichs.id_phieu_dat_lich', '=', 'phieu_dat_lichs.id')
                ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
                ->join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
                ->where('phieu_dat_lichs.id_benh_nhan', $id)
                ->select(
                    'chi_tiet_dat_lichs.id',
                    'phieu_dat_lichs.ngay_dat_hen',
                    'phieu_dat_lichs.ly_do_kham',
                    'phieu_dat_lichs.tinh_trang',
                    'chi_tiet_dat_lichs.thoi_gian_bat_dau',
                    'chi_tiet_dat_lichs.thoi_gian_ket_thuc',
                    'chi_tiet_dat_lichs.chuan_doan',
                    'chi_tiet_dat_lichs.ghi_chu',
                    'bac_sis.ho_ten as ten_bac_si',
                    'phong_khams.ten_phong_kham',
                    'chi_tiet_dat_lichs.created_at'
                )
                ->orderBy('chi_tiet_dat_lichs.created_at', 'desc')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $lichSuKham
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi lấy lịch sử khám bệnh: ' . $e->getMessage()
            ], 500);
        }
    }

    // Quản lý lịch làm việc
    public function getLichLamViecData(Request $request)
    {
        $user = $this->isAdmin();

        $query = LichLamViec::join('bac_sis', 'lich_lam_viecs.id_bac_si', '=', 'bac_sis.id')
            ->select(
                'lich_lam_viecs.id',
                'lich_lam_viecs.id_bac_si',
                'bac_sis.ho_ten as ten_bac_si',
                'lich_lam_viecs.ngay_lam_viec as ngay_truc',
                DB::raw('CASE
                    WHEN TIME(thoi_gian_bat_dau) < "12:00:00" THEN 1
                    WHEN TIME(thoi_gian_bat_dau) < "17:00:00" THEN 2
                    ELSE 3
                END as ca_truc'),
                'lich_lam_viecs.tinh_trang',
            );

        if ($request->month && $request->year) {
            $query->whereMonth('ngay_lam_viec', $request->month)
                ->whereYear('ngay_lam_viec', $request->year);
        }

        if ($request->id_bac_si) {
            $query->where('id_bac_si', $request->id_bac_si);
        }

        $data = $query->orderBy('ngay_lam_viec', 'asc')
            ->orderBy('thoi_gian_bat_dau', 'asc')
            ->get();

        $bacSi = BacSi::join('bac_si_chuyen_nganhs', 'bac_sis.id', '=', 'bac_si_chuyen_nganhs.id_bac_si')
            ->join('chuyen_khoas', 'bac_si_chuyen_nganhs.id_chuyen_khoa', '=', 'chuyen_khoas.id')
            ->select(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.email',
                'bac_sis.so_dien_thoai',
                'bac_sis.chuc_danh',
                'bac_sis.tinh_trang',
                DB::raw('GROUP_CONCAT(chuyen_khoas.ten_chuyen_khoa) as chuyen_khoa')
            )
            ->groupBy(
                'bac_sis.id',
                'bac_sis.ho_ten',
                'bac_sis.email',
                'bac_sis.so_dien_thoai',
                'bac_sis.chuc_danh',
                'bac_sis.tinh_trang'
            )
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data,
            'bac_si' => $bacSi
        ]);
    }
    // Profile
    public function getProfile()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user && $user instanceof \App\Models\Admin) {
            $data = Admin::join('chuc_vus', 'admins.id_chuc_vu', 'chuc_vus.id')
                ->where('admins.id', $user->id)
                ->select('admins.*', 'chuc_vus.ten_chuc_vu')
                ->first();
            return response()->json([
                'status' => true,
                'message' => 'Lấy dữ liệu profile thành công',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập hệ thống!',
            ]);
        }
    }
    public function updateProfile(AdminUpdateProfileRequest $request)
    {
        $user = Auth::guard('sanctum')->user();
        Admin::find($user->id)->update([
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'hinh_anh' => $request->hinh_anh,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật profile thành công',
        ]);
    }

    public function updateProfileAvatar(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $data = $request->all();
        $file = $data['hinh_anh'];
        $file_extention = $file->getClientOriginalExtension();
        $file_name = \Illuminate\Support\Str::slug($user->ho_ten) . "." . $file_extention;
        $cho_luu = "AdminAVT\\" . $file_name;
        $file->move("AdminAVT", $file_name);
        $hinh_anh = "http://127.0.0.1:8000/" . $cho_luu;
        Admin::find($user->id)->update([
            'hinh_anh' => $hinh_anh
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đã đổi ảnh đại diện thành công',
        ]);
    }
    public function changePassword(AdminChangePassWordRequest $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (Hash::check($request->password, $user->password)) {
            Admin::find($user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Đã đổi mật khẩu thành công',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu cũ không đúng',
            ]);
        }
    }





    // Quản lý tài khoản admin
    public function getDataNhanVien()
    {
        // Kiểm tra quyền: Quản lý nhân viên (ID = 4)
        $id_chuc_nang = 4;
        $id_chuc_vu   = Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = Admin::join('chuc_vus', 'admins.id_chuc_vu', 'chuc_vus.id')
            ->select('admins.*', 'chuc_vus.ten_chuc_vu')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu nhân viên thành công',
            'data' => $data
        ]);
    }
    public function storeNhanVien(CreateNhanVienRequest $request)
    {
        // Kiểm tra quyền: Quản lý nhân viên (ID = 4)
        $id_chuc_nang = 4;
        $id_chuc_vu   = Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        Admin::create([
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'password'      => bcrypt(123456),
            'so_dien_thoai' => $request->so_dien_thoai,
            'id_chuc_vu'    => $request->id_chuc_vu,
            'tinh_trang'    => $request->tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Thêm mới nhân viên ' . $request->ho_ten . ' thành công',
        ]);
    }
    public function destroyNhanVien(DeleteNhanVienRequest $request)
    {
        // Kiểm tra quyền: Quản lý nhân viên (ID = 4)
        $id_chuc_nang = 4;
        $id_chuc_vu   = Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        Admin::find($request->id)->delete();
        return response()->json([
            'status'    => true,
            'message' => 'Đã xoá nhân viên thành công',
        ]);
    }
    public function updateNhanVien(UpdateNhanVienRequest $request)
    {
        // Kiểm tra quyền: Quản lý nhân viên (ID = 4)
        $id_chuc_nang = 4;
        $id_chuc_vu   = Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        Admin::find($request->id)->update([
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'so_dien_thoai' => $request->so_dien_thoai,
            'id_chuc_vu'    => $request->id_chuc_vu,
            'tinh_trang'    => $request->tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Đã cập nhật nhân viên thành công',
        ]);
    }
    public function searchNhanVien(Request $request)
    {
        // Kiểm tra quyền: Quản lý nhân viên (ID = 4)
        $id_chuc_nang = 4;
        $id_chuc_vu   = Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $noi_dung_tim_kiem = $request->noi_dung_tim_kiem;
        $data = Admin::where('ho_ten', 'like', '%' . $noi_dung_tim_kiem . '%')->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu nhân viên thành công',
            'data' => $data
        ]);
    }
    public function changeStatusNhanVien(ChangeStatusNhanVienRequest $request)
    {
        // Kiểm tra quyền: Quản lý nhân viên (ID = 4)
        $id_chuc_nang = 4;
        $id_chuc_vu   = Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $new_tinh_trang = !$request->tinh_trang;
        $data = Admin::find($request->id);
        $data->update(
            [
                'tinh_trang' => $new_tinh_trang,
            ]
        );
        $data->save();
        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật trạng thái nhân viên thành công',
        ]);
    }

    // Quản lý đăng nhập
    public function loginAdmin(Request $request)
    {
        $check = Auth::guard('admin')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);
        if ($check) {
            $admin = Auth::guard('admin')->user();
            return response()->json([
                'status'    => true,
                'message'   => "Đã đăng nhập thành công!",
                'token'     => $admin->createToken('token_admin')->plainTextToken,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Tài khoản hoặc mật khẩu không đúng!",
            ]);
        }
    }
    public function logoutAdmin()
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
        } else {
            return response()->json([
                'status'  => false,
                'message' => "Có lỗi xảy ra",
            ]);
        }
    }

    public function checkTokenAdmin()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user && $user instanceof \App\Models\Admin) {
            return response()->json([
                'status' => true,
                'ho_ten'    => $user->ho_ten,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập hệ thống!',
            ]);
        }
    }
    public function xuatexcel(Request $request)
    {
        $filename = 'danh_sach_benh_nhan.xlsx';
        $timKiem = trim($request->noi_dung_tim);
        $export   = new class($timKiem) implements FromCollection {
            protected $timKiem;
            public function __construct($timKiem)
            {
                $this->timKiem = $timKiem;
            }
            public function collection()
            {

                return BenhNhan::where('benh_nhans.ho_ten', 'like', '%' . $this->timKiem . '%')
                    ->select('id', 'ho_ten', 'email', 'so_dien_thoai', 'ngay_sinh', 'gioi_tinh', 'dia_chi', 'tinh_trang')
                    ->get();
            }
        };
        return Excel::download($export, $filename);
    }
}
