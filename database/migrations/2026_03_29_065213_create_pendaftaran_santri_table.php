<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_santri', function (Blueprint $table) {
            $table->id();

            // FK ke users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            // FK ke program_pendidikan (nullable)
            $table->foreignId('program_id')
                  ->nullable()
                  ->constrained('program_pendidikan')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();

            $table->string('kode_pendaftaran', 20)->unique()->nullable();

            // DATA SANTRI
            $table->string('nama_lengkap', 100);
            $table->string('nisn', 20)->nullable();
            $table->string('nik', 20)->nullable();

            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nomor_kk', 20)->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();

            $table->string('sekolah_asal', 100)->nullable();
            $table->string('sumber_informasi', 100)->nullable();

            // DATA AYAH
            $table->string('nama_ayah', 100)->nullable();
            $table->string('nik_ayah', 20)->nullable();
            $table->string('tempat_lahir_ayah', 50)->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('pekerjaan_ayah', 100)->nullable();
            $table->string('pendidikan_ayah', 50)->nullable();

            // DATA IBU
            $table->string('nama_ibu', 100)->nullable();
            $table->string('nik_ibu', 20)->nullable();
            $table->string('tempat_lahir_ibu', 50)->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('pekerjaan_ibu', 100)->nullable();
            $table->string('pendidikan_ibu', 50)->nullable();

            $table->string('penghasilan_ortu', 50)->nullable();

            // ALAMAT
            $table->text('alamat')->nullable();
            $table->string('kode_pos', 10)->nullable();

            // FILE
            $table->string('foto_santri')->nullable();
            $table->string('akta_kelahiran')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('ktp_ayah')->nullable();
            $table->string('ktp_ibu')->nullable();
            $table->string('sertifikat')->nullable();

            $table->text('ukuran_seragam')->nullable();

            // STATUS
            $table->enum('status', ['diproses', 'diterima', 'ditolak'])
                  ->default('diproses');

            $table->date('tanggal_daftar')->nullable();
            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_santri');
    }
};