<?php

namespace App\Models\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AktivitasSantri extends Model
{
    protected $table = 'aktivitas_santri';
    protected $fillable = ['nama_aktivitas', 'gambar', 'deskripsi', 'created_by', 'updated_by'];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}