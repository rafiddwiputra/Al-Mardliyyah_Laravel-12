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
        Schema::create('tentang_pondok', function (Blueprint $table) {
            $table->id();
            
            $table->string('judul', 100); 
            $table->text('deskripsi'); // Diubah dari VARCHAR(45) ke TEXT agar muat banyak
            $table->string('gambar', 255)->nullable(); // Diubah ke 255 agar path file aman

            // Audit Trail (Seragam dengan tabel lainnya untuk keamanan data)
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tentang_pondok');
    }
};