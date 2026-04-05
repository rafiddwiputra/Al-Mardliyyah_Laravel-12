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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            
            $table->string('judul', 150); 
            $table->string('slug', 170)->unique(); 
            $table->string('gambar', 255)->nullable();
            $table->text('deskripsi'); 
            
            $table->date('tanggal_publish')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');

            // Bagian ini tadi sempat terpotong di kode kamu:
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
        Schema::dropIfExists('berita');
    }
};