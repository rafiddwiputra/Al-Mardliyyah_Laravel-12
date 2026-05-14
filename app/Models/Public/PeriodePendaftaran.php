<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;

class PeriodePendaftaran extends Model
{
    // 1. Tentukan nama tabel yang spesifik
    protected $table = 'periode_pendaftaran';

    // 2. Beri tahu Laravel bahwa Primary Key-nya BUKAN 'id', melainkan 'id_periode'
    protected $primaryKey = 'id_periode';

    // 3. Daftarkan field apa saja yang boleh diisi (sesuai ERD terbaru)
   protected $fillable = [
        'nama_periode',
        'persyaratan',      
        'biaya',
        'jadwal_tambahan',        
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'jadwal_seleksi_tanggal',
        'jadwal_seleksi_ruang',
        'jadwal_seleksi_waktu',
        'jadwal_wawancara_tanggal',
        'jadwal_wawancara_ruang',
        'jadwal_wawancara_waktu'
    ];

    // 4. Buat relasi ke tabel Pendaftaran Santri (One-to-Many)
    // Satu periode bisa memiliki banyak pendaftar
    public function pendaftaranSantri()
    {
        return $this->hasMany(PendaftaranSantri::class, 'id_periode', 'id_periode');
    }
}