<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DataOrtu;

class PendaftaranSantri extends Model
{
     protected $table = 'pendaftaran_santri';

    protected $fillable = [
        'users_id',
        'data_ortu_id',
        'program_id',
        'nama_lengkap',
        'nisn',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'nomor_kk',
        'jenis_kelamin',
        'sekolah_asal',
        'sumber_informasi',
        'foto_santri',
        'akta_kelahiran',
        'kartu_keluarga',
        'ktp_ayah',
        'ktp_ibu',
        'sertifikat',
        'ukuran_baju_putra',
        'ukuran_celana_putra',
        'ukuran_baju_putri',
        'ukuran_rok_putri',
        'status'
    ];

    // relasi ke data ortu
    public function ortu()
    {
        return $this->belongsTo(DataOrtu::class, 'data_ortu_id');
    }
}
