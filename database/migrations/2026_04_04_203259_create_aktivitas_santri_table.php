<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aktivitas_santri', function (Blueprint $table) {
            $table->id();
            
            $table->string('nama_aktivitas', 100);
            $table->string('gambar', 255)->nullable(); 
            $table->text('deskripsi')->nullable();

            // Cukup gunakan timestamps, tidak perlu created_by & updated_by 
            // agar konsisten dengan penyederhanaan tabel kontak sebelumnya.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_santri');
    }
};