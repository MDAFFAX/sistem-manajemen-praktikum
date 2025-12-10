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
        Schema::table('jadwal_asisten_praktikums', function (Blueprint $table) {
            if (!Schema::hasColumn('jadwal_asisten_praktikums', 'jam')) {
                $table->string('jam', 20)->after('hari');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_asisten_praktikums', function (Blueprint $table) {
            if (Schema::hasColumn('jadwal_asisten_praktikums', 'jam')) {
                $table->dropColumn('jam');
            }
        });
    }
};




