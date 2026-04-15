<?php

namespace Database\Seeders;

use App\Models\ChuyenKhoa;
use App\Models\PhieuDatLich;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            BacSiChuyenNganhSeeder::class,
            BacSiSeeder::class,
            BenhNhanSeeder::class,
            PhieuDatLichSeeder::class,
            ChiTietDatLichSeeder::class,
            ChuyenKhoaSeeder::class,
            PhongKhamSeeder::class,
            LichLamViecSeeder::class,
            PhanQuyenSeeder::class,
            SlideSeeder::class,
            ChucNangSeeder::class,
            ChucVuSeeder::class,
        ]);
    }
}
