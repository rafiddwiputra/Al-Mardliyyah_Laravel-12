<?php

namespace App\Models\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TentangPondok extends Model
{
    protected $table = 'tentang_pondok';
    protected $fillable = ['judul', 'deskripsi', 'gambar', 'created_by', 'updated_by'];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}