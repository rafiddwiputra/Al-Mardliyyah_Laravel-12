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
            $table->foreignId('users_id')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
            $table->enum('kategori', ['lembaga pendidikan', 'program pendidikan']);
            $table->string('nama_program', 30); 
            $table->text('deskripsi');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_pendidikan');
    }
};