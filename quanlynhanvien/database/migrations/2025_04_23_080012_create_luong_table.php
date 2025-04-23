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
        Schema::create('luong', function (Blueprint $table) {
            $table->unsignedBigInteger('id_nhan_vien'); // Sử dụng unsignedBigInteger cho FK
            $table->decimal('so_tien_luong', 15, 2)->nullable(false);
            $table->date('thang_nhan_luong')->nullable(false);

            $table->primary(['id_nhan_vien', 'thang_nhan_luong']);

            $table->foreign('id_nhan_vien')
                  ->references('id_nhan_vien')->on('nhan_vien')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luong');
    }
};
