<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public function getDataSlide()
    {
        // Kiểm tra quyền: Quản lý slide (ID = 16)
        $id_chuc_nang = 16;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = Slide::get();
        return response()->json([
            'status'    => true,
            'message' => 'Lấy dữ liệu slide thành công',
            'data' => $data,
        ]);
    }
    public function createSlide(Request $request)
    {
        // Kiểm tra quyền: Quản lý slide (ID = 16)
        $id_chuc_nang = 16;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = Slide::create($request->all());
        return response()->json([
            'status'    => true,
            'message' => 'Đã tạo slide thành công',
            'data' => $data,
        ]);
    }
    public function updateSlide(Request $request)
    {
        // Kiểm tra quyền: Quản lý slide (ID = 16)
        $id_chuc_nang = 16;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = Slide::find($request->id);
        $data->update($request->all());
        return response()->json([
            'status'    => true,
            'message' => 'Đã cập nhật trạng thái slide thành công',
            'data' => $data,
        ]);
    }
    public function deleteSlide(Request $request)
    {
        // Kiểm tra quyền: Quản lý slide (ID = 16)
        $id_chuc_nang = 16;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = Slide::find($request->id);
        $data->delete();
        return response()->json([
            'status'    => true,
            'message' => 'Đã xoá slide thành công',
            'data' => $data,
        ]);
    }
    public function changeStatusSlide(Request $request)
    {
        // Kiểm tra quyền: Quản lý slide (ID = 16)
        $id_chuc_nang = 16;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $new_tinh_trang = !$request->tinh_trang;
        $data = Slide::find($request->id);
        $data->update([
            'tinh_trang' => $new_tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Đã cập nhật trạng thái slide thành công',
            'data' => $data,
        ]);
    }
}
