<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhongKham\ChangeStatusPhongKhamRequest;
use App\Http\Requests\PhongKham\CreatePhongKhamRequest;
use App\Http\Requests\PhongKham\DeletePhongKhamRequest;
use App\Http\Requests\PhongKham\UpdatePhongKhamRequest;
use App\Models\PhongKham;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class PhongKhamController extends Controller
{
    public function getDataPhongKham(){
        // Kiểm tra quyền: Quản lý phòng khám (ID = 7)
        $id_chuc_nang = 7;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $data = PhongKham::all();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu phòng khám thành công',
            'data' => $data
        ]);
    }
    public function storePhongKham(CreatePhongKhamRequest $request)
    {
        // Kiểm tra quyền: Quản lý phòng khám (ID = 7)
        $id_chuc_nang = 7;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        PhongKham::create([
            'ten_phong_kham' => $request->ten_phong_kham,
            'email' => $request->email,
            'dia_chi' => $request->dia_chi,
            'so_dien_thoai' => $request->so_dien_thoai,
            'mo_ta' =>$request->mo_ta,
            'anh_banner' =>$request->anh_banner,
            'tinh_trang' =>$request->tinh_trang,
        ]);
        return response()->json([
            'status'    => true,
            'message' => 'Thêm mới phòng khám thành công',
        ]);
    }
    public function destroyPhongKham(DeletePhongKhamRequest $request)
    {
        // Kiểm tra quyền: Quản lý phòng khám (ID = 7)
        $id_chuc_nang = 7;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        PhongKham::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Đã xoá phòng khám thành công',
        ]);
    }
    public function updatePhongKham(UpdatePhongKhamRequest $request)
    {
        // Kiểm tra quyền: Quản lý phòng khám (ID = 7)
        $id_chuc_nang = 7;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        PhongKham::find($request->id)-> update([
            'ten_phong_kham' => $request->ten_phong_kham,
            'email' => $request->email,
            'dia_chi' => $request->dia_chi,
            'so_dien_thoai' => $request->so_dien_thoai,
            'mo_ta' =>$request->mo_ta,
            'anh_banner' =>$request->anh_banner,
            'tinh_trang' =>$request->tinh_trang,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật phòng khám thành công',
        ]);
    }
    public function searchPhongKham(Request $request)
    {
        // Kiểm tra quyền: Quản lý phòng khám (ID = 7)
        $id_chuc_nang = 7;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $noi_dung_tim_kiem = $request->ten_phong_kham;
        $data = PhongKham::where('ten_phong_kham', 'like', '%' . $noi_dung_tim_kiem . '%')->get();
        return response()->json([
            'status' => true,
            'message' => 'Lấy dữ liệu phòng khám thành công',
            'data' => $data
        ]);
    }
    public function changeStatusPhongKham(ChangeStatusPhongKhamRequest $request)
    {
        // Kiểm tra quyền: Quản lý phòng khám (ID = 7)
        $id_chuc_nang = 7;
        $id_chuc_vu   = \Illuminate\Support\Facades\Auth::guard('sanctum')->user()->id_chuc_vu;
        $check        = \App\Models\PhanQuyen::where('id_chuc_vu', $id_chuc_vu)->where('id_chuc_nang', $id_chuc_nang)->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không có quyền thực hiện chức năng này!'
            ]);
        }

        $new_tinh_trang = !$request->tinh_trang;
        $phong_kham = PhongKham::find($request->id);
        $phong_kham -> update([
            'tinh_trang' => $new_tinh_trang,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Đã cập nhật trạng thái phòng khám thành công',
        ]);
    }
}
