<?php

namespace App\Models;

use App\Models\Public\Kontak;
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
     * Tentukan cast untuk atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tabel Kontak (Data yang dibuat oleh user ini)
     */
    public function kontakDibuat(): HasMany
    {
        return $this->hasMany(Kontak::class, 'created_by');
    }

    /**
     * Relasi ke tabel Kontak (Data yang diupdate oleh user ini)
     */
    public function kontakDiupdate(): HasMany
    {
        return $this->hasMany(Kontak::class, 'updated_by');
    }
}