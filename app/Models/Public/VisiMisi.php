<?php

namespace App\Models\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisiMisi extends Model
{
    protected $table = 'visi_misi';
    protected $fillable = ['tipe', 'konten', 'urutan', 'created_by', 'updated_by'];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}