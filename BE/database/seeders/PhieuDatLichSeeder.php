<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhieuDatLichSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phieu_dat_lichs')->truncate();

        DB::table('phieu_dat_lichs')->insert([
            [
                'id_benh_nhan' => 1,
                'ngay_dat_hen' => '2025-08-25',
                'ly_do_kham' => 'Khám định kỳ',
                'tinh_trang' => 3,
                'is_thanh_toan' => 1,
                'tong_tien' => 2500,
            ],
            [
                'id_benh_nhan' => 2,
                'ngay_dat_hen' => '2025-08-25',
                'ly_do_kham' => 'Đau đầu kéo dài',
                'tinh_trang' => 3,
                'is_thanh_toan' => 0,
                'tong_tien' => 2200,
            ],
            [
                'id_benh_nhan' => 3,
                'ngay_dat_hen' => '2025-08-26',
                'ly_do_kham' => 'Sốt cao',
                'tinh_trang' => 3,
                'is_thanh_toan' => 1,
                'tong_tien' => 2800,
            ],
            [
                'id_benh_nhan' => 4,
                'ngay_dat_hen' => '2025-08-26',
                'ly_do_kham' => 'Ho và khó thở',
                'tinh_trang' => 3,
                'is_thanh_toan' => 1,
                'tong_tien' => 2600,
            ],
            [
                'id_benh_nhan' => 5,
                'ngay_dat_hen' => '2025-08-27',
                'ly_do_kham' => 'Đau bụng',
                'tinh_trang' => 3,
                'is_thanh_toan' => 0,
                'tong_tien' => 2400,
            ],
            [
                'id_benh_nhan' => 6,
                'ngay_dat_hen' => '2025-08-27',
                'ly_do_kham' => 'Dị ứng da',
                'tinh_trang' => 3,
                'is_thanh_toan' => 1,
                'tong_tien' => 2700,
            ],
            [
                'id_benh_nhan' => 7,
                'ngay_dat_hen' => '2025-08-28',
                'ly_do_kham' => 'Khám thai định kỳ',
                'tinh_trang' => 3,
                'is_thanh_toan' => 1,
                'tong_tien' => 2300,
            ],
            [
                'id_benh_nhan' => 8,
                'ngay_dat_hen' => '2025-08-28',
                'ly_do_kham' => 'Đau khớp',
                'tinh_trang' => 1,
                'is_thanh_toan' => 0,
                'tong_tien' => 2900,
            ],
            [
                'id_benh_nhan' => 9,
                'ngay_dat_hen' => '2025-08-29',
                'ly_do_kham' => 'Rối loạn tiêu hóa',
                'tinh_trang' => 1,
                'is_thanh_toan' => 1,
                'tong_tien' => 2100,
            ],
            [
                'id_benh_nhan' => 10,
                'ngay_dat_hen' => '2025-08-29',
                'ly_do_kham' => 'Mệt mỏi kéo dài',
                'tinh_trang' => 1,
                'is_thanh_toan' => 0,
                'tong_tien' => 2600,
            ],
            [
                'id_benh_nhan' => 11,
                'ngay_dat_hen' => '2025-08-30',
                'ly_do_kham' => 'Khó ngủ, lo âu',
                'tinh_trang' => 0,
                'is_thanh_toan' => 1,
                'tong_tien' => 2800,
            ],

            [
                'id_benh_nhan' => 12,
                'ngay_dat_hen' => '2025-08-30',
                'ly_do_kham' => 'Mệt mỏi, mất tập trung',
                'tinh_trang' => 0,
                'is_thanh_toan' => 0,
                'tong_tien' => 2400,
            ],
            [
                'id_benh_nhan' => 13,
                'ngay_dat_hen' => '2025-08-31',
                'ly_do_kham' => 'Khám sức khỏe tổng quát',
                'tinh_trang' => 0,
                'is_thanh_toan' => 1,
                'tong_tien' => 2900,
            ],
            [
                'id_benh_nhan' => 14,
                'ngay_dat_hen' => '2025-08-31',
                'ly_do_kham' => 'Đau bụng kinh kéo dài',
                'tinh_trang' => 2,
                'is_thanh_toan' => 0,
                'tong_tien' => 2200,
            ],
            [
                'id_benh_nhan' => 15,
                'ngay_dat_hen' => '2025-09-01',
                'ly_do_kham' => 'Khó tiêu, ợ nóng',
                'tinh_trang' => 0,
                'is_thanh_toan' => 1,
                'tong_tien' => 2700,
            ],
            [
                'id_benh_nhan' => 16,
                'ngay_dat_hen' => '2025-09-01',
                'ly_do_kham' => 'Theo dõi u nang buồng trứng',
                'tinh_trang' => 2,
                'is_thanh_toan' => 1,
                'tong_tien' => 2500,
            ],
            [
                'id_benh_nhan' => 17,
                'ngay_dat_hen' => '2025-09-02',
                'ly_do_kham' => 'Đau lưng kéo dài',
                'tinh_trang' => 2,
                'is_thanh_toan' => 0,
                'tong_tien' => 2300,
            ],

            [
                'id_benh_nhan' => 18,
                'ngay_dat_hen' => '2025-09-02',
                'ly_do_kham' => 'Ho kéo dài, khó thở',
                'tinh_trang' => 2,
                'is_thanh_toan' => 1,
                'tong_tien' => 2800,
            ],
            [
                'id_benh_nhan' => 19,
                'ngay_dat_hen' => '2025-09-03',
                'ly_do_kham' => 'Đau khớp gối khi vận động',
                'tinh_trang' => 2,
                'is_thanh_toan' => 0,
                'tong_tien' => 2400,
            ],
            [
                'id_benh_nhan' => 20,
                'ngay_dat_hen' => '2025-09-03',
                'ly_do_kham' => 'Khối u vú tự sờ thấy',
                'tinh_trang' => 3,
                'is_thanh_toan' => 1,
                'tong_tien' => 2600,
            ],
            ['id_benh_nhan' => 21,  'ngay_dat_hen' => '2025-08-25', 'ly_do_kham' => 'Khám tim mạch định kỳ',      'tinh_trang' => 0, 'is_thanh_toan' => 1, 'tong_tien' => 2400],
            ['id_benh_nhan' => 22,  'ngay_dat_hen' => '2025-08-25', 'ly_do_kham' => 'Nổi mẩn ngứa kéo dài',       'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2100],
            ['id_benh_nhan' => 23,  'ngay_dat_hen' => '2025-08-26', 'ly_do_kham' => 'Khó tiêu, ợ chua',            'tinh_trang' => 2, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 24,  'ngay_dat_hen' => '2025-08-26', 'ly_do_kham' => 'Khám tổng quát',              'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 25,  'ngay_dat_hen' => '2025-08-27', 'ly_do_kham' => 'Đau lưng khi ngồi lâu',       'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2200],
            ['id_benh_nhan' => 26,  'ngay_dat_hen' => '2025-08-27', 'ly_do_kham' => 'Khám thai',                   'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2700],
            ['id_benh_nhan' => 27,  'ngay_dat_hen' => '2025-08-28', 'ly_do_kham' => 'Mất ngủ, lo âu',              'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 28,  'ngay_dat_hen' => '2025-08-28', 'ly_do_kham' => 'Rát họng, ho khan',           'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 29,  'ngay_dat_hen' => '2025-08-29', 'ly_do_kham' => 'Đau khớp cổ tay',            'tinh_trang' => 0, 'is_thanh_toan' => 1, 'tong_tien' => 2400],
            ['id_benh_nhan' => 30,  'ngay_dat_hen' => '2025-08-29', 'ly_do_kham' => 'Viêm da tái phát',            'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2100],
            ['id_benh_nhan' => 31,  'ngay_dat_hen' => '2025-08-30', 'ly_do_kham' => 'Đau dạ dày',                  'tinh_trang' => 2, 'is_thanh_toan' => 1, 'tong_tien' => 2900],
            ['id_benh_nhan' => 32,  'ngay_dat_hen' => '2025-08-30', 'ly_do_kham' => 'Khám sức khỏe định kỳ',      'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 33,  'ngay_dat_hen' => '2025-08-31', 'ly_do_kham' => 'Đau cổ vai gáy',             'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 34,  'ngay_dat_hen' => '2025-08-31', 'ly_do_kham' => 'Rối loạn nội tiết',           'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 35,  'ngay_dat_hen' => '2025-09-01', 'ly_do_kham' => 'Nghẹt mũi kéo dài',          'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 36,  'ngay_dat_hen' => '2025-09-01', 'ly_do_kham' => 'Khám phụ khoa',               'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2200],
            ['id_benh_nhan' => 37,  'ngay_dat_hen' => '2025-09-02', 'ly_do_kham' => 'Tê bì chân tay',              'tinh_trang' => 0, 'is_thanh_toan' => 1, 'tong_tien' => 2700],
            ['id_benh_nhan' => 38,  'ngay_dat_hen' => '2025-09-02', 'ly_do_kham' => 'Ho khan về đêm',              'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2400],
            ['id_benh_nhan' => 39,  'ngay_dat_hen' => '2025-09-03', 'ly_do_kham' => 'Viêm lợi chảy máu',           'tinh_trang' => 2, 'is_thanh_toan' => 1, 'tong_tien' => 2900],
            ['id_benh_nhan' => 40,  'ngay_dat_hen' => '2025-09-03', 'ly_do_kham' => 'Đau mắt đỏ',                  'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 41,  'ngay_dat_hen' => '2025-09-04', 'ly_do_kham' => 'Đau thắt ngực nhẹ',           'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 42,  'ngay_dat_hen' => '2025-09-04', 'ly_do_kham' => 'Nổi mụn nước',               'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 43,  'ngay_dat_hen' => '2025-09-05', 'ly_do_kham' => 'Khó thở khi gắng sức',        'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 44,  'ngay_dat_hen' => '2025-09-05', 'ly_do_kham' => 'Khám định kỳ công ty',        'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2200],
            ['id_benh_nhan' => 45,  'ngay_dat_hen' => '2025-09-06', 'ly_do_kham' => 'Đau thần kinh tọa',           'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2700],
            ['id_benh_nhan' => 46,  'ngay_dat_hen' => '2025-09-06', 'ly_do_kham' => 'Thai nghén',                  'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2400],
            ['id_benh_nhan' => 47,  'ngay_dat_hen' => '2025-09-07', 'ly_do_kham' => 'Rối loạn giấc ngủ',           'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2900],
            ['id_benh_nhan' => 48,  'ngay_dat_hen' => '2025-09-07', 'ly_do_kham' => 'Viêm họng cấp',               'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 49,  'ngay_dat_hen' => '2025-09-08', 'ly_do_kham' => 'Trật khớp nhẹ',              'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 50,  'ngay_dat_hen' => '2025-09-08', 'ly_do_kham' => 'Viêm da cơ địa',              'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 51,  'ngay_dat_hen' => '2025-09-09', 'ly_do_kham' => 'Trào ngược dạ dày',           'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 52,  'ngay_dat_hen' => '2025-09-09', 'ly_do_kham' => 'Khám tổng quát định kỳ',     'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2200],
            ['id_benh_nhan' => 53,  'ngay_dat_hen' => '2025-09-10', 'ly_do_kham' => 'Cứng cổ',                     'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2700],
            ['id_benh_nhan' => 54,  'ngay_dat_hen' => '2025-09-10', 'ly_do_kham' => 'Rối loạn kinh nguyệt',        'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2400],
            ['id_benh_nhan' => 55,  'ngay_dat_hen' => '2025-09-11', 'ly_do_kham' => 'Viêm mũi dị ứng',             'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2900],
            ['id_benh_nhan' => 56,  'ngay_dat_hen' => '2025-09-11', 'ly_do_kham' => 'Khám phụ khoa định kỳ',       'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 57,  'ngay_dat_hen' => '2025-09-12', 'ly_do_kham' => 'Tê bì nửa người',             'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 58,  'ngay_dat_hen' => '2025-09-12', 'ly_do_kham' => 'Ho lâu ngày',                 'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 59,  'ngay_dat_hen' => '2025-09-13', 'ly_do_kham' => 'Đau khớp cổ chân',           'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 60,  'ngay_dat_hen' => '2025-09-13', 'ly_do_kham' => 'Khám mắt',                    'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2200],
            ['id_benh_nhan' => 61,  'ngay_dat_hen' => '2025-09-14', 'ly_do_kham' => 'Khó thở về đêm',              'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2700],
            ['id_benh_nhan' => 62,  'ngay_dat_hen' => '2025-09-14', 'ly_do_kham' => 'Mụn trứng cá nặng',          'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2400],
            ['id_benh_nhan' => 63,  'ngay_dat_hen' => '2025-09-15', 'ly_do_kham' => 'Đầy bụng khó tiêu',           'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2900],
            ['id_benh_nhan' => 64,  'ngay_dat_hen' => '2025-09-15', 'ly_do_kham' => 'Đau vai gáy mạn',             'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 65,  'ngay_dat_hen' => '2025-09-16', 'ly_do_kham' => 'Đau dây thần kinh',          'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 66,  'ngay_dat_hen' => '2025-09-16', 'ly_do_kham' => 'Theo dõi thai',               'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 67,  'ngay_dat_hen' => '2025-09-17', 'ly_do_kham' => 'Lo âu kéo dài',               'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 68,  'ngay_dat_hen' => '2025-09-17', 'ly_do_kham' => 'Viêm họng mủ',                'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2200],
            ['id_benh_nhan' => 69,  'ngay_dat_hen' => '2025-09-18', 'ly_do_kham' => 'Đau gót chân',                'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2700],
            ['id_benh_nhan' => 70,  'ngay_dat_hen' => '2025-09-18', 'ly_do_kham' => 'Viêm da cơ địa nặng',        'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2400],
        ]);

        // THÊM PHIẾU THỨ 2 CHO MỖI BỆNH NHÂN (71-140) - Phù hợp logic frontend
        DB::table('phieu_dat_lichs')->insert([
            // Bệnh nhân 1-10: Phiếu thứ 2
            ['id_benh_nhan' => 1,  'ngay_dat_hen' => '2025-09-20', 'ly_do_kham' => 'Tái khám định kỳ',             'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2900],
            ['id_benh_nhan' => 2,  'ngay_dat_hen' => '2025-09-20', 'ly_do_kham' => 'Theo dõi đau đầu',             'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 3,  'ngay_dat_hen' => '2025-09-21', 'ly_do_kham' => 'Kiểm tra sau điều trị',        'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 4,  'ngay_dat_hen' => '2025-09-21', 'ly_do_kham' => 'Khám hô hấp lần 2',            'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 5,  'ngay_dat_hen' => '2025-09-22', 'ly_do_kham' => 'Tái khám bụng',                'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 6,  'ngay_dat_hen' => '2025-09-22', 'ly_do_kham' => 'Theo dõi dị ứng',              'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2200],
            ['id_benh_nhan' => 7,  'ngay_dat_hen' => '2025-09-23', 'ly_do_kham' => 'Siêu âm thai định kỳ',         'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2700],
            ['id_benh_nhan' => 8,  'ngay_dat_hen' => '2025-09-23', 'ly_do_kham' => 'Tái khám khớp',                'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2400],
            ['id_benh_nhan' => 9,  'ngay_dat_hen' => '2025-09-24', 'ly_do_kham' => 'Kiểm tra tiêu hóa',            'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2900],
            ['id_benh_nhan' => 10, 'ngay_dat_hen' => '2025-09-24', 'ly_do_kham' => 'Theo dõi mệt mỏi',             'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2600],

            // Bệnh nhân 11-20: Phiếu thứ 2
            ['id_benh_nhan' => 11, 'ngay_dat_hen' => '2025-09-25', 'ly_do_kham' => 'Tư vấn tâm lý lần 2',           'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 12, 'ngay_dat_hen' => '2025-09-25', 'ly_do_kham' => 'Kiểm tra sức khỏe',            'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 13, 'ngay_dat_hen' => '2025-09-26', 'ly_do_kham' => 'Tái khám tổng quát',           'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2500],
            ['id_benh_nhan' => 14, 'ngay_dat_hen' => '2025-09-26', 'ly_do_kham' => 'Theo dõi kinh nguyệt',         'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2200],
            ['id_benh_nhan' => 15, 'ngay_dat_hen' => '2025-09-27', 'ly_do_kham' => 'Kiểm tra dạ dày',              'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2700],
            ['id_benh_nhan' => 16, 'ngay_dat_hen' => '2025-09-27', 'ly_do_kham' => 'Siêu âm buồng trứng',          'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2400],
            ['id_benh_nhan' => 17, 'ngay_dat_hen' => '2025-09-28', 'ly_do_kham' => 'Tái khám lưng',                'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2900],
            ['id_benh_nhan' => 18, 'ngay_dat_hen' => '2025-09-28', 'ly_do_kham' => 'Theo dõi hô hấp',              'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 19, 'ngay_dat_hen' => '2025-09-29', 'ly_do_kham' => 'Kiểm tra khớp gối',            'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 20, 'ngay_dat_hen' => '2025-09-29', 'ly_do_kham' => 'Tái khám u vú',                'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2800],

            // Bệnh nhân 21-30: Phiếu thứ 2
            ['id_benh_nhan' => 21, 'ngay_dat_hen' => '2025-09-30', 'ly_do_kham' => 'Tái khám tim mạch',            'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2500],
            ['id_benh_nhan' => 22, 'ngay_dat_hen' => '2025-09-30', 'ly_do_kham' => 'Theo dõi da',                  'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2200],
            ['id_benh_nhan' => 23, 'ngay_dat_hen' => '2025-10-01', 'ly_do_kham' => 'Kiểm tra tiêu hóa',            'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2700],
            ['id_benh_nhan' => 24, 'ngay_dat_hen' => '2025-10-01', 'ly_do_kham' => 'Khám tổng quát lần 2',         'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2400],
            ['id_benh_nhan' => 25, 'ngay_dat_hen' => '2025-10-02', 'ly_do_kham' => 'Tái khám lưng',                'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2900],
            ['id_benh_nhan' => 26, 'ngay_dat_hen' => '2025-10-02', 'ly_do_kham' => 'Siêu âm thai 2',               'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 27, 'ngay_dat_hen' => '2025-10-03', 'ly_do_kham' => 'Tư vấn tâm lý 2',              'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2300],
            ['id_benh_nhan' => 28, 'ngay_dat_hen' => '2025-10-03', 'ly_do_kham' => 'Tái khám họng',                'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2800],
            ['id_benh_nhan' => 29, 'ngay_dat_hen' => '2025-10-04', 'ly_do_kham' => 'Theo dõi khớp tay',            'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2500],
            ['id_benh_nhan' => 30, 'ngay_dat_hen' => '2025-10-04', 'ly_do_kham' => 'Tái khám da',                  'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2200],

            // Bệnh nhân 31-40: Phiếu thứ 2
            ['id_benh_nhan' => 31, 'ngay_dat_hen' => '2025-10-05', 'ly_do_kham' => 'Tái khám dạ dày',              'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2700],
            ['id_benh_nhan' => 32, 'ngay_dat_hen' => '2025-10-05', 'ly_do_kham' => 'Khám sức khỏe lần 2',          'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2400],
            ['id_benh_nhan' => 33, 'ngay_dat_hen' => '2025-10-06', 'ly_do_kham' => 'Theo dõi cổ vai gáy',          'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2900],
            ['id_benh_nhan' => 34, 'ngay_dat_hen' => '2025-10-06', 'ly_do_kham' => 'Tái khám nội tiết',            'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 35, 'ngay_dat_hen' => '2025-10-07', 'ly_do_kham' => 'Kiểm tra mũi',                 'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 36, 'ngay_dat_hen' => '2025-10-07', 'ly_do_kham' => 'Tái khám phụ khoa',            'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 37, 'ngay_dat_hen' => '2025-10-08', 'ly_do_kham' => 'Theo dõi tê bì',               'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 38, 'ngay_dat_hen' => '2025-10-08', 'ly_do_kham' => 'Tái khám ho',                  'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2200],
            ['id_benh_nhan' => 39, 'ngay_dat_hen' => '2025-10-09', 'ly_do_kham' => 'Kiểm tra lợi',                 'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2700],
            ['id_benh_nhan' => 40, 'ngay_dat_hen' => '2025-10-09', 'ly_do_kham' => 'Tái khám mắt',                 'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2400],

            // Bệnh nhân 41-50: Phiếu thứ 2
            ['id_benh_nhan' => 41, 'ngay_dat_hen' => '2025-10-10', 'ly_do_kham' => 'Theo dõi tim',                 'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2900],
            ['id_benh_nhan' => 42, 'ngay_dat_hen' => '2025-10-10', 'ly_do_kham' => 'Tái khám da',                  'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2600],
            ['id_benh_nhan' => 43, 'ngay_dat_hen' => '2025-10-11', 'ly_do_kham' => 'Kiểm tra hô hấp',              'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 44, 'ngay_dat_hen' => '2025-10-11', 'ly_do_kham' => 'Khám định kỳ lần 2',           'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 45, 'ngay_dat_hen' => '2025-10-12', 'ly_do_kham' => 'Theo dõi thần kinh',           'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 46, 'ngay_dat_hen' => '2025-10-12', 'ly_do_kham' => 'Siêu âm thai 2',               'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2200],
            ['id_benh_nhan' => 47, 'ngay_dat_hen' => '2025-10-13', 'ly_do_kham' => 'Tái khám giấc ngủ',            'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2700],
            ['id_benh_nhan' => 48, 'ngay_dat_hen' => '2025-10-13', 'ly_do_kham' => 'Theo dõi họng',                'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2400],
            ['id_benh_nhan' => 49, 'ngay_dat_hen' => '2025-10-14', 'ly_do_kham' => 'Kiểm tra khớp',                'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2900],
            ['id_benh_nhan' => 50, 'ngay_dat_hen' => '2025-10-14', 'ly_do_kham' => 'Tái khám da cơ địa',           'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2600],

            // Bệnh nhân 51-60: Phiếu thứ 2
            ['id_benh_nhan' => 51, 'ngay_dat_hen' => '2025-10-15', 'ly_do_kham' => 'Theo dõi dạ dày',              'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 52, 'ngay_dat_hen' => '2025-10-15', 'ly_do_kham' => 'Khám tổng quát 3',             'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 53, 'ngay_dat_hen' => '2025-10-16', 'ly_do_kham' => 'Tái khám cổ',                  'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 54, 'ngay_dat_hen' => '2025-10-16', 'ly_do_kham' => 'Theo dõi kinh nguyệt 2',       'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2200],
            ['id_benh_nhan' => 55, 'ngay_dat_hen' => '2025-10-17', 'ly_do_kham' => 'Tái khám mũi dị ứng',          'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2700],
            ['id_benh_nhan' => 56, 'ngay_dat_hen' => '2025-10-17', 'ly_do_kham' => 'Khám phụ khoa 3',              'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2400],
            ['id_benh_nhan' => 57, 'ngay_dat_hen' => '2025-10-18', 'ly_do_kham' => 'Theo dõi thần kinh',           'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2900],
            ['id_benh_nhan' => 58, 'ngay_dat_hen' => '2025-10-18', 'ly_do_kham' => 'Tái khám ho 2',                'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2600],
            ['id_benh_nhan' => 59, 'ngay_dat_hen' => '2025-10-19', 'ly_do_kham' => 'Kiểm tra cổ chân',             'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2300],
            ['id_benh_nhan' => 60, 'ngay_dat_hen' => '2025-10-19', 'ly_do_kham' => 'Tái khám mắt 2',               'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2800],

            // Bệnh nhân 61-70: Phiếu thứ 2
            ['id_benh_nhan' => 61, 'ngay_dat_hen' => '2025-10-20', 'ly_do_kham' => 'Theo dõi hô hấp 2',            'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2500],
            ['id_benh_nhan' => 62, 'ngay_dat_hen' => '2025-10-20', 'ly_do_kham' => 'Tái khám da mụn',              'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2200],
            ['id_benh_nhan' => 63, 'ngay_dat_hen' => '2025-10-21', 'ly_do_kham' => 'Kiểm tra tiêu hóa 2',          'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2700],
            ['id_benh_nhan' => 64, 'ngay_dat_hen' => '2025-10-21', 'ly_do_kham' => 'Tái khám vai gáy',             'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2400],
            ['id_benh_nhan' => 65, 'ngay_dat_hen' => '2025-10-22', 'ly_do_kham' => 'Theo dõi thần kinh 2',         'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2900],
            ['id_benh_nhan' => 66, 'ngay_dat_hen' => '2025-10-22', 'ly_do_kham' => 'Siêu âm thai 3',               'tinh_trang' => 1, 'is_thanh_toan' => 1, 'tong_tien' => 2600],
            ['id_benh_nhan' => 67, 'ngay_dat_hen' => '2025-10-23', 'ly_do_kham' => 'Tư vấn tâm lý 3',              'tinh_trang' => 1, 'is_thanh_toan' => 0, 'tong_tien' => 2300],
            ['id_benh_nhan' => 68, 'ngay_dat_hen' => '2025-10-23', 'ly_do_kham' => 'Tái khám họng mủ',             'tinh_trang' => 3, 'is_thanh_toan' => 1, 'tong_tien' => 2800],
            ['id_benh_nhan' => 69, 'ngay_dat_hen' => '2025-10-24', 'ly_do_kham' => 'Theo dõi gót chân',            'tinh_trang' => 2, 'is_thanh_toan' => 0, 'tong_tien' => 2500],
            ['id_benh_nhan' => 70, 'ngay_dat_hen' => '2025-10-24', 'ly_do_kham' => 'Tái khám da cơ địa 2',         'tinh_trang' => 0, 'is_thanh_toan' => 0, 'tong_tien' => 2200],
        ]);

        // Cập nhật mã đặt lịch (ma_dat_lich) sau khi thêm dữ liệu
        $ids = DB::table('phieu_dat_lichs')
            ->whereNull('ma_dat_lich')
            ->pluck('id');

        foreach ($ids as $id) {
            DB::table('phieu_dat_lichs')
                ->where('id', $id)
                ->update([
                    'ma_dat_lich' => 'HDBS' . str_pad($id, 6, '0', STR_PAD_LEFT),
                ]);
        }
    }
}
