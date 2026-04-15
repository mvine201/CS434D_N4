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
        Schema::create('phieu_dat_lichs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_benh_nhan')->nullable();
            $table->date('ngay_dat_hen')->nullable();
            $table->text('ly_do_kham')->nullable();
            $table->integer('tinh_trang')->default(1);
            $table->integer('is_thanh_toan')->default(0);
            $table->double('tong_tien')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_dat_lichs');
    }
};
