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
        Schema::create('program_pendidikan', function (Blueprint $table) {
            $table->id();

            // FOREIGN KEY ke kategori_program
            $table->foreignId('kategori_id')
                  ->constrained('kategori_program')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->string('nama_program', 100)->nullable();
            $table->string('slug', 100)->unique();
            $table->string('gambar', 255)->nullable();
            $table->text('deskripsi')->nullable();

            $table->enum('status', ['aktif', 'nonaktif'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_pendidikan');
    }
};