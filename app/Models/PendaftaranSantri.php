<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Public\ProgramPendidikan;

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
        'jenjang', 
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

    public function ortu(): BelongsTo
    {
        return $this->belongsTo(DataOrtu::class, 'data_ortu_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(ProgramPendidikan::class, 'program_id');
    }
}