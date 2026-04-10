<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_pondok', function (Blueprint $table) {
            $table->id();
            
            // Identitas Inti
            $table->string('nama_pondok', 50);
            $table->string('logo', 255);
            
            // Data Banner (Hero Section di Beranda)
            $table->string('banner_image', 255)->nullable(); 
            $table->text('tagline')->nullable(); 

            // Audit Trail (Audit S3)
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_pondok');
    }
};