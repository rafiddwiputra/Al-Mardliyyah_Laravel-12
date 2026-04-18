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
            $table->id();
            
            $table->string('nama_ayah', 40);
            $table->string('nik_ayah', 16);
            $table->string('tempat_lahir_ayah', 30);
            $table->date('tanggal_lahir_ayah');
            $table->string('pekerjaan_ayah', 25);
            $table->enum('pendidikan_terakhir_ayah', [
                'sd/sederajat', 
                'smp/sltp/sederajat', 
                'sma/slta/sederajat', 
                'diploma3', 
                'strata1', 
                'strata2', 
                'strata3'
            ]);
            
            $table->string('nama_ibu', 35);
            $table->string('nik_ibu', 16);
            $table->string('tempat_lahir_ibu', 30);
            $table->date('tanggal_lahir_ibu');
            $table->string('pekerjaan_ibu', 25);
            $table->enum('pendidikan_terakhir_ibu', [
                'sd/sederajat', 
                'smp/sltp/sederajat', 
                'sma/slta/sederajat', 
                'diploma3', 
                'strata1', 
                'strata2', 
                'strata3'
            ]);
            
            $table->enum('penghasilan_ortu', [
                '<500 Ribu', 
                '1-2 Juta', 
                '3-5 Juta', 
                '>5 Juta' 
            ]); 
            $table->string('no_hp', 16);
            $table->string('alamat', 100);
            $table->string('kode_pos', 5);
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_ortu');
    }
};