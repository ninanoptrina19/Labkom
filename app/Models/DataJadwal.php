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
        'dosen',
        'prodi',
        'mata_kuliah',
        'laboratorium',
        'hari',
        'jam',
        'semester',
        'angkatan',
        'tanggal',
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