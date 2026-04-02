<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sejarah_pondok', function (Blueprint $table) {
            $table->id();

            // Kolom Tahun (Misal: 1985)
            $table->string('tahun', 10)->nullable(); 
            
            // Kolom Judul (Misal: Pendirian Pondok) - TAMBAHAN
            $table->string('judul', 255)->nullable(); 
            
            // Kolom Gambar (Path ke folder public/images)
            $table->string('gambar', 255)->nullable(); 
            
            // Deskripsi Singkat (Untuk di halaman profil/timeline)
            $table->text('deskripsi_singkat')->nullable();

            // Konten Detail (Untuk narasi panjang di halaman detail)
            // Kita gunakan JSON agar bisa menampung banyak paragraf dalam satu kolom
            $table->json('konten_detail')->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sejarah_pondok');
    }
};