<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucNangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chuc_nangs')->truncate();
        DB::table('chuc_nangs')->insert([
            // QUẢN LÝ HỆ THỐNG - ID 1-3
            ['id' => 1, 'ten_chuc_nang' => 'Quản lý tài khoản admin'],
            ['id' => 2, 'ten_chuc_nang' => 'Quản lý chức vụ'],
            ['id' => 3, 'ten_chuc_nang' => 'Quản lý phân quyền'],

            // QUẢN LÝ NHÂN SỰ - ID 4-6
            ['id' => 4, 'ten_chuc_nang' => 'Quản lý nhân viên'],
            ['id' => 5, 'ten_chuc_nang' => 'Quản lý bác sĩ'],
            ['id' => 6, 'ten_chuc_nang' => 'Quản lý bệnh nhân'],

            // QUẢN LÝ CƠ SỞ VẬT CHẤT - ID 7
            ['id' => 7, 'ten_chuc_nang' => 'Quản lý phòng khám'],

            // QUẢN LÝ CHUYÊN MÔN - ID 8
            ['id' => 8, 'ten_chuc_nang' => 'Quản lý chuyên khoa'],

            // QUẢN LÝ LỊCH HẸN VÀ KHÁM BỆNH - ID 9-11
            ['id' => 9, 'ten_chuc_nang' => 'Quản lý lịch hẹn khám bệnh'],
            ['id' => 10, 'ten_chuc_nang' => 'Quản lý hồ sơ bệnh án'],
            ['id' => 11, 'ten_chuc_nang' => 'Quản lý lịch làm việc bác sĩ'],

            // THỐNG KÊ VÀ BÁO CÁO - ID 12-15
            ['id' => 12, 'ten_chuc_nang' => 'Xem thống kê tổng quan'],
            ['id' => 13, 'ten_chuc_nang' => 'Xem thống kê chi tiết theo chuyên khoa'],
            ['id' => 14, 'ten_chuc_nang' => 'Xem thống kê chi tiết theo bác sĩ'],
            ['id' => 15, 'ten_chuc_nang' => 'Xem thống kê chi tiết theo phòng khám'],

            // THANH TOÁN VÀ TÀI CHÍNH - ID 16
            ['id' => 16, 'ten_chuc_nang' => 'Quản lý thanh toán và doanh thu'],

            // CẤU HÌNH HỆ THỐNG - ID 17-18
            ['id' => 17, 'ten_chuc_nang' => 'Quản lý slide banner'],
            ['id' => 18, 'ten_chuc_nang' => 'Cấu hình hệ thống'],
        ]);
    }
}
