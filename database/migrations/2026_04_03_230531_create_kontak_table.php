<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();

            $table->string('tipe', 50);
            $table->string('judul', 100);
            $table->text('nilai');
            $table->string('link', 255)->nullable();
            $table->string('keterangan', 100)->nullable();
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
            $table->index('tipe');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak');
    }
};