<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lich_lam_viecs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_bac_si');
            $table->date('ngay_lam_viec');
            $table->time('thoi_gian_bat_dau');
            $table->time('thoi_gian_ket_thuc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_lam_viecs');
    }
};
