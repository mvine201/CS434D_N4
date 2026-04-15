<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BacSiController;
use App\Http\Controllers\BenhNhanController;
use App\Http\Controllers\ChucNangController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\ChuyenKhoaController;
use App\Http\Controllers\ChuyenNganhController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\HoSoBenhAnController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\LichHenController;
use App\Http\Controllers\LichLamViecController;
use App\Http\Controllers\PhanQuyenController;
use App\Http\Controllers\PhieuDatLichController;
use App\Http\Controllers\PhongKhamController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\ThongKeController;
use App\Models\PhieuDatLich;
use App\Models\PhongKham;
use Illuminate\Support\Facades\Route;


// API ADMIN
Route::post('/admin/login', [AdminController::class, 'loginAdmin']);
Route::group(['prefix' => 'admin', 'middleware' => 'AdminMiddleware'], function () {
    // xuất excel
    Route::post('benh-nhan/xuat-excel', [AdminController::class, 'xuatexcel']);
    // Logout
    Route::post('logout', [AdminController::class, 'logoutAdmin']);
    // check token admin
    Route::get('/check-token', [AdminController::class, 'checkTokenAdmin']);
    // Profile
    Route::get('profile/data', [AdminController::class, 'getProfile']);
    Route::post('profile/update', [AdminController::class, 'updateProfile']);
    Route::post('profile/update-avatar', [AdminController::class, 'updateProfileAvatar']);
    Route::post('profile/change-password', [AdminController::class, 'changePassword']);
    Route::post('hoa-don/chi-tiet', [PhieuDatLichController::class, 'hoaDonChiTiet']);


    // CHỨC VỤ
    Route::get('/chuc-vu/data', [ChucVuController::class, 'getData']);
    Route::post('/chuc-vu/create', [ChucVuController::class, 'store']);
    Route::post('/chuc-vu/delete', [ChucVuController::class, 'destroyChucVu']);
    Route::post('/chuc-vu/update', [ChucVuController::class, 'updateChucVu']);
    Route::post('/chuc-vu/change-status', [ChucVuController::class, 'changeStatusChucVu']);
    Route::post('/chuc-vu/search', [ChucVuController::class, 'searchChucVu']);
    // CHỨC NĂNG
    Route::get('/chuc-nang/data', [ChucNangController::class, 'getDataChucNang']);
    // PHÂN QUYỀN
    Route::get('/phan-quyen/chi-tiet-data', [PhanQuyenController::class, 'getData']);
    Route::post('/phan-quyen/create', [PhanQuyenController::class, 'createPhanQuyen']);
    Route::post('/phan-quyen/delete', [PhanQuyenController::class, 'deletePhanQuyen']);
    Route::post('/phan-quyen/update', [PhanQuyenController::class, 'updatePhanQuyen']);




    // Quản lý Nhân viên
    Route::get('/nhan-vien/data', [AdminController::class, 'getDataNhanVien']);
    Route::post('/nhan-vien/search', [AdminController::class, 'searchNhanVien']);
    Route::post('/nhan-vien/create', [AdminController::class, 'storeNhanVien']);
    Route::post('/nhan-vien/delete', [AdminController::class, 'destroyNhanVien']);
    Route::post('/nhan-vien/update', [AdminController::class, 'updateNhanVien']);
    Route::post('/nhan-vien/change-status', [AdminController::class, 'changeStatusNhanVien']);

    // Quản lý bệnh nhân
    Route::get('/benh-nhan/data', [BenhNhanController::class, 'getDataBenhNhan']);
    Route::post('/benh-nhan/create', [BenhNhanController::class, 'storeBenhNhan']);
    Route::post('/benh-nhan/delete', [BenhNhanController::class, 'destroyBenhNhan']);
    Route::post('/benh-nhan/update', [BenhNhanController::class, 'updateBenhNhan']);
    Route::post('/benh-nhan/change-status', [BenhNhanController::class, 'changeStatusBenhNhan']);
    Route::post('/benh-nhan/search', [BenhNhanController::class, 'searchBenhNhan']);
    Route::post('/benh-nhan/chi-tiet-lich-su-kham/{id}', [BenhNhanController::class, 'lichSuKhamBenhById']);

    // Quản lý slide
    Route::get('/slide/data', [SlideController::class, 'getDataSlide']);
    Route::post('/slide/create', [SlideController::class, 'createSlide']);
    Route::post('/slide/update', [SlideController::class, 'updateSlide']);
    Route::post('/slide/delete', [SlideController::class, 'deleteSlide']);
    Route::post('/slide/change-status', [SlideController::class, 'changeStatusSlide']);

    // Quản lý hồ sơ bệnh án
    Route::get('/ho-so-benh-an/data', [HoSoBenhAnController::class, 'getDataHoSoBenhAn']);
    Route::post('/ho-so-benh-an/tim-kiem', [HoSoBenhAnController::class, 'timKiemHoSoBenhAn']);
    Route::post('/ho-so-benh-an/create', [HoSoBenhAnController::class, 'createHoSoBenhAn']);
    Route::post('/ho-so-benh-an/update', [HoSoBenhAnController::class, 'updateHoSoBenhAn']);
    Route::post('/ho-so-benh-an/delete', [HoSoBenhAnController::class, 'deleteHoSoBenhAn']);
    Route::post('/ho-so-benh-an/change-status', [HoSoBenhAnController::class, 'changeStatusHoSoBenhAn']);
    //---với api này thì hồ sơ bệnh án chỉ có thể xem chứ không thể đổi trạng thái của hồ sơ--\\


    // Quản lý lịch hẹn
    Route::get('/lich-hen/data', [LichHenController::class, 'getLichHenData']);
    Route::post('/lich-hen/tim-kiem', [LichHenController::class, 'timKiemLichHen']);
    Route::post('/lich-hen/hoan-thanh', [LichHenController::class, 'hoanThanhLichHen']);
    Route::post('/lich-hen/create', [LichHenController::class, 'createLichHen']);
    Route::post('/lich-hen/xac-nhan', [LichHenController::class, 'xacNhanLichHen']);
    Route::post('/lich-hen/huy', [LichHenController::class, 'huyLichHen']);
    Route::post('/lich-hen/change-status', [LichHenController::class, 'changeStatusLichHen']);


    // Quản lý lịch làm việc
    Route::post('/lich-lam-viec/data/{id_bac_si}', [LichLamViecController::class, 'getNgayLamViecBacSi']);


    // Admin quản lý lịch làm việc
    Route::get('/lich-lam-viec-bac-si/data', [LichLamViecController::class, 'getDataLichLamViecBacSi']);
    Route::post('/lich-lam-viec-bac-si/create', [LichLamViecController::class, 'createLichLamViecBacSi']);

    // Quản lý bác sĩ
    Route::get('/bac-si/data', [BacSiController::class, 'getDataBacSi']);
    Route::post('/bac-si/create', [BacSiController::class, 'storeBacSi']);
    Route::post('/bac-si/update', [BacSiController::class, 'updateBacSi']);
    Route::post('/bac-si/delete', [BacSiController::class, 'destroyBacSi']);
    Route::post('/bac-si/search', [BacSiController::class, 'searchBacSi']);
    Route::post('/bac-si/change-status', [BacSiController::class, 'changeStatusBacSi']);

    // Alias để khớp với frontend hiện tại
    Route::post('/kiem-tra-phieu-dat-lich', [PhieuDatLichController::class, 'kiemTraMaDatLich']);

    // Quản lý hóa đơn
    Route::get('/hoa-don/data', [HoaDonController::class, 'getDataHoaDon']);


    /////////////////////////////////
    // Quản lý phòng khám
    Route::get('/phong-kham/data', [PhongKhamController::class, 'getDataPhongKham']);
    Route::post('/phong-kham/search', [PhongKhamController::class, 'searchPhongKham']);
    Route::post('/phong-kham/create', [PhongKhamController::class, 'storePhongKham']);
    Route::post('/phong-kham/delete ', [PhongKhamController::class, 'destroyPhongKham']);
    Route::post('/phong-kham/update', [PhongKhamController::class, 'updatePhongKham']);
    Route::post('/phong-kham/change-status', [PhongKhamController::class, 'changeStatusPhongKham']);


    // Quản lý chuyên khoa
    Route::get('/chuyen-khoa/data', [ChuyenKhoaController::class, 'getDataChuyenKhoa']);
    Route::post('/chuyen-khoa/search', [ChuyenKhoaController::class, 'searchChuyenKhoa']);
    Route::post('/chuyen-khoa/create', [ChuyenKhoaController::class, 'storeChuyenKhoa']);
    Route::post('/chuyen-khoa/delete', [ChuyenKhoaController::class, 'destroyChuyenKhoa']);
    Route::post('/chuyen-khoa/update', [ChuyenKhoaController::class, 'updateChuyenKhoa']);
    Route::post('/chuyen-khoa/change-status', [ChuyenKhoaController::class, 'changeStatusChuyenKhoa']);

    //Thống kê lịch hẹn theo chuyên khoa
    Route::post('/thong-ke/lich-hen-theo-chuyen-khoa', [ThongKeController::class, 'getLichHenTheoChuyenKhoa']);
    //Thống kê lịch hẹn của bác sĩ
    Route::post('/thong-ke/lich-hen-theo-bac-si', [ThongKeController::class, 'getLichHenTheoBacSi']);
    // Thống kê phòng khám có bao nhiêu bác sĩ và tên bác sĩ
    Route::post('/thong-ke/bac-si-theo-phong-kham', [ThongKeController::class, 'getBacSiTheoPhongKham']);
    // Thống kê bệnh nhân theo bác sĩ
    Route::post('/thong-ke/benh-nhan-theo-bac-si', [ThongKeController::class, 'getBenhNhanTheoBacSi']);
    // Thống kê lịch làm việc theo phòng khám
    Route::post('/thong-ke/lich-lam-viec-theo-phong-kham', [ThongKeController::class, 'getLichLamViecTheoPhongKham']);

    // Dashboard
    Route::get('/dashboard/data', [ThongKeController::class, 'getDashboardData']);
});
// API BAC SI
Route::post('bac-si/login', [BacSiController::class, 'loginBacSi']);
Route::post('bac-si/register', [BacSiController::class, 'registerBacSi']);
Route::post('bac-si/kich-hoat', [BacSiController::class, 'kichHoatBacSi']);
Route::post('bac-si/quen-mat-khau', [BacSiController::class, 'quenMatKhauBacSi']);
Route::post('bac-si/doi-mat-khau', [BacSiController::class, 'doiMatKhauBacSi']);
Route::group(['prefix' => '/bac-si', 'middleware' => 'BacSiMiddleware'], function () {
    // Logout
    Route::post('logout', [BacSiController::class, 'logoutBacSi']);
    // check token  bác sĩ
    Route::get('/check-token', [BacSiController::class, 'checkTokenBacSi']);
    // Quản Lý Bệnh Nhân
    Route::get('/benh-nhan/data', [BacSiController::class, 'getDataBenhNhan']);
    Route::post('/benh-nhan/lich-su-kham', [BacSiController::class, 'getLichSuKhamBenh']);
    Route::post('/benh-nhan/tim-kiem', [BacSiController::class, 'timKiemBenhNhan']);

    //Thống kê
    Route::get('/profile/data', [BacSiController::class, 'getProfile']);
    Route::post('/profile/update', [BacSiController::class, 'updateProfile']);
    Route::post('/profile/update-avatar', [BacSiController::class, 'updateProfileAvatar']);
    Route::post('/profile/change-password', [BacSiController::class, 'changePassword']);

    // quản lý lịch hẹn
    Route::get('/lich-hen/data', [BacSiController::class, 'getDataLichHenBenhNhan']);
    // lấy danh sách phòng khám
    Route::get('/phong-kham/data', [BacSiController::class, 'getDataPhongKhamBacSi']);
    // lấy danh sách chuyên khoa
    Route::get('/chuyen-khoa/data', [BacSiController::class, 'getDataChuyenKhoaBacSi']);
    // lấy lịch làm cá nhân
    Route::get('/lich-lam-viec/data', [BacSiController::class, 'getDataLichLamViecBacSi']);
});
// API BENH NHAN
Route::post('benh-nhan/login', [BenhNhanController::class, 'loginBenhNhan']);
Route::post('/benh-nhan/register', [BenhNhanController::class, 'registerBenhNhan']);
Route::post('benh-nhan/kich-hoat', [BenhNhanController::class, 'kichHoatBenhNhan']);
Route::post('benh-nhan/quen-mat-khau', [BenhNhanController::class, 'quenMatKhauBenhNhan']);
Route::post('benh-nhan/doi-mat-khau', [BenhNhanController::class, 'doiMatKhauBenhNhan']);
Route::group(['prefix' => '/benh-nhan', 'middleware' => 'BenhNhanMiddleware'], function () {
    // Logout và check token
    Route::post('logout', [BenhNhanController::class, 'logoutBenhNhan']);
    Route::post('logout-all', [BenhNhanController::class, 'logoutAllBenhNhan']);
    Route::get('/check-token', [BenhNhanController::class, 'checkTokenBenhNhan']);
    // Profile
    Route::get('profile/data', [BenhNhanController::class, 'getProfile']);
    Route::post('profile/update', [BenhNhanController::class, 'updateProfile']);
    Route::post('profile/update-avatar', [BenhNhanController::class, 'updateProfileAvatar']);
    Route::post('profile/change-password', [BenhNhanController::class, 'changePassword']);
    // Lấy lịch hẹn
    Route::get('/lich-hen/data', [BenhNhanController::class, 'getDataLichHenBenhNhan']);

    // Bệnh nhân đặt lịch khám
    Route::post('/dat-lich-kham', [PhieuDatLichController::class, 'datLichKhamBenhNhan']);
    // Bệnh nhân hủy lịch khám
    Route::post('/huy-lich-kham', [PhieuDatLichController::class, 'huyLichKhamBenhNhan']);

    Route::post('/bac-si/by-chuyen-khoa', [PhieuDatLichController::class, 'getBacSiTheoChuyenKhoa']);
});

// API CLIENT
Route::get('/home-page/data', [HomePageController::class, 'homePageData']);
Route::get('/client/chuyen-khoa/data', [HomePageController::class, 'getChuyenKhoaClient']);
Route::get('/client/chuyen-khoa/chi-tiet/{id}', [HomePageController::class, 'getChuyenKhoaClientById']);
Route::get('/client/bac-si/data', [HomePageController::class, 'getBacSiClient']);
Route::get('/client/bac-si/chi-tiet/{id}', [HomePageController::class, 'getBacSiClientByIds']);


Route::get('/auto-thanh-toan-lich-hen', [PhieuDatLichController::class, 'autoThanhToanLichHen']);
Route::get('/gui-mail-thong-bao-lich-hen', [PhieuDatLichController::class, 'GUImaillichhen']);
