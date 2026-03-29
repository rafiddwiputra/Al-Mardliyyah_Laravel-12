<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tentang_pondok', function (Blueprint $table) {
            $table->id();

            $table->string('judul', 150)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tentang_pondok');
    }
};