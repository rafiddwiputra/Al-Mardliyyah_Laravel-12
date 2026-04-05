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

#[Fillable(['nama', 'email', 'password', 'role', 'phone'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Tentukan cast untuk atribut agar password otomatis di-hash.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * ==========================================
     * RELASI AUDIT TRAIL (CREATED BY)
     * Mengetahui data apa saja yang dibuat oleh User ini
     * ==========================================
     */
    public function kontakDibuat(): HasMany { return $this->hasMany(Kontak::class, 'created_by'); }
    public function galeriDibuat(): HasMany { return $this->hasMany(Galeri::class, 'created_by'); }
    public function programDibuat(): HasMany { return $this->hasMany(ProgramPendidikan::class, 'created_by'); }
    public function sejarahDibuat(): HasMany { return $this->hasMany(SejarahPondok::class, 'created_by'); }
    public function pimpinanDibuat(): HasMany { return $this->hasMany(PimpinanPondok::class, 'created_by'); }
    public function tentangDibuat(): HasMany { return $this->hasMany(TentangPondok::class, 'created_by'); }
    public function aktivitasDibuat(): HasMany { return $this->hasMany(AktivitasSantri::class, 'created_by'); }

    /**
     * ==========================================
     * RELASI AUDIT TRAIL (UPDATED BY)
     * Mengetahui data apa saja yang diubah oleh User ini
     * ==========================================
     */
    public function kontakDiupdate(): HasMany { return $this->hasMany(Kontak::class, 'updated_by'); }
    public function galeriDiupdate(): HasMany { return $this->hasMany(Galeri::class, 'updated_by'); }
    public function programDiupdate(): HasMany { return $this->hasMany(ProgramPendidikan::class, 'updated_by'); }
    public function sejarahDiupdate(): HasMany { return $this->hasMany(SejarahPondok::class, 'updated_by'); }
    public function pimpinanDiupdate(): HasMany { return $this->hasMany(PimpinanPondok::class, 'updated_by'); }
    public function tentangDiupdate(): HasMany { return $this->hasMany(TentangPondok::class, 'updated_by'); }
    public function aktivitasDiupdate(): HasMany { return $this->hasMany(AktivitasSantri::class, 'updated_by'); }
}