<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahPondok extends Model
{
    use HasFactory;

    protected $table = 'sejarah_pondok';

    protected $fillable = [
        'tahun',
        'judul',
        'gambar',
        'deskripsi_singkat',
        'konten_detail'
    ];

    // Penting: Agar JSON otomatis jadi array saat dipanggil di Blade
    protected $casts = [
        'konten_detail' => 'array',
    ];
}