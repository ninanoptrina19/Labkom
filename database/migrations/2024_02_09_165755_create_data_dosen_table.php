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
        Schema::create('data_dosen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Menambahkan kolom user_id dan relasi
            $table->string('nama');
            $table->integer('nidn');
            $table->string('prodi');
            $table->string('fakultas');
            $table->string('telepon'); // Ubah dari integer ke string untuk menampung nomor telepon dengan lebih fleksibel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_dosen');
    }
};
