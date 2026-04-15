<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhanQuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phan_quyens')->truncate();

        // 1. SUPER ADMIN - Toàn quyền hệ thống
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 1],   // Quản lý tài khoản admin
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 2],   // Quản lý chức vụ
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 3],   // Quản lý phân quyền
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 4],   // Quản lý nhân viên
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 5],   // Quản lý bác sĩ
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 6],   // Quản lý bệnh nhân
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 7],   // Quản lý phòng khám
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 8],   // Quản lý chuyên khoa
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 9],   // Quản lý lịch hẹn
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 10],  // Quản lý hồ sơ bệnh án
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 11],  // Quản lý lịch làm việc
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 12],  // Thống kê tổng quan
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 13],  // Thống kê chuyên khoa
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 14],  // Thống kê bác sĩ
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 15],  // Thống kê phòng khám
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 16],  // Quản lý thanh toán
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 17],  // Quản lý slide banner
            ['id_chuc_vu' => 1, 'id_chuc_nang' => 18],  // Cấu hình hệ thống
        ]);

        // 2. GIÁM ĐỐC PHÒNG KHÁM - Quản lý toàn diện (trừ hệ thống)
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 4],   // Quản lý nhân viên
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 5],   // Quản lý bác sĩ
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 6],   // Quản lý bệnh nhân
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 7],   // Quản lý phòng khám
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 8],   // Quản lý chuyên khoa
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 9],   // Quản lý lịch hẹn
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 10],  // Quản lý hồ sơ bệnh án
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 11],  // Quản lý lịch làm việc
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 12],  // Thống kê tổng quan
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 13],  // Thống kê chuyên khoa
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 14],  // Thống kê bác sĩ
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 15],  // Thống kê phòng khám
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 16],  // Quản lý thanh toán
            ['id_chuc_vu' => 2, 'id_chuc_nang' => 17],  // Quản lý slide banner
        ]);

        // 3. QUẢN LÝ NHÂN SỰ - Quản lý nhân viên, bác sĩ, bệnh nhân
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 4],   // Quản lý nhân viên
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 5],   // Quản lý bác sĩ
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 6],   // Quản lý bệnh nhân
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 12],  // Thống kê tổng quan
            ['id_chuc_vu' => 3, 'id_chuc_nang' => 14],  // Thống kê bác sĩ
        ]);

        // 4. QUẢN LÝ PHÒNG KHÁM - Quản lý phòng khám và thống kê
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 4, 'id_chuc_nang' => 7],   // Quản lý phòng khám
            ['id_chuc_vu' => 4, 'id_chuc_nang' => 12],  // Thống kê tổng quan
            ['id_chuc_vu' => 4, 'id_chuc_nang' => 15],  // Thống kê phòng khám
        ]);

        // 5. QUẢN LÝ CHUYÊN KHOA - Quản lý chuyên khoa và thống kê
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 5, 'id_chuc_nang' => 8],   // Quản lý chuyên khoa
            ['id_chuc_vu' => 5, 'id_chuc_nang' => 12],  // Thống kê tổng quan
            ['id_chuc_vu' => 5, 'id_chuc_nang' => 13],  // Thống kê chuyên khoa
        ]);

        // 6. QUẢN LÝ LỊCH HẸN - Quản lý lịch hẹn và lịch làm việc
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 6, 'id_chuc_nang' => 9],   // Quản lý lịch hẹn
            ['id_chuc_vu' => 6, 'id_chuc_nang' => 11],  // Quản lý lịch làm việc
            ['id_chuc_vu' => 6, 'id_chuc_nang' => 12],  // Thống kê tổng quan
            ['id_chuc_vu' => 6, 'id_chuc_nang' => 13],  // Thống kê chuyên khoa
            ['id_chuc_vu' => 6, 'id_chuc_nang' => 14],  // Thống kê bác sĩ
        ]);

        // 7. QUẢN LÝ HỒ SƠ BỆNH ÁN - Quản lý hồ sơ và thống kê
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 7, 'id_chuc_nang' => 10],  // Quản lý hồ sơ bệnh án
            ['id_chuc_vu' => 7, 'id_chuc_nang' => 12],  // Thống kê tổng quan
            ['id_chuc_vu' => 7, 'id_chuc_nang' => 14],  // Thống kê bác sĩ
        ]);

        // 8. QUẢN LÝ TÀI CHÍNH - Quản lý thanh toán và doanh thu
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 16],  // Quản lý thanh toán
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 12],  // Thống kê tổng quan
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 13],  // Thống kê chuyên khoa
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 14],  // Thống kê bác sĩ
            ['id_chuc_vu' => 8, 'id_chuc_nang' => 15],  // Thống kê phòng khám
        ]);

        // 9. NHÂN VIÊN LỄ TÂN - Xem lịch hẹn và thống kê cơ bản
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 9, 'id_chuc_nang' => 9],   // Xem lịch hẹn (chỉ xem)
            ['id_chuc_vu' => 9, 'id_chuc_nang' => 12],  // Thống kê tổng quan
        ]);

        // 10. NHÂN VIÊN Y TẾ - Xem hồ sơ bệnh án và thống kê
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 10, 'id_chuc_nang' => 10], // Xem hồ sơ bệnh án
            ['id_chuc_vu' => 10, 'id_chuc_nang' => 12], // Thống kê tổng quan
        ]);

        // 11. NHÂN VIÊN KẾ TOÁN - Hỗ trợ tài chính
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 11, 'id_chuc_nang' => 16], // Quản lý thanh toán
            ['id_chuc_vu' => 11, 'id_chuc_nang' => 12], // Thống kê tổng quan
        ]);

        // 12. NHÂN VIÊN HỖ TRỢ KỸ THUẬT - Hỗ trợ cấu hình hệ thống
        DB::table('phan_quyens')->insert([
            ['id_chuc_vu' => 12, 'id_chuc_nang' => 17], // Quản lý slide banner
            ['id_chuc_vu' => 12, 'id_chuc_nang' => 18], // Cấu hình hệ thống
            ['id_chuc_vu' => 12, 'id_chuc_nang' => 12], // Thống kê tổng quan
        ]);
    }
}
