<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    protected $table = 'galeri';
    
    protected $fillable = [
        'gambar',
        'judul',
        'kategori'
    ];

    public function creator(): BelongsTo 
    { 
        return $this->belongsTo(User::class, 'created_by'); 
    }
}