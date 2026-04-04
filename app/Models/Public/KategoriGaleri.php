<?php

namespace App\Models\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KategoriGaleri extends Model
{
    protected $table = 'kategori_galeri';
    protected $fillable = ['nama_kategori', 'slug', 'created_by', 'updated_by'];

    public function galeris(): HasMany
    {
        return $this->hasMany(Galeri::class, 'kategori_id');
    }

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}