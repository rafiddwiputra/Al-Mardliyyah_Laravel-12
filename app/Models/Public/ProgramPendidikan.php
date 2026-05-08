<?php

namespace App\Models\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramPendidikan extends Model
{
    protected $table = 'program_pendidikan';
    protected $fillable = [
        'users_id', 
        'nama_kategori', 
        'nama_program', 
        'deskripsi', 
        'status'
    ];

    public function creator(): BelongsTo 
    { 
        return $this->belongsTo(User::class, 'users_id'); 
    }

    public function pendaftar()
    {
        return $this->hasMany(\App\Models\PendaftaranSantri::class, 'program_id');
    }
}