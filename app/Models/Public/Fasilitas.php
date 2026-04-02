<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    // Nama tabel sesuai migration kamu
    protected $table = 'fasilitas_pondok';

    protected $fillable = [
        'nama_fasilitas',
        'gambar',
        'deskripsi'
    ];
}