<?php

namespace App\Http\Controllers;

use App\Models\PhanQuyen;
use App\Models\ChucNang;
use Illuminate\Http\Request;

class PhanQuyenController extends Controller
{
    public function getData()
    {
        // Kiểm tra quyền: Quản lý phân quyền (ID = 3)
        $id_chuc_nang = 3;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = PhanQuyen::join('chuc_nangs', 'phan_quyens.id_chuc_nang', 'chuc_nangs.id')
            ->join('chuc_vus', 'phan_quyens.id_chuc_vu', 'chuc_vus.id')
            ->select('phan_quyens.*', 'chuc_nangs.ten_chuc_nang', 'chuc_vus.ten_chuc_vu')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu phân quyền thành công',
            'data' => $data,
        ]);
    }
    public function createPhanQuyen(Request $request)
    {
        // Kiểm tra quyền: Quản lý phân quyền (ID = 3)
        $id_chuc_nang = 3;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        PhanQuyen::create([
            'id_chuc_vu' => $request->id_chuc_vu,
            'id_chuc_nang' => $request->id_chuc_nang,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Thêm mới phân quyền thành công',
        ]);
    }
    public function deletePhanQuyen(Request $request)
    {
        // Kiểm tra quyền: Quản lý phân quyền (ID = 3)
        $id_chuc_nang = 3;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        PhanQuyen::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Xoá phân quyền thành công',
        ]);
    }
    public function updatePhanQuyen(Request $request){
        // Kiểm tra quyền: Quản lý phân quyền (ID = 3)
        $id_chuc_nang = 3;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        PhanQuyen::find($request->id)->update([
            'id_chuc_vu' => $request->id_chuc_vu,
            'id_chuc_nang' => $request->id_chuc_nang,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật phân quyền thành công',
        ]);
    }
}
