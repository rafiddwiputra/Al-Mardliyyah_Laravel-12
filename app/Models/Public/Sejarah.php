<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    // Karena nama tabelnya sejarah_pondok (bukan sejarahs)
    protected $table = 'sejarah_pondok';

    protected $fillable = [
        'tahun', 
        'judul', 
        'gambar', 
        'deskripsi_singkat', 
        'konten_detail'
    ];

    // Mengonversi JSON konten_detail menjadi Array otomatis
    protected $casts = [
        'konten_detail' => 'array',
    ];
}