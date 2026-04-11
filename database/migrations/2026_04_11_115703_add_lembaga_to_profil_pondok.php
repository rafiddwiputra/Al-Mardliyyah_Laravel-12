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
        Schema::table('profil_pondok', function (Blueprint $table) {
            $table->text('deskripsi_lembaga')->nullable();
            $table->string('gambar_lembaga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_pondok', function (Blueprint $table) {
            $table->dropColumn(['deskripsi_lembaga', 'gambar_lembaga']);
        });
    }
};