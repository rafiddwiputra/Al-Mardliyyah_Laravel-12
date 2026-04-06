<?php

namespace App\Models; // Namespace sudah dirapikan ke folder utama Models

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Berita extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'berita';

    // Gabungan semua kolom yang boleh diisi dari Admin & Public
    protected $fillable = [
        'judul', 
        'slug', 
        'gambar', 
        'deskripsi', 
        'status', 
        'tanggal_publish', 
        'created_by', 
        'updated_by'
    ];

    // Mengubah format kolom menjadi objek tanggal (Carbon) otomatis
    protected $casts = [
        'tanggal_publish' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi: Berita ini dibuat oleh siapa?
     * Memungkinkan kamu memanggil $berita->creator->name di tampilan
     */
    public function creator(): BelongsTo 
    { 
        return $this->belongsTo(User::class, 'created_by'); 
    }
}