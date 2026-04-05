<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_program', function (Blueprint $table) {
            $table->id();

            $table->enum('nama_kategori', [
                'formal',
                'nonformal',
                'unggulan'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_program');
    }
};