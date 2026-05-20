<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('judul', 100); 
            $table->string('gambar', 255)->nullable();
            $table->text('deskripsi')->nullable(); 
            $table->date('tanggal_publish')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft')->nullable();
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};