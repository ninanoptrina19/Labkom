<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLaboratorium extends Model
{
    use HasFactory;

    protected $table = 'data_laboratorium';

    protected $fillable = [
        'nama',
        'kapasitas',
    ];

}