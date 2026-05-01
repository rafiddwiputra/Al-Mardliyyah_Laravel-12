<?php

namespace App\Models;

use App\Models\Public\Kontak;
use App\Models\Public\Galeri;
use App\Models\Public\ProgramPendidikan;
use App\Models\Public\SejarahPondok;
use App\Models\Public\PimpinanPondok;
use App\Models\Public\TentangPondok;
use App\Models\Public\AktivitasSantri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Contracts\Auth\MustVerifyEmail;

// Disesuaikan: phone diganti no_hp, lalu ditambahkan photo dan status
#[Fillable(['nama', 'email', 'password', 'role', 'no_hp', 'photo', 'status', 'email_verified_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kontakDibuat(): HasMany { return $this->hasMany(Kontak::class, 'created_by'); }
    public function galeriDibuat(): HasMany { return $this->hasMany(Galeri::class, 'created_by'); }
    
    // Disesuaikan: FK sekarang menggunakan users_id
    public function programDibuat(): HasMany { return $this->hasMany(ProgramPendidikan::class, 'users_id'); }
    
    public function sejarahDibuat(): HasMany { return $this->hasMany(SejarahPondok::class, 'created_by'); }
    public function pimpinanDibuat(): HasMany { return $this->hasMany(PimpinanPondok::class, 'created_by'); }
    public function tentangDibuat(): HasMany { return $this->hasMany(TentangPondok::class, 'created_by'); }
    public function aktivitasDibuat(): HasMany { return $this->hasMany(AktivitasSantri::class, 'created_by'); }
    
    public function kontakDiupdate(): HasMany { return $this->hasMany(Kontak::class, 'updated_by'); }
    public function galeriDiupdate(): HasMany { return $this->hasMany(Galeri::class, 'updated_by'); }
    
    // programDiupdate dihapus karena kolom updated_by di tabel program_pendidikan sudah dihapus
    
    public function sejarahDiupdate(): HasMany { return $this->hasMany(SejarahPondok::class, 'updated_by'); }
    public function pimpinanDiupdate(): HasMany { return $this->hasMany(PimpinanPondok::class, 'updated_by'); }
    public function tentangDiupdate(): HasMany { return $this->hasMany(TentangPondok::class, 'updated_by'); }
    public function aktivitasDiupdate(): HasMany { return $this->hasMany(AktivitasSantri::class, 'updated_by'); }
    
    // Disesuaikan: Relasi pendaftaran santri diaktifkan menggunakan users_id
    public function pendaftaranSantri() {
        return $this->hasOne(\App\Models\PendaftaranSantri::class, 'users_id');
    }
}