<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    protected $table = 'sejarah_pondok';

    protected $fillable = [
        'tahun', 
        'judul', 
        'gambar', 
        'deskripsi_singkat', 
        'konten_detail'
    ];

    protected $casts = [
        'konten_detail' => 'array',
    ];
}