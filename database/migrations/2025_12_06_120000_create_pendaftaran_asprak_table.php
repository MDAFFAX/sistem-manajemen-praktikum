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
        Schema::create('pendaftaran_asprak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lowongan_id');
            $table->string('nim', 30);
            $table->string('nama_lengkap');
            $table->string('kelas')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->string('nomor_hp', 30)->nullable();
            $table->string('cv_path')->nullable();
            $table->string('transkrip_path')->nullable();
            $table->string('status', 20)->default('Pending');
            $table->timestamps();

            $table->foreign('lowongan_id')->references('id')->on('lowongan_asisten_praktikums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_asprak');
    }
};
