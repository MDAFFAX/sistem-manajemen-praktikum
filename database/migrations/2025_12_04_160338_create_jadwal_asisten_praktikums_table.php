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
        Schema::create('jadwal_asisten_praktikums', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mata_kuliah', 20);
            $table->string('nim', 50);
            $table->string('hari', 20);
            $table->string('ruang', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_asisten_praktikums');
    }
};
