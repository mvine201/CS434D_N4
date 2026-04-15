<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChuyenKhoa\ChangeStatusChuyenKhoaRequest;
use App\Http\Requests\ChuyenKhoa\CreateChuyenKhoaRequest;
use App\Http\Requests\ChuyenKhoa\DeleteChuyenKhoaRequest;
use App\Http\Requests\ChuyenKhoa\UpdateChuyenKhoaRequest;
use App\Models\ChuyenKhoa;
use App\Models\BacSiChuyenNganh;
use App\Models\ChuyenNganh;
use Illuminate\Http\Request;

class ChuyenKhoaController extends Controller
{
    public function storeChuyenKhoa(CreateChuyenKhoaRequest $request)
    {
        // Kiểm tra quyền: Quản lý chuyên khoa (ID = 8)
        $id_chuc_nang = 8;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        ChuyenKhoa::create([
            'ten_chuyen_khoa'   => $request->ten_chuyen_khoa,
            'mo_ta'             => $request->mo_ta,
            'tinh_trang'        => $request->tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Thêm mới chuyên khoa '. $request->ten_chuyen_khoa . ' thành công',
        ]);
    }
    public function destroyChuyenKhoa(DeleteChuyenKhoaRequest $request)
    {
        // Kiểm tra quyền: Quản lý chuyên khoa (ID = 8)
        $id_chuc_nang = 8;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

       ChuyenKhoa::find($request->id) -> delete();
       return response()->json([
        'status'    => true,
        'message' => 'Đã xoá chuyên khoa ' . $request->ten_chuyen_khoa . ' thành công',
    ]);
    }
    public function updateChuyenKhoa(UpdateChuyenKhoaRequest $request)
    {
        // Kiểm tra quyền: Quản lý chuyên khoa (ID = 8)
        $id_chuc_nang = 8;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $chuyen_khoa = ChuyenKhoa::find($request->id);
        $chuyen_khoa -> update([
            'ten_chuyen_khoa'   => $request->ten_chuyen_khoa,
            'mo_ta'             => $request->mo_ta,
            'tinh_trang'        => $request->tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Đã cập nhật chuyên khoa ' . $request->ten_chuyen_khoa . ' thành công',
        ]);
    }
    public function getDataChuyenKhoa()
    {
        // Kiểm tra quyền: Quản lý chuyên khoa (ID = 8)
        $id_chuc_nang = 8;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data_chuyen_khoa = ChuyenKhoa::all();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu chuyên khoa thành công',
            'data' => $data_chuyen_khoa
        ]);
    }
    public function searchChuyenKhoa(Request $request)
    {
        // Kiểm tra quyền: Quản lý chuyên khoa (ID = 8)
        $id_chuc_nang = 8;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data_chuyen_khoa = ChuyenKhoa::where('ten_chuyen_khoa', 'like', '%' . $request->ten_chuyen_khoa . '%')->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu chuyên khoa thành công',
            'data' => $data_chuyen_khoa
        ]);
    }
    public function changeStatusChuyenKhoa(ChangeStatusChuyenKhoaRequest $request)
    {
        // Kiểm tra quyền: Quản lý chuyên khoa (ID = 8)
        $id_chuc_nang = 8;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $new_tinh_trang = !$request->tinh_trang;
        ChuyenKhoa::find($request->id)->update([
            'tinh_trang' => $new_tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Đã cập nhật trạng thái chuyên khoa ' . $request->ten_chuyen_khoa . ' thành công',
        ]);
    }

}

