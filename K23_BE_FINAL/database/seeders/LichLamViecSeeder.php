<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LichLamViecSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lich_lam_viecs')->truncate();
        $batch = [];
        $ngayBatDau = \Carbon\Carbon::today()->subDays(7);
        $ngayKetThuc = \Carbon\Carbon::today()->addDays(30);

        $caLamViec = [
            // Sáng
            ['bat_dau' => '08:00:00', 'ket_thuc' => '12:00:00'],
            // Chiều
            ['bat_dau' => '13:00:00', 'ket_thuc' => '17:00:00'],
            // Tối
            ['bat_dau' => '18:00:00', 'ket_thuc' => '21:00:00'],
        ];

        for ($doctorId = 1; $doctorId <= 15; $doctorId++) {
            for ($date = $ngayBatDau->copy(); $date->lte($ngayKetThuc); $date->addDay()) {
                foreach ($caLamViec as $ca) {
                    $batch[] = [
                        'id_bac_si' => $doctorId,
                        'ngay_lam_viec' => $date->toDateString(),
                        'thoi_gian_bat_dau' => $ca['bat_dau'],
                        'thoi_gian_ket_thuc' => $ca['ket_thuc'],
                    ];

                    if (count($batch) >= 5000) {
                        DB::table('lich_lam_viecs')->insert($batch);
                        $batch = [];
                    }
                }
            }
        }

        if (!empty($batch)) {
            DB::table('lich_lam_viecs')->insert($batch);
        }
    }
}
