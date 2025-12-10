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
        Schema::create('lowongan_asisten_praktikums', function (Blueprint $table) {
            $table->id();
            $table->string('mata_kuliah');
            $table->string('tahun_ajaran', 20);
            $table->unsignedInteger('kuota');
            $table->string('status', 20)->default('Nonaktif'); // Aktif atau Nonaktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_asisten_praktikums');
    }
};
