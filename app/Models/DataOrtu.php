<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PendaftaranSantri;

class DataOrtu extends Model
{
    protected $table = 'data_ortu';

    protected $fillable = [
        'nama_ayah',
        'nik_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pekerjaan_ayah',
        'pendidikan_terakhir_ayah',
        'nama_ibu',
        'nik_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pekerjaan_ibu',
        'pendidikan_terakhir_ibu',
        'penghasilan_ortu',
        'no_hp',
        'alamat',
        'kode_pos'
    ];

    public function santri()
    {
        return $this->hasOne(PendaftaranSantri::class, 'data_ortu_id');
    }
}
