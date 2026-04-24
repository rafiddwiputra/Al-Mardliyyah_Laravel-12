<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;

class InformasiPendaftaran extends Model
{
    protected $table = 'informasi_pendaftaran';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];
}