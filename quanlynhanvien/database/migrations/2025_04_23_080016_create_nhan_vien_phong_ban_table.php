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
        Schema::create('nhan_vien_phong_ban', function (Blueprint $table) {
            $table->unsignedBigInteger('id_phong_ban'); 
            $table->unsignedBigInteger('id_nhan_vien');
            $table->string('chuc_vu', 100)->nullable(); 

            $table->primary(['id_phong_ban', 'id_nhan_vien']);

            $table->foreign('id_phong_ban')
                  ->references('id_phong_ban')->on('phong_ban')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('nhan_vien_phong_ban');
    }
};
