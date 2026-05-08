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
        Schema::create('periode_pendaftaran', function (Blueprint $table) {
            $table->integer('id_periode')->autoIncrement();
            $table->string('nama_periode', 50);
            
            $table->text('persyaratan')->nullable(); 
            $table->text('biaya')->nullable();       
            
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
           $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        if (Schema::hasTable('pendaftaran_santri')) {
            Schema::table('pendaftaran_santri', function (Blueprint $table) {
                if (!Schema::hasColumn('pendaftaran_santri', 'id_periode')) {
                    $table->integer('id_periode')->after('program_id')->nullable();
                    $table->foreign('id_periode')
                          ->references('id_periode')
                          ->on('periode_pendaftaran')
                          ->onDelete('cascade');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pendaftaran_santri', 'id_periode')) {
            Schema::table('pendaftaran_santri', function (Blueprint $table) {
                $table->dropForeign(['id_periode']);
                $table->dropColumn('id_periode');
            });
        }
        
        Schema::dropIfExists('periode_pendaftaran');
    }
};