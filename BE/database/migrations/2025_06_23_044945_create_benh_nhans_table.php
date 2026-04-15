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
        Schema::create('benh_nhans', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('hinh_anh')->nullable();
            $table->string('so_dien_thoai')->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->integer('gioi_tinh')->default(0)->comment('0: Nam, 1: Nu, 2: Khác');
            $table->string('dia_chi')->nullable();
            $table->string('hash_reset')->nullable();
            $table->string('hash_active')->nullable();
            $table->integer('is_active')->default(0);
            $table->integer('is_block')->default(0);
            $table->integer('tinh_trang')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benh_nhans');
    }
};
