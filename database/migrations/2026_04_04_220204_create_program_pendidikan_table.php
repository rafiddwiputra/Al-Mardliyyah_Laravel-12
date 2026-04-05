<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_pendidikan', function (Blueprint $table) {
            $table->id();

            // Relasi ke Kategori Program
            $table->foreignId('kategori_id')
                  ->constrained('kategori_program')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->string('nama_program', 100); 
            $table->string('gambar', 255);
            $table->text('deskripsi');
            
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();

            $table->foreignId('updated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_pendidikan');
    }
};