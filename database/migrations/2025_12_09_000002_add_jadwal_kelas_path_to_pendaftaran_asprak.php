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
        if (Schema::hasTable('pendaftaran_asprak')) {
            Schema::table('pendaftaran_asprak', function (Blueprint $table) {
                if (!Schema::hasColumn('pendaftaran_asprak', 'jadwal_kelas_path')) {
                    $table->string('jadwal_kelas_path')->nullable()->after('transkrip_path');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pendaftaran_asprak')) {
            Schema::table('pendaftaran_asprak', function (Blueprint $table) {
                if (Schema::hasColumn('pendaftaran_asprak', 'jadwal_kelas_path')) {
                    $table->dropColumn('jadwal_kelas_path');
                }
            });
        }
    }
};
