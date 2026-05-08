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
        Schema::create('pendaftaran_santri', function (Blueprint $table) {
            // Ubah ID utama menjadi INT biasa agar seragam dengan ERD
            $table->integer('id')->autoIncrement();

            // 1. Foreign Key ke tabel users
            $table->integer('users_id');
            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('restrict');

            // 2. Foreign Key ke tabel data_ortu
            $table->integer('data_ortu_id');
            $table->foreign('data_ortu_id')
                  ->references('id')->on('data_ortu')
                  ->onUpdate('cascade')->onDelete('restrict');
                  
            // 3. Foreign Key ke tabel program_pendidikan
            $table->integer('program_id');
            $table->foreign('program_id')
                  ->references('id')->on('program_pendidikan')
                  ->onUpdate('cascade')->onDelete('restrict');

            $table->string('nama_lengkap', 50);
            $table->string('nisn', 10)->nullable(); 
            $table->string('nik', 16)->unique(); 
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->string('nomor_kk', 16);
            $table->enum('jenis_kelamin', ['Putra', 'Putri']);
            $table->string('sekolah_asal', 25);
            $table->enum('jenjang', ['SMP (Khusus Putri)', 'MTs (Khusus Putra)', 'MA (Putra/Putri)']);
            $table->string('sumber_informasi', 50);
            $table->string('foto_santri', 255);
            $table->string('akta_kelahiran', 255);
            $table->string('kartu_keluarga', 255);
            $table->string('ktp_ayah', 255);
            $table->string('ktp_ibu', 255);
            $table->string('sertifikat', 255)->nullable(); 
            $table->enum('ukuran_baju_putra', ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'])->nullable();
            $table->enum('ukuran_celana_putra', ['27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38'])->nullable();       
            $table->enum('ukuran_baju_putri', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'XXXXL'])->nullable();
            $table->enum('ukuran_rok_putri', ['33', '34', '35', '36', '37', '38', '39', '40'])->nullable();
            $table->enum('status', ['Diproses', 'Diterima', 'Ditolak'])->default('Diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_santri');
    }
};