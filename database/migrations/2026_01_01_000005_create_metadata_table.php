<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metadata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatan_statistik')->cascadeOnDelete();
            $table->enum('jenis', ['kegiatan', 'variabel', 'indikator']);
            $table->unsignedSmallInteger('tahun');
            $table->enum('status_kominfo', ['belum_diajukan', 'draft', 'submit', 'sudah_diperbaiki', 'disetujui'])->default('belum_diajukan');
            $table->enum('status_bps', ['sedang_diperiksa', 'perlu_perbaikan', 'disetujui'])->default('sedang_diperiksa');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metadata');
    }
};
