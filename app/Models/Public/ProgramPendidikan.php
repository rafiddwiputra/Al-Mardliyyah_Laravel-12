<?php

namespace App\Models\Public;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramPendidikan extends Model
{
    protected $table = 'program_pendidikan';
    protected $fillable = ['kategori_id', 'nama_program', 'gambar', 'deskripsi', 'status', 'created_by', 'updated_by'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriProgram::class, 'kategori_id');
    }

    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}