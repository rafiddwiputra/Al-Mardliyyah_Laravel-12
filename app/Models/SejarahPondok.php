<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SejarahPondok extends Model
{
    protected $table = 'sejarah_pondok';

    protected $fillable = [
        'tahun',
        'gambar',
        'deskripsi'
    ];
}