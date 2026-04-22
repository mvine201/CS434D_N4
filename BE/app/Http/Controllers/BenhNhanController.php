<?php

namespace App\Http\Controllers;

use App\Http\Requests\BenhNhan\ChangePasswordBenhNhanRequest;
use App\Http\Requests\BenhNhan\UpdateProfileBenhNhanRequest;
use App\Http\Requests\BenhNhan\CreateBenhNhanRequest;
use App\Http\Requests\BenhNhan\DeleteBenhNhanRequest;
use App\Http\Requests\BenhNhan\UpdateBenhNhanRequest;
use App\Http\Requests\BenhNhan\CreateTaiKhoanBenhNhanRequest;
use App\Http\Requests\BenhNhan\BenhNhanDoiMatKhauRequest;
use App\Jobs\SendMailJob;
use App\Mail\MasterMail;
use App\Models\BenhNhan;
use App\Models\PhieuDatLich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BenhNhanController extends Controller
{
    // ===== COMMON =====
    private function user()
    {
        return Auth::guard('sanctum')->user();
    }

    private function checkPermission()
    {
        $user = $this->user();

        if (!$user) {
            return response()->json(['status'=>false,'message'=>'Chưa đăng nhập'],401);
        }

        $check = \App\Models\PhanQuyen::where('id_chuc_vu',$user->id_chuc_vu)
            ->where('id_chuc_nang',6)->exists();

        if (!$check) {
            return response()->json(['status'=>false,'message'=>'Không có quyền']);
        }

        return null;
    }

    // ===== PROFILE =====
    public function getProfile()
    {
        $user = $this->user();
        if (!$user) return response()->json(['status'=>false],401);

        return response()->json([
            'status'=>true,
            'message'=>'Lấy dữ liệu profile thành công',
            'data'=>$user
        ]);
    }

    public function updateProfile(UpdateProfileBenhNhanRequest $request)
    {
        $user = $this->user();
        if (!$user) return response()->json(['status'=>false],401);

        $user->update($request->only([
            'ho_ten','email','so_dien_thoai','ngay_sinh','gioi_tinh','dia_chi'
        ]));

        return response()->json(['status'=>true,'message'=>'Cập nhật thành công']);
    }

    public function changePassword(ChangePasswordBenhNhanRequest $request)
    {
        $user = $this->user();
        if (!$user) return response()->json(['status'=>false],401);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['status'=>false,'message'=>'Sai mật khẩu']);
        }

        $user->update(['password'=>Hash::make($request->new_password)]);

        return response()->json(['status'=>true,'message'=>'Đổi mật khẩu thành công']);
    }

    // ===== CRUD =====
    public function getDataBenhNhan()
    {
        if ($res = $this->checkPermission()) return $res;

        return response()->json([
            'status'=>true,
            'data'=>BenhNhan::latest()->get()
        ]);
    }

    public function searchBenhNhan(Request $request)
    {
        if ($res = $this->checkPermission()) return $res;

        $key = trim($request->noi_dung_tim);

        $data = BenhNhan::where('ho_ten','like',"%$key%")
            ->orWhere('so_dien_thoai','like',"%$key%")
            ->get();

        return response()->json(['status'=>true,'data'=>$data]);
    }

    public function storeBenhNhan(CreateBenhNhanRequest $request)
    {
        if ($res = $this->checkPermission()) return $res;

        BenhNhan::create([
            ...$request->only([
                'ho_ten','email','so_dien_thoai','ngay_sinh',
                'gioi_tinh','dia_chi','tinh_trang'
            ]),
            'password'=>bcrypt($request->password)
        ]);

        return response()->json(['status'=>true,'message'=>'Thêm thành công']);
    }

    public function updateBenhNhan(UpdateBenhNhanRequest $request)
    {
        if ($res = $this->checkPermission()) return $res;

        $bn = BenhNhan::find($request->id);
        if (!$bn) return response()->json(['status'=>false,'message'=>'Không tồn tại']);

        $bn->update($request->only([
            'ho_ten','email','so_dien_thoai','ngay_sinh',
            'gioi_tinh','dia_chi','tinh_trang'
        ]));

        return response()->json(['status'=>true,'message'=>'Cập nhật thành công']);
    }

    public function destroyBenhNhan(DeleteBenhNhanRequest $request)
    {
        if ($res = $this->checkPermission()) return $res;

        $bn = BenhNhan::find($request->id);
        if (!$bn) return response()->json(['status'=>false]);

        $bn->delete();

        return response()->json(['status'=>true,'message'=>'Xoá thành công']);
    }

    public function changeStatusBenhNhan(Request $request)
    {
        if ($res = $this->checkPermission()) return $res;

        $bn = BenhNhan::find($request->id);
        if (!$bn) return response()->json(['status'=>false]);

        $bn->update(['tinh_trang'=>!$request->tinh_trang]);

        return response()->json(['status'=>true]);
    }

    // ===== AUTH =====
    public function registerBenhNhan(CreateTaiKhoanBenhNhanRequest $request)
    {
        $hash = Str::uuid();

        BenhNhan::create([
            ...$request->only([
                'ho_ten','email','so_dien_thoai','ngay_sinh','gioi_tinh','dia_chi'
            ]),
            'password'=>bcrypt($request->password),
            'hash_active'=>$hash
        ]);

        SendMailJob::dispatch([
            'ho_ten'=>$request->ho_ten,
            'link'=>"http://localhost:5173/kich-hoat/$hash"
        ],'kich_hoat_tai_khoan_benh_nhan',"kích hoạt tài khoản",$request->email);

        return response()->json(['status'=>true,'message'=>'Đăng ký thành công']);
    }

    public function loginBenhNhan(Request $request)
    {
        if (!Auth::guard('benh_nhan')->attempt($request->only('email','password'))) {
            return response()->json(['status'=>false,'message'=>'Sai tài khoản']);
        }

        $user = Auth::guard('benh_nhan')->user();

        if (!$user->is_active) {
            return response()->json(['status'=>false,'message'=>'Chưa kích hoạt']);
        }

        return response()->json([
            'status'=>true,
            'token'=>$user->createToken('token')->plainTextToken
        ]);
    }

    public function logoutBenhNhan()
    {
        $user = $this->user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
            return response()->json(['status'=>true]);
        }

        return response()->json(['status'=>false]);
    }

    // ===== LỊCH HẸN =====
    public function getDataLichHenBenhNhan()
    {
        $user = $this->user();

        $data = PhieuDatLich::where('id_benh_nhan',$user->id)
            ->join('chi_tiet_dat_lichs','phieu_dat_lichs.id','=','chi_tiet_dat_lichs.id_phieu_dat_lich')
            ->join('bac_sis','chi_tiet_dat_lichs.id_bac_si','=','bac_sis.id')
            ->join('phong_khams','bac_sis.id_phong_kham','=','phong_khams.id')
            ->orderBy('phieu_dat_lichs.id','desc')
            ->get();

        return response()->json(['status'=>true,'data'=>$data]);
    }
}
