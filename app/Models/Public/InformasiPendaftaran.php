<?php

namespace App\Models\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Public\InformasiPendaftaran;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InformasiPendaftaran extends Model
{
    protected $table = 'informasi_pendaftaran';
    protected $fillable = ['judul', 'deskripsi', 'created_by', 'updated_by'];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}