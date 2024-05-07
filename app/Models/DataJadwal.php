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
        'semester',
        'angkatan',
        'tanggal',
        'keterangan',
    ];

    public function hasil()
    {
        return $this->hasMany(DataHasil::class, 'jadwal_id');
    }

    public function dosen()
    {
        return $this->belongsTo(DataDosen::class);
    }
    public function laboratorium()
    {
        return  $this->belongsTo(DataLaboratorium::class);
    }
}