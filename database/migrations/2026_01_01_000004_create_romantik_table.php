<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('romantik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatan_statistik')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun');
            $table->enum('status_dinas', ['belum_diajukan', 'sudah_diajukan', 'belum_diperbaiki', 'sudah_diperbaiki'])->default('belum_diajukan');
            $table->enum('status_kominfo', ['sedang_diperiksa', 'disetujui'])->default('sedang_diperiksa');
            $table->enum('status_bps', ['sedang_diperiksa', 'perlu_perbaikan', 'disetujui'])->default('sedang_diperiksa');
            $table->date('tanggal_pengajuan')->nullable();
            $table->date('tanggal_persetujuan')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('romantik');
    }
};
