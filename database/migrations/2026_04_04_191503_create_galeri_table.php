<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('gambar', 255);
            $table->string('judul', 100);
            $table->enum('kategori', [
                'Kegiatan Pembelajaran Santri', 
                'Kegiatan Ibadah Santri', 
                'Ekstrakulikuler', 
                'Event', 
                'Kegiatan Santri', 
                'Prestasi'
            ]);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};