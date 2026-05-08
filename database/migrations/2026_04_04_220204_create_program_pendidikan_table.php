<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_pendidikan', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('users_id'); 
            
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            
            $table->enum('nama_kategori', ['lembaga pendidikan', 'program pendidikan']);
            $table->string('nama_program', 40); 
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