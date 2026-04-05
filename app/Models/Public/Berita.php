<?php

namespace App\Models\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = [
        'judul', 'slug', 'gambar', 'deskripsi', 
        'tanggal_publish', 'status', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}