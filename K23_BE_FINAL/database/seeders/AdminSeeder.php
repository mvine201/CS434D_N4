<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->truncate();
        DB::table('admins')->insert([
            [
                'id' => 1,
                'ho_ten' => 'Nguyễn Quốc Long',
                'email' => 'quoclongdng@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '0987654321',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 1,
                'tinh_trang' => 1,
            ],
            [
                'id' => 2,
                'ho_ten' => 'Lê Thanh Trường',
                'email' => 'truonglt@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '1234567890',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 2,
                'tinh_trang' => 1,
            ],
            [
                'id' => 3,
                'ho_ten' => 'Võ Văn Việt',
                'email' => 'vovanviet@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '1234567890',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 3,
                'tinh_trang' => 1,
            ],
            [
                'id' => 4,
                'ho_ten' => 'Nguyễn Văn Nhân',
                'email' => 'nguyenvannhan@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '1234567890',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 4,
                'tinh_trang' => 1,
            ],
            // THÊM 8 ADMIN CHO CÁC CHỨC VỤ 5-12
            [
                'id' => 5,
                'ho_ten' => 'Trần Thị Lan',
                'email' => 'tranthilan@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '0987654325',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 5, // Quản lý chuyên khoa
                'tinh_trang' => 1,
            ],
            [
                'id' => 6,
                'ho_ten' => 'Phạm Văn Dũng',
                'email' => 'phamvandung@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '0987654326',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 6, // Quản lý lịch hẹn
                'tinh_trang' => 1,
            ],
            [
                'id' => 7,
                'ho_ten' => 'Lê Thị Hương',
                'email' => 'lethihuong@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '0987654327',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 7, // Quản lý hồ sơ bệnh án
                'tinh_trang' => 1,
            ],
            [
                'id' => 8,
                'ho_ten' => 'Hoàng Văn Minh',
                'email' => 'hoangvanminh@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '0987654328',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 8, // Quản lý tài chính
                'tinh_trang' => 1,
            ],
            [
                'id' => 9,
                'ho_ten' => 'Vũ Thị Mai',
                'email' => 'vuthimai@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '0987654329',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 9, // Nhân viên lễ tân
                'tinh_trang' => 1,
            ],
            [
                'id' => 10,
                'ho_ten' => 'Đỗ Văn Hải',
                'email' => 'dovanhai@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '0987654330',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 10, // Nhân viên y tế
                'tinh_trang' => 1,
            ],
            [
                'id' => 11,
                'ho_ten' => 'Ngô Thị Trang',
                'email' => 'ngothitrang@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '0987654331',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 11, // Nhân viên kế toán
                'tinh_trang' => 1,
            ],
            [
                'id' => 12,
                'ho_ten' => 'Bùi Văn Quang',
                'email' => 'buivanquang@gmail.com',
                'password' => bcrypt('123456'),
                'so_dien_thoai' => '0987654332',
                'hinh_anh' => 'https://dzfullstack.com/logo.png',
                'id_chuc_vu' => 12, // Nhân viên hỗ trợ kỹ thuật
                'tinh_trang' => 1,
            ],
        ]);
    }
}
