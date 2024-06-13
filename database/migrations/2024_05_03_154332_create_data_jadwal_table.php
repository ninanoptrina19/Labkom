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
            $table->unsignedBigInteger('dosen_id');
            $table->string('prodi');
            $table->string('penggunaan');
            $table->unsignedBigInteger('laboratorium_id');
            $table->string('hari');
            $table->integer('jam');
            $table->string('tahun_akademik'); // Menambahkan kolom tahun akademik
            $table->enum('semester', ['GANJIL', 'GENAP']); // Mengubah kolom semester menjadi enum
            $table->string('angkatan');
            $table->string('keterangan')->nullable(); // Menambahkan nullable agar tidak wajib diisi
            $table->timestamps();
            $table->foreign('laboratorium_id')->references('id')->on('data_laboratorium')->onDelete('cascade');
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
