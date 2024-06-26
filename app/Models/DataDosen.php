<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDosen extends Model
{
    use HasFactory;

    protected $table = 'data_dosen';

    protected $fillable = [
        'user_id',
        'nama',
        'nidn',
        'prodi',
        'fakultas',
        'telepon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}