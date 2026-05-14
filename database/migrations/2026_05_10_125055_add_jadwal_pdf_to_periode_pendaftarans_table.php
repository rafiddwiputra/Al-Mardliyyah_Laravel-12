<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Sesuaikan 'periode_pendaftaran' dengan nama tabel aslimu di database
        Schema::table('periode_pendaftaran', function (Blueprint $table) {
            $table->string('jadwal_seleksi_tanggal')->nullable()->after('jadwal_tambahan');
            $table->string('jadwal_seleksi_ruang')->nullable()->after('jadwal_seleksi_tanggal');
            $table->string('jadwal_seleksi_waktu')->nullable()->after('jadwal_seleksi_ruang');
            
            $table->string('jadwal_wawancara_tanggal')->nullable()->after('jadwal_seleksi_waktu');
            $table->string('jadwal_wawancara_ruang')->nullable()->after('jadwal_wawancara_tanggal');
            $table->string('jadwal_wawancara_waktu')->nullable()->after('jadwal_wawancara_ruang');
        });
    }

    public function down(): void
    {
        Schema::table('periode_pendaftaran', function (Blueprint $table) {
            $table->dropColumn([
                'jadwal_seleksi_tanggal',
                'jadwal_seleksi_ruang',
                'jadwal_seleksi_waktu',
                'jadwal_wawancara_tanggal',
                'jadwal_wawancara_ruang',
                'jadwal_wawancara_waktu',
            ]);
        });
    }
};