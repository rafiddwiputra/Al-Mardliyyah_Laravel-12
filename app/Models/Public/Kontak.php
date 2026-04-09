<?php

namespace App\Models\Public; 

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kontak extends Model
{
    protected $table = 'kontak';

    protected $fillable = [
        'tipe',
        'judul',
        'nilai',
        'link',
        'keterangan',
        'created_by',
        'updated_by'
    ];

    // Relasi ke tabel users untuk mengetahui siapa yang membuat data ini
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi ke tabel users untuk mengetahui siapa yang terakhir mengedit data ini
    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}