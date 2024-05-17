<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJadwal extends Model
{
    use HasFactory;

    protected $table = 'data_jadwal';

    protected $fillable = [
        'dosen_id',
        'prodi',
        'mata_kuliah',
        'laboratorium_id',
        'hari',
        'jam',
        'tahun_akademik',  // Menambahkan tahun_akademik
        'semester',  // Mengubah semester menjadi enum
        'angkatan',
        'keterangan',
    ];
    public function dosen()
    {
        return $this->belongsTo(DataDosen::class);
    }
    public function laboratorium()
    {
        return  $this->belongsTo(DataLaboratorium::class);
    }
}