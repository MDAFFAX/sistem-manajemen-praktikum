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
        Schema::table('lowongan_asisten_praktikums', function (Blueprint $table) {
            $table->date('tanggal_awal_pendaftaran')->nullable()->after('tahun_ajaran');
            $table->date('tanggal_akhir_pendaftaran')->nullable()->after('tanggal_awal_pendaftaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongan_asisten_praktikums', function (Blueprint $table) {
            $table->dropColumn(['tanggal_awal_pendaftaran', 'tanggal_akhir_pendaftaran']);
        });
    }
};
