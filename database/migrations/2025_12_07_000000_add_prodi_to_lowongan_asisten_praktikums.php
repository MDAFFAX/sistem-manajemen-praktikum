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
        if (Schema::hasTable('lowongan_asisten_praktikums')) {
            Schema::table('lowongan_asisten_praktikums', function (Blueprint $table) {
                if (!Schema::hasColumn('lowongan_asisten_praktikums', 'prodi')) {
                    $table->string('prodi')->nullable()->after('mata_kuliah');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('lowongan_asisten_praktikums')) {
            Schema::table('lowongan_asisten_praktikums', function (Blueprint $table) {
                if (Schema::hasColumn('lowongan_asisten_praktikums', 'prodi')) {
                    $table->dropColumn('prodi');
                }
            });
        }
    }
};
