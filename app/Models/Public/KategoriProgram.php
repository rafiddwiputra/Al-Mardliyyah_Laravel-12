<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriProgram extends Model
{
    protected $table = 'kategori_program';
    protected $fillable = ['nama_kategori'];

    public function programs(): HasMany
    {
        return $this->hasMany(ProgramPendidikan::class, 'kategori_id');
    }
}