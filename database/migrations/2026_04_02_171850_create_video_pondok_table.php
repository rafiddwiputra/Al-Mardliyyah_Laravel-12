<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('video_pondok', function (Blueprint $table) {
            $table->id();

            $table->string('judul', 150);
            $table->text('deskripsi');

            $table->string('thumbnail')->nullable(); 
            $table->string('link_yt'); 

            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_pondok');
    }
};
