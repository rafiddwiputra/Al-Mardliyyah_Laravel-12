<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('periode_pendaftaran', function (Blueprint $table) {
            $table->text('jadwal_tambahan')->nullable()->after('biaya');
        });
    }

    public function down(): void
    {
        Schema::table('periode_pendaftaran', function (Blueprint $table) {
            $table->dropColumn('jadwal_tambahan');
        });
    }
};