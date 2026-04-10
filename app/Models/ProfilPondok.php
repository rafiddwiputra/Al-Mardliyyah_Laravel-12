<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPondok extends Model
{
    protected $table = 'profil_pondok';

    protected $fillable = [
        'nama_pondok',
        'logo',
        'banner_image',
        'tagline',
        'created_by',
        'updated_by'
    ];
}