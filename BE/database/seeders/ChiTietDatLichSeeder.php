<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietDatLichSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chi_tiet_dat_lichs')->truncate();

        DB::table('chi_tiet_dat_lichs')->insert([
            // 1) Tim mạch - Bác sĩ 1 (tinh_trang = 3 - giữ nguyên)
            ['id_phieu_dat_lich' => 1,  'id_bac_si' => 1,  'thoi_gian_bat_dau' => '2025-01-15 08:00:00', 'thoi_gian_ket_thuc' => '2025-01-15 08:30:00', 'so_sao_danh_gia' => 5, 'don_thuoc' => 'Amlodipine 5mg, Aspirin 81mg', 'chuan_doan' => 'Tăng huyết áp độ 1', 'ghi_chu' => 'Theo dõi huyết áp tại nhà', 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-15 08:30:00', 'nhan_xet' => 'Bác sĩ rất tận tình', 'ngay_danh_gia' => '2025-01-15', 'created_at' => '2025-08-20 08:00:00'],
            // 2) Da liễu - Bác sĩ 2 (tinh_trang = 3 - giữ nguyên)
            ['id_phieu_dat_lich' => 2,  'id_bac_si' => 2,  'thoi_gian_bat_dau' => '2025-01-15 09:00:00', 'thoi_gian_ket_thuc' => '2025-01-15 09:30:00', 'so_sao_danh_gia' => 4, 'don_thuoc' => 'Hydrocortisone kem, Cetirizine 10mg', 'chuan_doan' => 'Viêm da tiếp xúc dị ứng', 'ghi_chu' => 'Tránh tiếp xúc chất gây dị ứng', 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-15 09:30:00', 'nhan_xet' => 'Phục vụ chuyên nghiệp', 'ngay_danh_gia' => '2025-01-15', 'created_at' => '2025-08-20 10:00:00'],
            // 3) Nội tổng quát - Bác sĩ 3 (tinh_trang = 3 - giữ nguyên)
            ['id_phieu_dat_lich' => 3,  'id_bac_si' => 3,  'thoi_gian_bat_dau' => '2025-01-16 10:00:00', 'thoi_gian_ket_thuc' => '2025-01-16 10:30:00', 'so_sao_danh_gia' => 5, 'don_thuoc' => 'Paracetamol 500mg, Vitamin C', 'chuan_doan' => 'Nhiễm virus đường hô hấp', 'ghi_chu' => 'Uống nhiều nước, nghỉ ngơi', 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-16 10:30:00', 'nhan_xet' => 'Hài lòng với dịch vụ', 'ngay_danh_gia' => '2025-01-16', 'created_at' => '2025-08-21 09:00:00'],
            // 4) Nhi - Bác sĩ 4 (tinh_trang = 3 - giữ nguyên)
            ['id_phieu_dat_lich' => 4,  'id_bac_si' => 4,  'thoi_gian_bat_dau' => '2025-01-16 11:00:00', 'thoi_gian_ket_thuc' => '2025-01-16 11:30:00', 'so_sao_danh_gia' => 4, 'don_thuoc' => 'Thuốc ho thảo dược, hạ sốt', 'chuan_doan' => 'Viêm đường hô hấp trên ở trẻ', 'ghi_chu' => 'Uống ấm, theo dõi nhiệt độ', 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-16 11:30:00', 'nhan_xet' => 'Rất tốt', 'ngay_danh_gia' => '2025-01-16', 'created_at' => '2025-08-21 11:00:00'],
            // 5) Mắt - Bác sĩ 5 (tinh_trang = 3 - giữ nguyên)
            ['id_phieu_dat_lich' => 5,  'id_bac_si' => 5,  'thoi_gian_bat_dau' => '2025-01-17 13:00:00', 'thoi_gian_ket_thuc' => '2025-01-17 13:30:00', 'so_sao_danh_gia' => 5, 'don_thuoc' => 'Nhỏ mắt Chloramphenicol', 'chuan_doan' => 'Viêm kết mạc cấp', 'ghi_chu' => 'Giữ vệ sinh mắt, tránh dụi mắt', 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-17 13:30:00', 'nhan_xet' => 'Bác sĩ tận tình', 'ngay_danh_gia' => '2025-01-17', 'created_at' => '2025-08-22 13:00:00'],
            // 6) Sản phụ khoa - Bác sĩ 6 (tinh_trang = 3 - giữ nguyên)
            ['id_phieu_dat_lich' => 6,  'id_bac_si' => 6,  'thoi_gian_bat_dau' => '2025-01-17 14:00:00', 'thoi_gian_ket_thuc' => '2025-01-17 14:30:00', 'so_sao_danh_gia' => 4, 'don_thuoc' => 'Fluconazole 150mg, Clotrimazole kem', 'chuan_doan' => 'Viêm âm đạo do nấm', 'ghi_chu' => 'Giữ vệ sinh, tránh đồ bó sát', 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-17 14:30:00', 'nhan_xet' => 'Tư vấn rõ ràng', 'ngay_danh_gia' => '2025-01-17', 'created_at' => '2025-08-22 14:00:00'],
            // 7) Thần kinh - Bác sĩ 7 (tinh_trang = 3 - giữ nguyên)
            ['id_phieu_dat_lich' => 7,  'id_bac_si' => 7,  'thoi_gian_bat_dau' => '2025-01-17 15:00:00', 'thoi_gian_ket_thuc' => '2025-01-17 15:30:00', 'so_sao_danh_gia' => 5, 'don_thuoc' => 'Eperisone 50mg, Paracetamol 500mg', 'chuan_doan' => 'Đau đầu căng cơ', 'ghi_chu' => 'Nghỉ ngơi, giảm căng thẳng', 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-17 15:30:00', 'nhan_xet' => 'Bác sĩ nhẹ nhàng', 'ngay_danh_gia' => '2025-01-17', 'created_at' => '2025-08-23 15:00:00'],
            // 8) Răng Hàm Mặt - Bác sĩ 8 (tinh_trang = 3 - giữ nguyên)
            ['id_phieu_dat_lich' => 8,  'id_bac_si' => 8,  'thoi_gian_bat_dau' => '2025-01-17 16:00:00', 'thoi_gian_ket_thuc' => '2025-01-17 16:30:00', 'so_sao_danh_gia' => 4, 'don_thuoc' => 'Amoxicillin 500mg, súc miệng Chlorhexidine', 'chuan_doan' => 'Viêm nha chu', 'ghi_chu' => 'Lấy cao răng, vệ sinh răng miệng', 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-17 16:30:00', 'nhan_xet' => 'Khá hài lòng', 'ngay_danh_gia' => '2025-01-17', 'created_at' => '2025-08-23 16:00:00'],
            // 9) Chấn thương chỉnh hình - Bác sĩ 9 (tinh_trang = 1 - set null)
            ['id_phieu_dat_lich' => 9,  'id_bac_si' => 9,  'thoi_gian_bat_dau' => '2025-01-17 17:00:00', 'thoi_gian_ket_thuc' => '2025-01-17 17:30:00', 'so_sao_danh_gia' => 3, 'don_thuoc' => null, 'chuan_doan' => null, 'ghi_chu' => null, 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-17 17:30:00', 'nhan_xet' => 'Cần theo dõi thêm', 'ngay_danh_gia' => '2025-01-17', 'created_at' => '2025-08-24 17:00:00'],
            // 10) Tâm thần - Bác sĩ 10 (tinh_trang = 1 - set null)
            ['id_phieu_dat_lich' => 10, 'id_bac_si' => 10, 'thoi_gian_bat_dau' => '2025-01-17 18:00:00', 'thoi_gian_ket_thuc' => '2025-01-17 18:30:00', 'so_sao_danh_gia' => 5, 'don_thuoc' => null, 'chuan_doan' => null, 'ghi_chu' => null, 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-17 18:30:00', 'nhan_xet' => 'Rất hài lòng', 'ngay_danh_gia' => '2025-01-17', 'created_at' => '2025-08-24 18:00:00'],
            // 11) Ung bướu - Bác sĩ 11 (tinh_trang = 3 - giữ nguyên)
            ['id_phieu_dat_lich' => 11, 'id_bac_si' => 11, 'thoi_gian_bat_dau' => '2025-01-17 19:00:00', 'thoi_gian_ket_thuc' => '2025-01-17 19:30:00', 'so_sao_danh_gia' => 4, 'don_thuoc' => 'Hẹn tầm soát thêm', 'chuan_doan' => 'U vú nghi lành tính (theo dõi)', 'ghi_chu' => 'Chụp nhũ ảnh, siêu âm vú', 'don_gia_kham' => 3000, 'thoi_gian_ket_thuc_kham' => '2025-01-17 19:30:00', 'nhan_xet' => 'Ổn', 'ngay_danh_gia' => '2025-01-17', 'created_at' => '2025-08-25 19:00:00'],

            // 24: Nhi - Bác sĩ 4: Khám ho sốt cho trẻ
            [
                'id_phieu_dat_lich' => 24,
                'id_bac_si' => 4,
                'thoi_gian_bat_dau' => '2025-09-01 09:30:00',
                'thoi_gian_ket_thuc' => '2025-09-01 10:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Thuốc hạ sốt, siro ho thảo dược',
                'chuan_doan' => 'Viêm đường hô hấp trên',
                'ghi_chu' => 'Theo dõi nhiệt độ, uống nhiều nước, nghỉ ngơi',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-25 09:30:00'
            ],

            // 28: Răng Hàm Mặt - Bác sĩ 8: Đau răng, sưng nướu
            [
                'id_phieu_dat_lich' => 28,
                'id_bac_si' => 8,
                'thoi_gian_bat_dau' => '2025-09-01 11:30:00',
                'thoi_gian_ket_thuc' => '2025-09-01 12:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Súc miệng Chlorhexidine, Paracetamol giảm đau',
                'chuan_doan' => 'Viêm nướu răng',
                'ghi_chu' => 'Vệ sinh răng miệng sạch sẽ, tránh thức ăn cứng',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-26 11:30:00'
            ],

            // 32: Nội tiết - Bác sĩ 12: Khám tiểu đường định kỳ
            [
                'id_phieu_dat_lich' => 32,
                'id_bac_si' => 12,
                'thoi_gian_bat_dau' => '2025-09-02 08:30:00',
                'thoi_gian_ket_thuc' => '2025-09-02 09:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Metformin 500mg, kiểm tra đường huyết',
                'chuan_doan' => 'Đái tháo đường type 2 kiểm soát',
                'ghi_chu' => 'Duy trì chế độ ăn kiêng, tập thể dục thường xuyên',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-26 08:30:00'
            ],

            // 36: Tim mạch - Bác sĩ 1: Đau ngực, khó thở
            [
                'id_phieu_dat_lich' => 36,
                'id_bac_si' => 1,
                'thoi_gian_bat_dau' => '2025-09-02 10:30:00',
                'thoi_gian_ket_thuc' => '2025-09-02 11:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Aspirin 81mg, Nitroglycerin ngậm dưới lưỡi',
                'chuan_doan' => 'Thiếu máu cơ tim cục bộ',
                'ghi_chu' => 'Theo dõi huyết áp, tái khám khi có triệu chứng nặng',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-27 10:30:00'
            ],

            // 40: Mắt - Bác sĩ 5: Ngứa mắt, đỏ mắt
            [
                'id_phieu_dat_lich' => 40,
                'id_bac_si' => 5,
                'thoi_gian_bat_dau' => '2025-09-02 12:30:00',
                'thoi_gian_ket_thuc' => '2025-09-02 13:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Nhỏ mắt Natri Clorid 0.9%, thuốc nhỏ chống dị ứng',
                'chuan_doan' => 'Viêm kết mạc dị ứng',
                'ghi_chu' => 'Tránh dụi mắt, giữ vệ sinh mắt',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-27 12:30:00'
            ],

            // 44: Chấn thương chỉnh hình - Bác sĩ 9: Đau khớp gối sau té ngã
            [
                'id_phieu_dat_lich' => 44,
                'id_bac_si' => 9,
                'thoi_gian_bat_dau' => '2025-09-03 09:30:00',
                'thoi_gian_ket_thuc' => '2025-09-03 10:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Paracetamol giảm đau, chườm lạnh',
                'chuan_doan' => 'Chấn thương phần mềm khớp gối',
                'ghi_chu' => 'Hạn chế vận động, theo dõi sưng đau',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-28 09:30:00'
            ],

            // 48: Thận - Bác sĩ 13: Tiểu buốt, tiểu rắt
            [
                'id_phieu_dat_lich' => 48,
                'id_bac_si' => 13,
                'thoi_gian_bat_dau' => '2025-09-03 11:30:00',
                'thoi_gian_ket_thuc' => '2025-09-03 12:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Cefuroxime 500mg, uống nhiều nước',
                'chuan_doan' => 'Nhiễm trùng tiểu dưới',
                'ghi_chu' => 'Theo dõi sốt, đau lưng, tái khám nếu không đỡ',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-28 11:30:00'
            ],

            // 52: Da liễu - Bác sĩ 2: Dị ứng nổi mẩn ngứa
            [
                'id_phieu_dat_lich' => 52,
                'id_bac_si' => 2,
                'thoi_gian_bat_dau' => '2025-09-04 08:30:00',
                'thoi_gian_ket_thuc' => '2025-09-04 09:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Cetirizine 10mg, bôi kem dưỡng ẩm',
                'chuan_doan' => 'Mề đay cấp',
                'ghi_chu' => 'Tránh tiếp xúc dị nguyên, theo dõi triệu chứng',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-29 08:30:00'
            ],

            // 56: Sản phụ khoa - Bác sĩ 6: Khám thai định kỳ
            [
                'id_phieu_dat_lich' => 56,
                'id_bac_si' => 6,
                'thoi_gian_bat_dau' => '2025-09-04 10:30:00',
                'thoi_gian_ket_thuc' => '2025-09-04 11:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Bổ sung sắt, acid folic',
                'chuan_doan' => 'Thai 20 tuần, phát triển bình thường',
                'ghi_chu' => 'Theo dõi cân nặng, lịch siêu âm tiếp theo',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-29 10:30:00'
            ],

            // 60: Tâm thần - Bác sĩ 10: Mất ngủ kéo dài
            [
                'id_phieu_dat_lich' => 60,
                'id_bac_si' => 10,
                'thoi_gian_bat_dau' => '2025-09-04 12:30:00',
                'thoi_gian_ket_thuc' => '2025-09-04 13:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Melatonin 3mg, tư vấn tâm lý',
                'chuan_doan' => 'Rối loạn lo âu, mất ngủ',
                'ghi_chu' => 'Giữ vệ sinh giấc ngủ, hạn chế dùng thiết bị điện tử trước khi ngủ',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-30 12:30:00'
            ],

            // 64: Hô hấp - Bác sĩ 14: Khó thở, ho kéo dài
            [
                'id_phieu_dat_lich' => 64,
                'id_bac_si' => 14,
                'thoi_gian_bat_dau' => '2025-10-15 09:30:00',
                'thoi_gian_ket_thuc' => '2025-10-15 10:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Ambroxol, Paracetamol nếu sốt',
                'chuan_doan' => 'Viêm phế quản cấp',
                'ghi_chu' => 'Uống nhiều nước, nghỉ ngơi, theo dõi khó thở tăng',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-30 09:30:00'
            ],

            // 68: Nội tổng quát - Bác sĩ 3: Đau bụng, rối loạn tiêu hóa
            [
                'id_phieu_dat_lich' => 68,
                'id_bac_si' => 3,
                'thoi_gian_bat_dau' => '2025-10-17 11:30:00',
                'thoi_gian_ket_thuc' => '2025-10-17 12:00:00',
                'so_sao_danh_gia' => null,
                'don_thuoc' => 'Men tiêu hóa, Oresol nếu tiêu chảy',
                'chuan_doan' => 'Rối loạn tiêu hóa chức năng',
                'ghi_chu' => 'Ăn uống nhẹ, tránh đồ dầu mỡ, theo dõi dấu hiệu mất nước',
                'don_gia_kham' => 3000,
                'thoi_gian_ket_thuc_kham' => null,
                'nhan_xet' => null,
                'ngay_danh_gia' => null,
                'created_at' => '2025-08-30 11:30:00'
            ],

        ]);

        // Bổ sung 50 chi tiết tương ứng phiếu 21 -> 70
        // Dựa vào tinh_trang trong PhieuDatLichSeeder:
        // - tinh_trang = 0, 1, 2: set chuan_doan, don_thuoc, ghi_chu = null
        // - tinh_trang = 3: giữ nguyên giá trị
        DB::table('chi_tiet_dat_lichs')->insert([
            // Phiếu 21-40: tinh_trang = 0, 1, 2 (set null)
            ['id_phieu_dat_lich' => 21, 'id_bac_si' => 1,  'thoi_gian_bat_dau' => '2025-09-01 08:00:00', 'thoi_gian_ket_thuc' => '2025-09-01 08:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 08:00:00'],
            ['id_phieu_dat_lich' => 22, 'id_bac_si' => 2,  'thoi_gian_bat_dau' => '2025-09-01 08:30:00', 'thoi_gian_ket_thuc' => '2025-09-01 09:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-21 08:30:00'],
            ['id_phieu_dat_lich' => 23, 'id_bac_si' => 3,  'thoi_gian_bat_dau' => '2025-09-01 09:00:00', 'thoi_gian_ket_thuc' => '2025-09-01 09:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-22 09:00:00'],
            ['id_phieu_dat_lich' => 25, 'id_bac_si' => 5,  'thoi_gian_bat_dau' => '2025-09-01 10:00:00', 'thoi_gian_ket_thuc' => '2025-09-01 10:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-23 10:00:00'],
            ['id_phieu_dat_lich' => 26, 'id_bac_si' => 6,  'thoi_gian_bat_dau' => '2025-09-01 10:30:00', 'thoi_gian_ket_thuc' => '2025-09-01 11:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-24 10:30:00'],
            ['id_phieu_dat_lich' => 27, 'id_bac_si' => 7,  'thoi_gian_bat_dau' => '2025-09-01 11:00:00', 'thoi_gian_ket_thuc' => '2025-09-01 11:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-25 11:00:00'],
            ['id_phieu_dat_lich' => 29, 'id_bac_si' => 9,  'thoi_gian_bat_dau' => '2025-09-01 12:00:00', 'thoi_gian_ket_thuc' => '2025-09-01 12:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-26 12:00:00'],
            ['id_phieu_dat_lich' => 30, 'id_bac_si' => 10, 'thoi_gian_bat_dau' => '2025-09-01 12:30:00', 'thoi_gian_ket_thuc' => '2025-09-01 13:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-27 12:30:00'],
            ['id_phieu_dat_lich' => 31, 'id_bac_si' => 11, 'thoi_gian_bat_dau' => '2025-09-02 08:00:00', 'thoi_gian_ket_thuc' => '2025-09-02 08:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-28 08:00:00'],
            ['id_phieu_dat_lich' => 33, 'id_bac_si' => 13, 'thoi_gian_bat_dau' => '2025-09-02 09:00:00', 'thoi_gian_ket_thuc' => '2025-09-02 09:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-29 09:00:00'],
            ['id_phieu_dat_lich' => 34, 'id_bac_si' => 14, 'thoi_gian_bat_dau' => '2025-09-02 09:30:00', 'thoi_gian_ket_thuc' => '2025-09-02 10:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-30 09:30:00'],
            ['id_phieu_dat_lich' => 35, 'id_bac_si' => 15, 'thoi_gian_bat_dau' => '2025-09-02 10:00:00', 'thoi_gian_ket_thuc' => '2025-09-02 10:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 37, 'id_bac_si' => 2,  'thoi_gian_bat_dau' => '2025-02-02 11:00:00', 'thoi_gian_ket_thuc' => '2025-02-02 11:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 38, 'id_bac_si' => 3,  'thoi_gian_bat_dau' => '2025-02-02 11:30:00', 'thoi_gian_ket_thuc' => '2025-02-02 12:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 39, 'id_bac_si' => 4,  'thoi_gian_bat_dau' => '2025-09-02 12:00:00', 'thoi_gian_ket_thuc' => '2025-09-02 12:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 41, 'id_bac_si' => 6,  'thoi_gian_bat_dau' => '2025-09-03 08:00:00', 'thoi_gian_ket_thuc' => '2025-09-03 08:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 42, 'id_bac_si' => 7,  'thoi_gian_bat_dau' => '2025-09-03 08:30:00', 'thoi_gian_ket_thuc' => '2025-09-03 09:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 43, 'id_bac_si' => 8,  'thoi_gian_bat_dau' => '2025-09-03 09:00:00', 'thoi_gian_ket_thuc' => '2025-09-03 09:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 45, 'id_bac_si' => 10, 'thoi_gian_bat_dau' => '2025-09-03 10:00:00', 'thoi_gian_ket_thuc' => '2025-09-03 10:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 46, 'id_bac_si' => 11, 'thoi_gian_bat_dau' => '2025-09-03 10:30:00', 'thoi_gian_ket_thuc' => '2025-09-03 11:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 47, 'id_bac_si' => 12, 'thoi_gian_bat_dau' => '2025-09-03 11:00:00', 'thoi_gian_ket_thuc' => '2025-09-03 11:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 49, 'id_bac_si' => 14, 'thoi_gian_bat_dau' => '2025-09-03 12:00:00', 'thoi_gian_ket_thuc' => '2025-09-03 12:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 50, 'id_bac_si' => 15, 'thoi_gian_bat_dau' => '2025-09-03 12:30:00', 'thoi_gian_ket_thuc' => '2025-09-03 13:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 51, 'id_bac_si' => 1,  'thoi_gian_bat_dau' => '2025-09-04 08:00:00', 'thoi_gian_ket_thuc' => '2025-09-04 08:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 53, 'id_bac_si' => 3,  'thoi_gian_bat_dau' => '2025-09-04 09:00:00', 'thoi_gian_ket_thuc' => '2025-09-04 09:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 54, 'id_bac_si' => 4,  'thoi_gian_bat_dau' => '2025-09-04 09:30:00', 'thoi_gian_ket_thuc' => '2025-09-04 10:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 55, 'id_bac_si' => 5,  'thoi_gian_bat_dau' => '2025-09-04 10:00:00', 'thoi_gian_ket_thuc' => '2025-09-04 10:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 56, 'id_bac_si' => 6,  'thoi_gian_bat_dau' => '2025-09-04 10:30:00', 'thoi_gian_ket_thuc' => '2025-09-04 11:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 57, 'id_bac_si' => 7,  'thoi_gian_bat_dau' => '2025-09-04 11:00:00', 'thoi_gian_ket_thuc' => '2025-09-04 11:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 58, 'id_bac_si' => 8,  'thoi_gian_bat_dau' => '2025-09-04 11:30:00', 'thoi_gian_ket_thuc' => '2025-09-04 12:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 59, 'id_bac_si' => 9,  'thoi_gian_bat_dau' => '2025-09-04 12:00:00', 'thoi_gian_ket_thuc' => '2025-09-04 12:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 61, 'id_bac_si' => 11, 'thoi_gian_bat_dau' => '2025-09-05 08:00:00', 'thoi_gian_ket_thuc' => '2025-09-05 08:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 62, 'id_bac_si' => 12, 'thoi_gian_bat_dau' => '2025-10-14 08:30:00', 'thoi_gian_ket_thuc' => '2025-10-14 09:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 63, 'id_bac_si' => 13, 'thoi_gian_bat_dau' => '2025-10-15 09:00:00', 'thoi_gian_ket_thuc' => '2025-10-15 09:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 65, 'id_bac_si' => 15, 'thoi_gian_bat_dau' => '2025-10-16 10:00:00', 'thoi_gian_ket_thuc' => '2025-10-16 10:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 66, 'id_bac_si' => 1,  'thoi_gian_bat_dau' => '2025-10-16 10:30:00', 'thoi_gian_ket_thuc' => '2025-10-16 11:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 67, 'id_bac_si' => 2,  'thoi_gian_bat_dau' => '2025-10-17 11:00:00', 'thoi_gian_ket_thuc' => '2025-10-17 11:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 69, 'id_bac_si' => 4,  'thoi_gian_bat_dau' => '2025-10-18 12:00:00', 'thoi_gian_ket_thuc' => '2025-10-18 12:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
            ['id_phieu_dat_lich' => 70, 'id_bac_si' => 5,  'thoi_gian_bat_dau' => '2025-09-05 12:30:00', 'thoi_gian_ket_thuc' => '2025-09-05 13:00:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-08-20 10:00:00'],
        ]);

        // THÊM CHI TIẾT CHO 70 PHIẾU MỚI (ID 71-140) - Làm từng cái phù hợp
        DB::table('chi_tiet_dat_lichs')->insert([
            // ID 71-80: Bệnh nhân 1-10 (phiếu thứ 2)
            ['id_phieu_dat_lich' => 71, 'id_bac_si' => 1,  'thoi_gian_bat_dau' => '2025-09-20 08:00:00', 'thoi_gian_ket_thuc' => '2025-09-20 08:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-09-20 08:00:00'], // tinh_trang = 1, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 72, 'id_bac_si' => 2,  'thoi_gian_bat_dau' => '2025-09-20 09:00:00', 'thoi_gian_ket_thuc' => '2025-09-20 09:30:00', 'chuan_doan' => 'Đau đầu mãn tính', 'don_thuoc' => 'Paracetamol 500mg', 'ghi_chu' => 'Theo dõi triệu chứng', 'don_gia_kham' => 3500, 'created_at' => '2025-09-20 09:00:00'], // tinh_trang = 3, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 73, 'id_bac_si' => 3,  'thoi_gian_bat_dau' => '2025-09-21 10:00:00', 'thoi_gian_ket_thuc' => '2025-09-21 10:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-09-21 10:00:00'], // tinh_trang = 0, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 74, 'id_bac_si' => 4,  'thoi_gian_bat_dau' => '2025-09-21 11:00:00', 'thoi_gian_ket_thuc' => '2025-09-21 11:30:00', 'chuan_doan' => 'Viêm phế quản', 'don_thuoc' => 'Ambroxol 15mg', 'ghi_chu' => 'Uống nhiều nước', 'don_gia_kham' => 4000, 'created_at' => '2025-09-21 11:00:00'], // tinh_trang = 1, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 75, 'id_bac_si' => 5,  'thoi_gian_bat_dau' => '2025-09-22 13:00:00', 'thoi_gian_ket_thuc' => '2025-09-22 13:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3000, 'created_at' => '2025-09-22 13:00:00'], // tinh_trang = 2, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 76, 'id_bac_si' => 6,  'thoi_gian_bat_dau' => '2025-09-22 14:00:00', 'thoi_gian_ket_thuc' => '2025-09-22 14:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 4500, 'created_at' => '2025-09-22 14:00:00'], // tinh_trang = 1, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 77, 'id_bac_si' => 7,  'thoi_gian_bat_dau' => '2025-09-23 15:00:00', 'thoi_gian_ket_thuc' => '2025-09-23 15:30:00', 'chuan_doan' => 'Thai khỏe mạnh 24 tuần', 'don_thuoc' => 'Vitamin tổng hợp', 'ghi_chu' => 'Theo dõi cân nặng', 'don_gia_kham' => 4500, 'created_at' => '2025-09-23 15:00:00'], // tinh_trang = 3, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 78, 'id_bac_si' => 8,  'thoi_gian_bat_dau' => '2025-09-23 16:00:00', 'thoi_gian_ket_thuc' => '2025-09-23 16:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3800, 'created_at' => '2025-09-23 16:00:00'], // tinh_trang = 0, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 79, 'id_bac_si' => 9,  'thoi_gian_bat_dau' => '2025-09-24 17:00:00', 'thoi_gian_ket_thuc' => '2025-09-24 17:30:00', 'chuan_doan' => 'Rối loạn tiêu hóa nhẹ', 'don_thuoc' => 'Men tiêu hóa', 'ghi_chu' => 'Ăn uống điều độ', 'don_gia_kham' => 5000, 'created_at' => '2025-09-24 17:00:00'], // tinh_trang = 1, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 80, 'id_bac_si' => 10, 'thoi_gian_bat_dau' => '2025-09-24 18:00:00', 'thoi_gian_ket_thuc' => '2025-09-24 18:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3800, 'created_at' => '2025-09-24 18:00:00'], // tinh_trang = 1, is_thanh_toan = 0

            // ID 81-90: Bệnh nhân 11-20 (phiếu thứ 2)
            ['id_phieu_dat_lich' => 81, 'id_bac_si' => 11, 'thoi_gian_bat_dau' => '2025-09-25 08:00:00', 'thoi_gian_ket_thuc' => '2025-09-25 08:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3800, 'created_at' => '2025-09-25 08:00:00'], // tinh_trang = 0, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 82, 'id_bac_si' => 12, 'thoi_gian_bat_dau' => '2025-09-25 09:00:00', 'thoi_gian_ket_thuc' => '2025-09-25 09:30:00', 'chuan_doan' => 'Sức khỏe tốt', 'don_thuoc' => 'Vitamin C', 'ghi_chu' => 'Duy trì lối sống lành mạnh', 'don_gia_kham' => 3800, 'created_at' => '2025-09-25 09:00:00'], // tinh_trang = 1, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 83, 'id_bac_si' => 13, 'thoi_gian_bat_dau' => '2025-09-26 10:00:00', 'thoi_gian_ket_thuc' => '2025-09-26 10:30:00', 'chuan_doan' => 'Sức khỏe ổn định', 'don_thuoc' => 'Multivitamin', 'ghi_chu' => 'Tái khám 6 tháng', 'don_gia_kham' => 3800, 'created_at' => '2025-09-26 10:00:00'], // tinh_trang = 3, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 84, 'id_bac_si' => 14, 'thoi_gian_bat_dau' => '2025-09-26 11:00:00', 'thoi_gian_ket_thuc' => '2025-09-26 11:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3800, 'created_at' => '2025-09-26 11:00:00'], // tinh_trang = 1, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 85, 'id_bac_si' => 15, 'thoi_gian_bat_dau' => '2025-09-27 12:00:00', 'thoi_gian_ket_thuc' => '2025-09-27 12:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3000, 'created_at' => '2025-09-27 12:00:00'], // tinh_trang = 2, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 86, 'id_bac_si' => 1,  'thoi_gian_bat_dau' => '2025-09-27 13:00:00', 'thoi_gian_ket_thuc' => '2025-09-27 13:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-09-27 13:00:00'], // tinh_trang = 0, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 87, 'id_bac_si' => 2,  'thoi_gian_bat_dau' => '2025-09-28 14:00:00', 'thoi_gian_ket_thuc' => '2025-09-28 14:30:00', 'chuan_doan' => 'Đau lưng cải thiện', 'don_thuoc' => 'Thuốc giãn cơ', 'ghi_chu' => 'Tập vật lý trị liệu', 'don_gia_kham' => 3500, 'created_at' => '2025-09-28 14:00:00'], // tinh_trang = 1, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 88, 'id_bac_si' => 3,  'thoi_gian_bat_dau' => '2025-09-28 15:00:00', 'thoi_gian_ket_thuc' => '2025-09-28 15:30:00', 'chuan_doan' => 'Hô hấp bình thường', 'don_thuoc' => 'Không cần thuốc', 'ghi_chu' => 'Sức khỏe tốt', 'don_gia_kham' => 5000, 'created_at' => '2025-09-28 15:00:00'], // tinh_trang = 3, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 89, 'id_bac_si' => 4,  'thoi_gian_bat_dau' => '2025-09-29 16:00:00', 'thoi_gian_ket_thuc' => '2025-09-29 16:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 4000, 'created_at' => '2025-09-29 16:00:00'], // tinh_trang = 1, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 90, 'id_bac_si' => 5,  'thoi_gian_bat_dau' => '2025-09-29 17:00:00', 'thoi_gian_ket_thuc' => '2025-09-29 17:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3000, 'created_at' => '2025-09-29 17:00:00'], // tinh_trang = 0, is_thanh_toan = 0
        ]);

        // ID 91-140: 50 phiếu còn lại - làm đơn giản hơn
        DB::table('chi_tiet_dat_lichs')->insert([
            // Bệnh nhân 21-30 (ID 91-100)
            ['id_phieu_dat_lich' => 91, 'id_bac_si' => 6,  'thoi_gian_bat_dau' => '2025-09-30 08:00:00', 'thoi_gian_ket_thuc' => '2025-09-30 08:30:00', 'chuan_doan' => 'Tim mạch ổn định', 'don_thuoc' => 'Aspirin 81mg', 'ghi_chu' => 'Duy trì thuốc', 'don_gia_kham' => 5000, 'created_at' => '2025-09-30 08:00:00'], // tinh_trang = 1, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 92, 'id_bac_si' => 7,  'thoi_gian_bat_dau' => '2025-09-30 09:00:00', 'thoi_gian_ket_thuc' => '2025-09-30 09:30:00', 'chuan_doan' => 'Da khỏe mạnh', 'don_thuoc' => 'Kem dưỡng ẩm', 'ghi_chu' => 'Bảo vệ da khỏi nắng', 'don_gia_kham' => 3500, 'created_at' => '2025-09-30 09:00:00'], // tinh_trang = 3, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 93, 'id_bac_si' => 8,  'thoi_gian_bat_dau' => '2025-10-01 10:00:00', 'thoi_gian_ket_thuc' => '2025-10-01 10:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3800, 'created_at' => '2025-10-01 10:00:00'], // tinh_trang = 2, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 94, 'id_bac_si' => 9,  'thoi_gian_bat_dau' => '2025-10-01 11:00:00', 'thoi_gian_ket_thuc' => '2025-10-01 11:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 5000, 'created_at' => '2025-10-01 11:00:00'], // tinh_trang = 0, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 95, 'id_bac_si' => 10, 'thoi_gian_bat_dau' => '2025-10-02 12:00:00', 'thoi_gian_ket_thuc' => '2025-10-02 12:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3800, 'created_at' => '2025-10-02 12:00:00'], // tinh_trang = 1, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 96, 'id_bac_si' => 11, 'thoi_gian_bat_dau' => '2025-10-02 13:00:00', 'thoi_gian_ket_thuc' => '2025-10-02 13:30:00', 'chuan_doan' => 'Thai khỏe mạnh 26 tuần', 'don_thuoc' => 'Sắt, Acid folic', 'ghi_chu' => 'Siêu âm định kỳ', 'don_gia_kham' => 4500, 'created_at' => '2025-10-02 13:00:00'], // tinh_trang = 1, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 97, 'id_bac_si' => 12, 'thoi_gian_bat_dau' => '2025-10-03 14:00:00', 'thoi_gian_ket_thuc' => '2025-10-03 14:30:00', 'chuan_doan' => 'Lo âu nhẹ cải thiện', 'don_thuoc' => 'Thảo dược an thần', 'ghi_chu' => 'Tập thể dục nhẹ', 'don_gia_kham' => 3800, 'created_at' => '2025-10-03 14:00:00'], // tinh_trang = 3, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 98, 'id_bac_si' => 13, 'thoi_gian_bat_dau' => '2025-10-03 15:00:00', 'thoi_gian_ket_thuc' => '2025-10-03 15:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3800, 'created_at' => '2025-10-03 15:00:00'], // tinh_trang = 0, is_thanh_toan = 0
            ['id_phieu_dat_lich' => 99, 'id_bac_si' => 14, 'thoi_gian_bat_dau' => '2025-10-04 16:00:00', 'thoi_gian_ket_thuc' => '2025-10-04 16:30:00', 'chuan_doan' => 'Khớp tay cải thiện', 'don_thuoc' => 'Calcium + D3', 'ghi_chu' => 'Tập vận động nhẹ', 'don_gia_kham' => 3800, 'created_at' => '2025-10-04 16:00:00'], // tinh_trang = 1, is_thanh_toan = 1
            ['id_phieu_dat_lich' => 100,'id_bac_si' => 15, 'thoi_gian_bat_dau' => '2025-10-04 17:00:00', 'thoi_gian_ket_thuc' => '2025-10-04 17:30:00', 'chuan_doan' => null, 'don_thuoc' => null, 'ghi_chu' => null, 'don_gia_kham' => 3000, 'created_at' => '2025-10-04 17:00:00'], // tinh_trang = 2, is_thanh_toan = 0
        ]);

        // CHỈ THÊM MỘT SỐ CHI TIẾT QUAN TRỌNG CHO PHIẾU CÒN LẠI
        DB::table('chi_tiet_dat_lichs')->insert([
            // Một số phiếu tinh_trang = 3 (đã hoàn thành) - có đầy đủ thông tin
            ['id_phieu_dat_lich' => 102,'id_bac_si' => 2,  'thoi_gian_bat_dau' => '2025-10-05 09:00:00', 'thoi_gian_ket_thuc' => '2025-10-05 09:30:00', 'chuan_doan' => 'Sức khỏe tổng quát tốt', 'don_thuoc' => 'Không cần thuốc', 'ghi_chu' => 'Duy trì lối sống lành mạnh', 'don_gia_kham' => 3500, 'created_at' => '2025-10-05 09:00:00'],
            ['id_phieu_dat_lich' => 104,'id_bac_si' => 4,  'thoi_gian_bat_dau' => '2025-10-06 11:00:00', 'thoi_gian_ket_thuc' => '2025-10-06 11:30:00', 'chuan_doan' => 'Nội tiết ổn định', 'don_thuoc' => 'Điều chỉnh lối sống', 'ghi_chu' => 'Kiểm tra định kỳ', 'don_gia_kham' => 3800, 'created_at' => '2025-10-06 11:00:00'],
            ['id_phieu_dat_lich' => 106,'id_bac_si' => 6,  'thoi_gian_bat_dau' => '2025-10-07 13:00:00', 'thoi_gian_ket_thuc' => '2025-10-07 13:30:00', 'chuan_doan' => 'Phụ khoa bình thường', 'don_thuoc' => 'Probiotic', 'ghi_chu' => 'Vệ sinh cá nhân tốt', 'don_gia_kham' => 4500, 'created_at' => '2025-10-07 13:00:00'],
            ['id_phieu_dat_lich' => 111,'id_bac_si' => 11, 'thoi_gian_bat_dau' => '2025-10-10 08:00:00', 'thoi_gian_ket_thuc' => '2025-10-10 08:30:00', 'chuan_doan' => 'Tim khỏe mạnh', 'don_thuoc' => 'Vitamin E', 'ghi_chu' => 'Tập thể dục đều đặn', 'don_gia_kham' => 5000, 'created_at' => '2025-10-10 08:00:00'],
            ['id_phieu_dat_lich' => 114,'id_bac_si' => 14, 'thoi_gian_bat_dau' => '2025-10-11 11:00:00', 'thoi_gian_ket_thuc' => '2025-10-11 11:30:00', 'chuan_doan' => 'Khám định kỳ bình thường', 'don_thuoc' => 'Multivitamin', 'ghi_chu' => 'Sức khỏe tốt', 'don_gia_kham' => 3800, 'created_at' => '2025-10-11 11:00:00'],
            ['id_phieu_dat_lich' => 116,'id_bac_si' => 1,  'thoi_gian_bat_dau' => '2025-10-12 13:00:00', 'thoi_gian_ket_thuc' => '2025-10-12 13:30:00', 'chuan_doan' => 'Thai khỏe mạnh 28 tuần', 'don_thuoc' => 'Omega 3', 'ghi_chu' => 'Thai nhi phát triển tốt', 'don_gia_kham' => 4500, 'created_at' => '2025-10-12 13:00:00'],
        ]);

        // Backfill: tạo chi tiết cho mọi phiếu chưa có chi tiết để tránh dữ liệu null khi tra cứu
        $existingDetailPhieuIds = DB::table('chi_tiet_dat_lichs')->pluck('id_phieu_dat_lich')->toArray();
        $missingPhieus = DB::table('phieu_dat_lichs')
            ->whereNotIn('id', $existingDetailPhieuIds)
            ->select('id', 'ngay_dat_hen', 'tinh_trang')
            ->orderBy('id')
            ->get();

        $inserts = [];
        foreach ($missingPhieus as $row) {
            $id = (int) $row->id;
            $date = $row->ngay_dat_hen ?: now()->toDateString();
            $start = $date . ' 08:00:00';
            $end = $date . ' 08:30:00';
            $doctorId = (($id - 1) % 15) + 1; // phân bổ vòng tròn 15 bác sĩ có sẵn
            $isConfirmed = ((int)($row->tinh_trang ?? 0)) === 1; // tinh_trang = 1
            $inserts[] = [
                'id_phieu_dat_lich' => $id,
                'id_bac_si' => $doctorId,
                'thoi_gian_bat_dau' => $start,
                'thoi_gian_ket_thuc' => $end,
                'chuan_doan' => $isConfirmed ? 'Chẩn đoán tạm thời' : null,
                'don_thuoc' => $isConfirmed ? 'Paracetamol 500mg x 10 viên' : null,
                'ghi_chu' => $isConfirmed ? 'Theo dõi thêm và tái khám khi cần' : null,
                'don_gia_kham' => 3000,
                'created_at' => $date . ' 08:00:00',
            ];
        }
        if (!empty($inserts)) {
            DB::table('chi_tiet_dat_lichs')->insert($inserts);
        }

        // Đảm bảo mọi phiếu có tinh_trang = 1 đều có chuan_doan, don_thuoc, ghi_chu (nếu đang null)
        $phieuXacNhanIds = DB::table('phieu_dat_lichs')
            ->where('tinh_trang', 1)
            ->pluck('id')
            ->toArray();

        if (!empty($phieuXacNhanIds)) {
            $rows = DB::table('chi_tiet_dat_lichs')
                ->whereIn('id_phieu_dat_lich', $phieuXacNhanIds)
                ->get(['id', 'chuan_doan', 'don_thuoc', 'ghi_chu']);

            foreach ($rows as $r) {
                $update = [];
                if ($r->chuan_doan === null) $update['chuan_doan'] = 'Chẩn đoán tạm thời';
                if ($r->don_thuoc === null) $update['don_thuoc'] = 'Paracetamol 500mg x 10 viên';
                if ($r->ghi_chu === null) $update['ghi_chu'] = 'Theo dõi thêm và tái khám khi cần';
                if (!empty($update)) {
                    DB::table('chi_tiet_dat_lichs')->where('id', $r->id)->update($update);
                }
            }
        }
    }
}
