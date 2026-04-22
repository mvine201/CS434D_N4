<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lich_lam_viecs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_bac_si');
            $table->date('ngay_lam_viec');
            $table->time('thoi_gian_bat_dau');
            $table->time('thoi_gian_ket_thuc');

            $table->timestamps();

            $table->foreign('id_bac_si')
                ->references('id')
                ->on('bac_sis')
                ->onDelete('cascade');

            $table->index(['id_bac_si', 'ngay_lam_viec'], 'idx_lich_lam_viec_bac_si_ngay');
        });

        // Check constraint (nếu DB hỗ trợ)
        try {
            DB::statement("
                ALTER TABLE lich_lam_viecs
                ADD CONSTRAINT chk_lich_lam_viec_time
                CHECK (thoi_gian_ket_thuc > thoi_gian_bat_dau)
            ");
        } catch (\Throwable $e) {
            // bỏ qua nếu DB không hỗ trợ check constraint
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_lam_viecs');
    }
};
