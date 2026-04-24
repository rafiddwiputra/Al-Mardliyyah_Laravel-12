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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); 
            
            // Sesuai dengan rancangan di Workbench (Panjang karakter presisi)
            $table->string('nama', 30); 
            $table->string('email', 30)->unique();
            $table->string('password', 60);
            $table->string('no_hp', 12);
            $table->enum('role', ['admin', 'calon_santri', 'pimpinan']);
            
            // Field photo dibuat nullable karena tidak dicentang NN di database
            $table->string('photo', 255)->nullable();
            
            // Status dengan default aktif
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            // Bawaan Laravel (Dipertahankan untuk fitur autentikasi standar)
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps(); // Men-generate created_at & updated_at
        });

        // Tabel bawaan Laravel untuk fitur Lupa Password
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabel bawaan Laravel untuk manajemen Session di Database
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Urutan drop harus dari bawah ke atas menghindari error relasi
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};