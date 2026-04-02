<?php

namespace App\Models\Public; // 1. Pastikan namespace ini benar

use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model // 2. Pastikan nama class "Pimpinan" (P besar)
{
    // 3. Beritahu nama tabelnya sesuai migration kamu
    protected $table = 'pimpinan_pondok';

    // 4. Izinkan kolom-kolom ini diisi
    protected $fillable = [
        'nama', 
        'foto', 
        'deskripsi', 
        'jabatan'
    ];
}