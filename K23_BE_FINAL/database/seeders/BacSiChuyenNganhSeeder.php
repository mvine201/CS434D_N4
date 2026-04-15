<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BacSiChuyenNganhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bac_si_chuyen_nganhs')->truncate();

        DB::table('bac_si_chuyen_nganhs')->insert([
            // Bác sĩ Nguyễn Văn An - Tim mạch
            [
                'id' => 1,
                'id_bac_si' => 1,
                'id_chuyen_khoa' => 8, // Tim mạch can thiệp
                'thoi_gian_du_kien' => '2025-01-15 08:00:00',
            ],
            [
                'id' => 2,
                'id_bac_si' => 1,
                'id_chuyen_khoa' => 12, // Nội tổng quát
                'thoi_gian_du_kien' => '2025-01-15 14:00:00',
            ],

            // Bác sĩ Trần Thị Bình - Da liễu
            [
                'id' => 3,
                'id_bac_si' => 2,
                'id_chuyen_khoa' => 3, // Da liễu thẩm mỹ
                'thoi_gian_du_kien' => '2025-01-15 09:00:00',
            ],

            // Bác sĩ Lê Văn Cường - Nội tổng hợp
            [
                'id' => 4,
                'id_bac_si' => 3,
                'id_chuyen_khoa' => 12, // Nội tổng quát
                'thoi_gian_du_kien' => '2025-01-15 10:00:00',
            ],
            [
                'id' => 5,
                'id_bac_si' => 3,
                'id_chuyen_khoa' => 1, // Nội hô hấp
                'thoi_gian_du_kien' => '2025-01-15 16:00:00',
            ],

            // Bác sĩ Phạm Thị Dung - Nhi khoa
            [
                'id' => 6,
                'id_bac_si' => 4,
                'id_chuyen_khoa' => 7, // Nhi hô hấp - tiêu hóa
                'thoi_gian_du_kien' => '2025-01-15 11:00:00',
            ],
            [
                'id' => 7,
                'id_bac_si' => 4,
                'id_chuyen_khoa' => 4, // Tai Mũi Họng trẻ em
                'thoi_gian_du_kien' => '2025-01-15 15:00:00',
            ],

            // Bác sĩ Vũ Hoàng Nam - Mắt
            [
                'id' => 8,
                'id_bac_si' => 5,
                'id_chuyen_khoa' => 14, // Mắt
                'thoi_gian_du_kien' => '2025-01-15 13:00:00',
            ],

            // Bác sĩ Hoàng Thị Mai - Sản phụ khoa
            [
                'id' => 9,
                'id_bac_si' => 6,
                'id_chuyen_khoa' => 5, // Sản khoa
                'thoi_gian_du_kien' => '2025-01-16 08:00:00',
            ],
            [
                'id' => 10,
                'id_bac_si' => 6,
                'id_chuyen_khoa' => 6, // Phụ khoa
                'thoi_gian_du_kien' => '2025-01-16 14:00:00',
            ],

            // Bác sĩ Đặng Văn Hùng - Thần kinh
            [
                'id' => 11,
                'id_bac_si' => 7,
                'id_chuyen_khoa' => 2, // Ngoại thần kinh
                'thoi_gian_du_kien' => '2025-01-16 09:00:00',
            ],

            // Bác sĩ Ngô Thị Lan - Răng hàm mặt
            [
                'id' => 12,
                'id_bac_si' => 8,
                'id_chuyen_khoa' => 15, // Răng Hàm Mặt
                'thoi_gian_du_kien' => '2025-01-16 10:00:00',
            ],

            // Bác sĩ Lý Văn Tài - Xương khớp
            [
                'id' => 13,
                'id_bac_si' => 9,
                'id_chuyen_khoa' => 13, // Chấn thương chỉnh hình
                'thoi_gian_du_kien' => '2025-01-16 11:00:00',
            ],
            [
                'id' => 14,
                'id_bac_si' => 9,
                'id_chuyen_khoa' => 9, // Phẫu thuật chỉnh hình cột sống
                'thoi_gian_du_kien' => '2025-01-16 16:00:00',
            ],

            // Bác sĩ Trịnh Thị Hương - Tâm thần
            [
                'id' => 15,
                'id_bac_si' => 10,
                'id_chuyen_khoa' => 10, // Tư vấn tâm lý học đường
                'thoi_gian_du_kien' => '2025-01-16 13:00:00',
            ],

            // Bác sĩ Võ Văn Thành - Ung bướu
            [
                'id' => 16,
                'id_bac_si' => 11,
                'id_chuyen_khoa' => 16, // Ung bướu
                'thoi_gian_du_kien' => '2025-01-16 14:00:00',
            ],

            // Bác sĩ Đỗ Thị Nga - Hô hấp
            [
                'id' => 17,
                'id_bac_si' => 12,
                'id_chuyen_khoa' => 1, // Nội hô hấp
                'thoi_gian_du_kien' => '2025-01-16 15:00:00',
            ],

            // Bác sĩ Bùi Văn Minh - Tiêu hóa
            [
                'id' => 18,
                'id_bac_si' => 13,
                'id_chuyen_khoa' => 19, // Tiêu hóa - Gan mật
                'thoi_gian_du_kien' => '2025-01-16 16:00:00',
            ],

            // Bác sĩ Lê Thị Kim - Nội tiết
            [
                'id' => 19,
                'id_bac_si' => 14,
                'id_chuyen_khoa' => 8, // Nội tiết người lớn
                'thoi_gian_du_kien' => '2025-01-17 08:00:00',
            ],

            // Bác sĩ Phan Văn Dũng - Cấp cứu
            [
                'id' => 20,
                'id_bac_si' => 15,
                'id_chuyen_khoa' => 17, // Hồi sức cấp cứu
                'thoi_gian_du_kien' => '2025-01-17 09:00:00',
            ],
            [
                'id' => 21,
                'id_bac_si' => 15,
                'id_chuyen_khoa' => 13, // Chấn thương chỉnh hình (để hỗ trợ cấp cứu)
                'thoi_gian_du_kien' => '2025-01-17 15:00:00',
            ],

            // Bổ sung thêm chuyên khoa cho một số bác sĩ để đa dạng
            [
                'id' => 22,
                'id_bac_si' => 1,
                'id_chuyen_khoa' => 18, // Thận - Tiết niệu (liên quan tim mạch)
                'thoi_gian_du_kien' => '2025-01-17 10:00:00',
            ],
            [
                'id' => 23,
                'id_bac_si' => 3,
                'id_chuyen_khoa' => 19, // Tiêu hóa - Gan mật (nội tổng quát)
                'thoi_gian_du_kien' => '2025-01-17 11:00:00',
            ],
            [
                'id' => 24,
                'id_bac_si' => 7,
                'id_chuyen_khoa' => 9, // Phẫu thuật chỉnh hình cột sống (thần kinh)
                'thoi_gian_du_kien' => '2025-01-17 14:00:00',
            ],
        ]);
    }
}
