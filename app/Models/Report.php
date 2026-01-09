<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'pesan',
        'latitude',
        'longitude',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'gambar',
        'status', // default 'baru'
    ];
}
