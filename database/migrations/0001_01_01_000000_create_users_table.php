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
            $table->integer('id')->autoIncrement(); 
            $table->string('nama', 50); 
            $table->string('email', 35)->unique();
            $table->string('password', 60);
            $table->string('no_hp', 16);
            $table->enum('role', ['admin', 'calon_santri', 'pimpinan']);
            $table->string('foto', 255)->nullable();
            $table->enum('status_user', ['aktif', 'nonaktif'])->default('aktif');

            // 5. Bawaan Laravel (WAJIB DITAMBAHKAN JUGA KE ERD WORKBENCH)
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken(); 
            $table->timestamps(); 
        });

        // Tabel bawaan Laravel untuk fitur Lupa Password
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('user_id')->nullable()->index(); 
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
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};