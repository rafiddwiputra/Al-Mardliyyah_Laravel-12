<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_pendaftaran', function (Blueprint $table) {
            $table->id(); 
            $table->string('judul', 25); 
            $table->text('deskripsi');
            $table->boolean('status')->default(1); 
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_pendaftaran');
    }
};