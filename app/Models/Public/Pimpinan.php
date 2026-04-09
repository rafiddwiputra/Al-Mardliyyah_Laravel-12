<?php

namespace App\Models\Public; 

use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model 
{
    protected $table = 'pimpinan_pondok';

    protected $fillable = [
        'nama', 
        'foto', 
        'deskripsi', 
        'jabatan'
    ];
}