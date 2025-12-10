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
        Schema::create('asisten_praktikums', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 50);
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->string('status', 20)->default('Nonaktif'); // Aktif / Nonaktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asisten_praktikums');
    }
};







