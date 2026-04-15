<?php

namespace App\Http\Controllers;

use App\Http\Requests\BenhNhan\BenhNhanDatLichRequest;
use App\Http\Requests\BenhNhan\BenhNhanLoginRequest;
use App\Http\Requests\BenhNhan\BenhNhanRegisterRequest;
use App\Http\Requests\BenhNhan\BenhNhanUpDateThongTinCaNhanRequest;
use App\Http\Requests\BenhNhan\BenhNhanUpDateTrangThaiDatLichRequest;
use App\Http\Requests\BenhNhan\ChangePasswordBenhNhanRequest;
use App\Http\Requests\BenhNhan\UpdateProfileBenhNhanRequest;
use App\Http\Requests\BenhNhan\CreateBenhNhanRequest;
use App\Http\Requests\BenhNhan\DeleteBenhNhanRequest;
use App\Http\Requests\BenhNhan\UpdateBenhNhanRequest;
use App\Http\Requests\BenhNhan\CreateTaiKhoanBenhNhanRequest;
use App\Http\Requests\BenhNhan\BenhNhanDoiMatKhauRequest;
use App\Jobs\SendMailJob;
use App\Mail\MasterMail;
use App\Models\BacSi;
use App\Models\BenhNhan;
use App\Models\ChiTietDatLich;
use App\Models\ChuyenKhoa;
use App\Models\ChuyenNganh;
use App\Models\PhieuDatLich;
use App\Models\PhongKham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BenhNhanController extends Controller
{
    public function getProfile()
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin người dùng'
            ], 401);
        }

        $data = BenhNhan::where('id', $user->id)->first();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu profile thành công',
            'data' => $data
        ]);
    }
    public function updateProfile(UpdateProfileBenhNhanRequest $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin người dùng'
            ], 401);
        }

        BenhNhan::find($user->id)->update([
            'ho_ten' => $request->ho_ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'ngay_sinh' => $request->ngay_sinh,
            'gioi_tinh' => $request->gioi_tinh,
            'dia_chi' => $request->dia_chi,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật profile thành công'
        ]);
    }
    public function updateProfileAvatar(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin người dùng'
            ], 401);
        }

        $data = $request->all();
        $file = $data['hinh_anh'];
        $file_extention = $file->getClientOriginalExtension();
        $file_name = \Illuminate\Support\Str::slug($user->ho_ten) . "." . $file_extention;
        $cho_luu = "BenhNhanAVT\\" . $file_name;
        $file->move("BenhNhanAVT", $file_name);
        $hinh_anh = "http://127.0.0.1:8000/" . $cho_luu;
        BenhNhan::find($user->id)->update([
            'hinh_anh' => $hinh_anh
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật avatar thành công',
            'hinh_anh' => $hinh_anh
        ]);
    }
    public function changePassword(ChangePasswordBenhNhanRequest $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin người dùng'
            ], 401);
        }

        if (Hash::check($request->password, $user->password)) {
            BenhNhan::find($user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Đã đổi mật khẩu thành công',
            ]);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu cũ không đúng',
            ]);
        }
    }
    // Quản lý bệnh nhân
    public function getDataBenhNhan()
    {
        // Kiểm tra quyền: Quản lý bệnh nhân (ID = 6)
        $id_chuc_nang = 6;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = BenhNhan::select('id', 'ho_ten', 'email', 'so_dien_thoai', 'ngay_sinh', 'gioi_tinh', 'dia_chi', 'tinh_trang')
            ->orderBy('id', 'desc')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu bệnh nhân thành công',
            'data' => $data
        ]);
    }
    public function searchBenhNhan(Request $request)
    {
        // Kiểm tra quyền: Quản lý bệnh nhân (ID = 6)
        $id_chuc_nang = 6;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $timKiem = trim($request->noi_dung_tim);
        $data = BenhNhan::where('benh_nhans.ho_ten', 'like', '%' . $timKiem . '%')
            ->select('id', 'ho_ten', 'email', 'so_dien_thoai', 'ngay_sinh', 'gioi_tinh', 'dia_chi', 'tinh_trang')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Tìm kiếm bệnh nhân thành công',
            'data' => $data
        ]);
    }
    public function storeBenhNhan(CreateBenhNhanRequest $request)
    {
        // Kiểm tra quyền: Quản lý bệnh nhân (ID = 6)
        $id_chuc_nang = 6;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        BenhNhan::create([
            'ho_ten' => $request->ho_ten,
            'email'  => $request->email,
            'password'  => bcrypt($request->password),
            'so_dien_thoai' => $request->so_dien_thoai,
            'ngay_sinh' => $request->ngay_sinh,
            'gioi_tinh' => $request->gioi_tinh,
            'dia_chi' => $request->dia_chi,
            'tinh_trang' => $request->tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Thêm mới bệnh nhân thành công',
        ]);
    }
    public function destroyBenhNhan(DeleteBenhNhanRequest $request)
    {
        // Kiểm tra quyền: Quản lý bệnh nhân (ID = 6)
        $id_chuc_nang = 6;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        BenhNhan::find($request->id)->delete();
        return response()->json([
            'status'    => true,
            'message' => 'Đã xoá bệnh nhân ' . $request->ho_ten . ' thành công',
        ]);
    }
    public function updateBenhNhan(UpdateBenhNhanRequest $request)
    {
        // Kiểm tra quyền: Quản lý bệnh nhân (ID = 6)
        $id_chuc_nang = 6;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        BenhNhan::find($request->id)->update([
            'ho_ten' => $request->ho_ten,
            'email'  => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'ngay_sinh' => $request->ngay_sinh,
            'gioi_tinh' => $request->gioi_tinh,
            'dia_chi' => $request->dia_chi,
            'tinh_trang' => $request->tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Đã cập nhật bệnh nhân ' . $request->ho_ten . ' thành công',
        ]);
    }
    public function changeStatusBenhNhan(Request $request)
    {
        // Kiểm tra quyền: Quản lý bệnh nhân (ID = 6)
        $id_chuc_nang = 6;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $new_tinh_trang = !$request->tinh_trang;
        BenhNhan::find($request->id)->update([
            'tinh_trang' => $new_tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Đã cập nhật trạng thái bệnh nhân ' . $request->ho_ten . ' thành công',
        ]);
    }

    public function lichSuKhamBenhById(Request $request, $id)
    {
        $benhNhan = BenhNhan::where('id', $id)->first();

        if (!$benhNhan) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy bệnh nhân'
            ], 404);
        }
        $lichSuKham = DB::table('benh_nhans')
            ->join('phieu_dat_lichs', 'benh_nhans.id', '=', 'phieu_dat_lichs.id_benh_nhan')
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
            ->where('benh_nhans.id', $id)
            ->select(
                'benh_nhans.id as id_benh_nhan',
                'benh_nhans.ho_ten as ten_benh_nhan',
                'benh_nhans.email',
                'benh_nhans.so_dien_thoai',
                'benh_nhans.ngay_sinh',
                'benh_nhans.gioi_tinh',
                'benh_nhans.dia_chi',
                'benh_nhans.tinh_trang',
                'phieu_dat_lichs.id as id_phieu_dat_lich',
                'phieu_dat_lichs.ngay_dat_hen',
                'phieu_dat_lichs.ly_do_kham',
                'phieu_dat_lichs.tinh_trang as trang_thai_dat_lich',
                'chi_tiet_dat_lichs.thoi_gian_bat_dau',
                'chi_tiet_dat_lichs.thoi_gian_ket_thuc',
                'bac_sis.id as id_bac_si',
                'bac_sis.ho_ten as ten_bac_si',
                'bac_sis.chuc_danh',
                'phong_khams.id as id_phong_kham',
                'phong_khams.ten_phong_kham'
            )
            ->orderBy('phieu_dat_lichs.ngay_dat_hen', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Lấy thông tin chi tiết bệnh nhân và lịch sử khám bệnh thành công',
            'data' => [
                'thong_tin_benh_nhan' => [
                    'id' => $benhNhan->id,
                    'ho_ten' => $benhNhan->ho_ten,
                    'email' => $benhNhan->email,
                    'so_dien_thoai' => $benhNhan->so_dien_thoai,
                    'ngay_sinh' => $benhNhan->ngay_sinh,
                    'gioi_tinh' => $benhNhan->gioi_tinh,
                    'dia_chi' => $benhNhan->dia_chi,
                    'tinh_trang' => $benhNhan->tinh_trang
                ],
                'lich_su_kham_benh' => $lichSuKham
            ]
        ]);
    }

    public function registerBenhNhan(CreateTaiKhoanBenhNhanRequest $request)
    {
        $hash_active_account = Str::uuid();
        $benhNhan = BenhNhan::create([
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
        $tieu_de = "kích hoạt tài khoản khám bệnh";
        $data['ho_ten']=$request->ho_ten;
        $data['link']= "http://localhost:5173/kich-hoat/". $hash_active_account;
        $view ='kich_hoat_tai_khoan_benh_nhan';
        SendMailJob::dispatch($data, $view, $tieu_de, $request->email);
        return response()->json([
            'status'    => true,
            'message' => 'Đăng ký thành công. Vui lòng kiểm tra email để kích hoạt tài khoản',
        ]);
    }
    public function kichHoatBenhNhan(Request $request)  {
        $code =$request->ma_code;
        $check = BenhNhan::where('hash_active',$code)->where('is_active',0)->first();
        if($check){
            $check->is_active = 1;
            $check ->save();
            return response()->json([
                'status' => true,
                'message' => 'Kích hoạt tài khoản thành công.Vui lòng đăng nhập hệ thống',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Kích hoạt tài khoản thất bại.Vui lòng kiểm tra lại mã kích hoạt',
            ]);
        }

    }
    public function loginBenhNhan(Request $request)
    {
        $check = Auth::guard('benh_nhan')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);
        if ($check) {
            $benhNhan = Auth::guard('benh_nhan')->user();
            if ($benhNhan->is_active == false){
                return response()->json([
                'status' => false,
                'message' => 'Tài khoản chưa được kích hoạt.Vui lòng kiểm tra email để kích hoạt',

            ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'Đăng nhập thành công',
                'token' => $benhNhan->createToken('token_benh_nhan')->plainTextToken,
            ]);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản hoặc mật khẩu không đúng',
            ]);
        }
    }
    public function logoutBenhNhan()
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
    public function logoutAllBenhNhan(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            $ds_token = $user->tokens;
            foreach ($ds_token as $token) {
                $token->delete();
            }
            return response()->json([
                'status'  => 1,
                'message' => "Đăng xuất thành công",
            ]);
        } else {
            return response()->json([
                'status'  => 0,
                'message' => "Có lỗi xảy ra",
            ]);
        }
    }
    public function checkTokenBenhNhan()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user && $user instanceof \App\Models\BenhNhan) {
            return response()->json([
                'status' => true,
                'ho_ten' => $user->ho_ten,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập hệ thống!',
            ]);
        }
    }
    public function quenMatKhauBenhNhan(Request $request)
    {
        $benhNhan = BenhNhan::where('email', $request->email)->first();
        if ($benhNhan) {
            $hash_reset = Str::uuid();
            $tieu_de = "đặt lại mật khẩu";
            $data['ho_ten'] = $benhNhan->ho_ten;
            $data['link']= "http://localhost:5173/doi-mat-khau/" . $hash_reset;
            $view ='quen_mat_khau_benh_nhan';
            Mail::to($request->email)->send(new MasterMail($tieu_de, $data, $view));
            $benhNhan->hash_reset = $hash_reset;
            $benhNhan->save();
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
    public function doiMatKhauBenhNhan(BenhNhanDoiMatKhauRequest $request)
    {
        $benhNhan = BenhNhan::where('hash_reset', $request->id_benh_nhan)->first();
        if ($benhNhan) {
            $benhNhan->password = bcrypt($request->password);
            $benhNhan->hash_reset = null;
            $benhNhan->save();
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
    public function getDataLichHenBenhNhan()
    {
        $user = Auth::guard('sanctum')->user();
        $data = PhieuDatLich::where('id_benh_nhan', $user->id)
            ->join('chi_tiet_dat_lichs', 'phieu_dat_lichs.id', '=', 'chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis', 'chi_tiet_dat_lichs.id_bac_si', '=', 'bac_sis.id')
            ->join('phong_khams', 'bac_sis.id_phong_kham', '=', 'phong_khams.id')
            ->select(
                'phieu_dat_lichs.id',
                'phieu_dat_lichs.id_benh_nhan',
                'phieu_dat_lichs.ngay_dat_hen',
                'phieu_dat_lichs.tinh_trang',
                'phieu_dat_lichs.is_thanh_toan',
                'phieu_dat_lichs.tong_tien',
                'chi_tiet_dat_lichs.thoi_gian_bat_dau',
                'chi_tiet_dat_lichs.don_gia_kham',
                'chi_tiet_dat_lichs.ghi_chu',
                'phieu_dat_lichs.ly_do_kham',
                'chi_tiet_dat_lichs.created_at',
                'bac_sis.ho_ten as ten_bac_si',
                'bac_sis.hinh_anh',
                'bac_sis.so_dien_thoai as so_dien_thoai_bac_si',
                'phong_khams.ten_phong_kham'
            )
            ->orderBy('phieu_dat_lichs.id', 'desc')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy lịch hẹn thành công',
            'data' => $data
        ]);
    }
}
