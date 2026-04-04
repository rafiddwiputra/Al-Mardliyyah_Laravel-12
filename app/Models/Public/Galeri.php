<?php

namespace App\Models\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = ['kategori_id', 'judul', 'gambar', 'created_by', 'updated_by'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriGaleri::class, 'kategori_id');
    }

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}