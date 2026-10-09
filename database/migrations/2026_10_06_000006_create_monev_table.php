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
            // UNIQUE menegakkan relasi 1:1 dengan kegiatan_statistik.
            $table->foreignId('id_kegiatan')->unique()->constrained('kegiatan_statistik')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun');
            $table->unsignedTinyInteger('bulan');
            $table->enum('status', ['belum_mulai', 'sedang_berjalan', 'tepat_waktu', 'terlambat'])->default('belum_mulai');
            $table->timestamps();

            $table->index('status');
            $table->index('tahun');
            $table->index('bulan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monev');
    }
};
