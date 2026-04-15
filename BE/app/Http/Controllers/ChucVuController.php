<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateChucVuRequest;
use App\Http\Requests\Admin\DeleteChucVuRequest;
use App\Http\Requests\Admin\UpdateChucVuRequest;
use App\Models\ChucVu;
use Illuminate\Http\Request;

class ChucVuController extends Controller
{
    public function getData()
    {
        // Kiểm tra quyền: Quản lý chức vụ (ID = 2)
        $id_chuc_nang = 2;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $chucvu = ChucVu::all();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu thành công',
            'data' => $chucvu
        ]);
    }
    public function store(CreateChucVuRequest $request){
        // Kiểm tra quyền: Quản lý chức vụ (ID = 2)
        $id_chuc_nang = 2;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        ChucVu::create([
            'ten_chuc_vu'        => $request->ten_chuc_vu,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Thêm mới chức vụ '. $request->ten_chuc_vu . ' thành công',
        ]);
    }
    public function destroyChucVu(DeleteChucVuRequest $request)
    {
        // Kiểm tra quyền: Quản lý chức vụ (ID = 2)
        $id_chuc_nang = 2;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        ChucVu::find($request->id)->delete();
        return response()->json([
            'status'=> true,
            'message'=> 'Đã xoá chức vụ thành công',
        ]);
    }
    public function updateChucVu(UpdateChucVuRequest $request)
    {
        // Kiểm tra quyền: Quản lý chức vụ (ID = 2)
        $id_chuc_nang = 2;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        ChucVu::find($request->id)-> update([
            'ten_chuc_vu'        => $request->ten_chuc_vu,
        ]);
        return response()->json([
            'status'=> true,
            'message'=> 'Đã cập nhật chức vụ thành công',
        ]);
    }
    public function changeStatusChucVu(Request $request)
    {
        // Kiểm tra quyền: Quản lý chức vụ (ID = 2)
        $id_chuc_nang = 2;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $chucVu = ChucVu::find($request->id);
        $chucVu->tinh_trang = $request->tinh_trang;
        $chucVu->save();
        return response()->json([
            'status'=> true,
            'message'=> 'Đã cập nhật trạng thái chức vụ thành công',
        ]);
    }
    public function searchChucVu(Request $request)
    {
        // Kiểm tra quyền: Quản lý chức vụ (ID = 2)
        $id_chuc_nang = 2;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $noi_dung_tim_kiem = $request->noi_dung_tim_kiem;
        $data = ChucVu::where('ten_chuc_vu', 'like', '%' . $noi_dung_tim_kiem . '%')->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu chức vụ thành công',
            'data' => $data
        ]);
    }
}
