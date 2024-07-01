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
        'hari',
        'jam',
        'laboratorium_id',
        'penggunaan/mata_kuliah',
        'dosen_id',
        'prodi',
        'tahun_akademik_id',
        'tanggal',  // Mengubah semester menjadi enu
    ];
    public function dosen()
    {
        return $this->belongsTo(DataDosen::class);
    }
    public function laboratorium()
    {
        return  $this->belongsTo(DataLaboratorium::class);
    }

    public function tahunAkademik()
    {
        return  $this->belongsTo(TahunAkademik::class);
    }
}
