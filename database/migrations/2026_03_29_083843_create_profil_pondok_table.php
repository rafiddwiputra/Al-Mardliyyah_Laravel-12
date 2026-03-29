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

            $table->string('nama_pondok', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('no_telepon', 30)->nullable();
            $table->string('email', 100)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_pondok');
    }
};