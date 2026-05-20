<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Public\ProgramPendidikan;
use App\Models\Public\PeriodePendaftaran; 

class PendaftaranSantri extends Model
{
    protected $table = 'pendaftaran_santri';

    protected $fillable = [
        'users_id',
        'data_ortu_id',
        'program_id',
        'id_periode',
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
        'catatan_admin',      
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

    public function periode(): BelongsTo
    {
        return $this->belongsTo(PeriodePendaftaran::class, 'id_periode', 'id_periode');
    }

    // =================  ID  =================
    public function getSmartIdAttribute()
    {
        $tahun = '0000';
        $kodeGelombang = '';

        if ($this->periode) {
            $tahun = \Carbon\Carbon::parse($this->periode->tanggal_mulai)->format('Y');
            
            if (preg_match('/Gelombang\s+(\d+)/i', $this->periode->nama_periode, $matches)) {
                $kodeGelombang = '-G' . $matches[1];
            }
        }

        $nomorUrut = str_pad($this->id, 3, '0', STR_PAD_LEFT);
        return 'PSB-' . $tahun . $kodeGelombang . '-' . $nomorUrut;
    }
}