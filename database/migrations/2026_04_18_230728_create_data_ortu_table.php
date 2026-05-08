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
        Schema::create('data_ortu', function (Blueprint $table) {
            // PERBAIKAN: Ubah menjadi integer autoIncrement agar sinkron dengan foreign key
            $table->integer('id')->autoIncrement();

            // Data Ayah
            $table->string('nama_ayah', 30);
            $table->string('nik_ayah', 16);
            $table->string('tempat_lahir_ayah', 30);
            $table->date('tanggal_lahir_ayah');
            $table->string('pekerjaan_ayah', 25);
            $table->enum('pendidikan_terakhir_ayah', [
                'SD/sederajat', 
                'SMP/SLTP/sederajat', 
                'SMA/SLTA/sederajat', 
                'Diploma III', 
                'Strata I', 
                'Strata II', 
                'Strata III'
            ]);

            // Data Ibu
            $table->string('nama_ibu', 30);
            $table->string('nik_ibu', 16);
            $table->string('tempat_lahir_ibu', 30);
            $table->date('tanggal_lahir_ibu');
            $table->string('pekerjaan_ibu', 25);
            $table->enum('pendidikan_terakhir_ibu', [
                'SD/sederajat', 
                'SMP/SLTP/sederajat', 
                'SMA/SLTA/sederajat', 
                'Diploma III', 
                'Strata I', 
                'Strata II', 
                'Strata III'
            ]);

            // Data Keluarga Umum
            $table->enum('penghasilan_ortu', [
                '<500 Ribu', 
                '1-2 Juta', 
                '3-5 Juta', 
                '>5 Juta'
            ]);
            $table->string('no_hp', 16);
            $table->string('alamat', 150);
            $table->string('kode_pos', 5);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ortu');
    }
};