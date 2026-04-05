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
            
            $table->string('judul', 100);
            $table->text('deskripsi');
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
        Schema::dropIfExists('informasi_pendaftaran');
    }
};