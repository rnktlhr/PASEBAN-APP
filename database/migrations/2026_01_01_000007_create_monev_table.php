<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monev', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatan_statistik')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun');
            $table->unsignedTinyInteger('bulan_rencana_mulai'); // 1-12
            $table->unsignedTinyInteger('bulan_rencana_selesai'); // 1-12
            $table->unsignedTinyInteger('bulan_realisasi_mulai')->nullable();
            $table->unsignedTinyInteger('bulan_realisasi_selesai')->nullable();
            $table->enum('status', ['belum_mulai', 'sedang_berjalan', 'tepat_waktu', 'terlambat'])->default('belum_mulai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monev');
    }
};
