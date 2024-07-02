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
        Schema::create('data_jadwal', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->string('jam'); 
            $table->unsignedBigInteger('laboratorium_id');
            $table->string('penggunaan')->nullable();
            $table->string('mata_kuliah')->nullable();
            $table->unsignedBigInteger('dosen_id');
            $table->string('prodi');
            $table->unsignedBigInteger('tahun_akademik_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
            $table->foreign('laboratorium_id')->references('id')->on('data_laboratorium')->onDelete('cascade');
            $table->foreign('tahun_akademik_id')->references('id')->on('tahun_akademik')->onDelete('cascade');
            $table->foreign('dosen_id')->references('id')->on('data_dosen')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_jadwal');
    }
};
