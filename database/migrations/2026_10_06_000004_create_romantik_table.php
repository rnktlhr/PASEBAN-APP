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
            // UNIQUE menegakkan relasi 1:1 dengan kegiatan_statistik.
            // cascadeOnDelete hanya terpicu saat kegiatan dihapus permanen; soft delete tidak memicu cascade.
            $table->foreignId('id_kegiatan')->unique()->constrained('kegiatan_statistik')->cascadeOnDelete();
            $table->unsignedSmallInteger('tahun');
            $table->enum('status_dinas', ['belum_diajukan', 'sudah_diajukan', 'belum_diperbaiki', 'sudah_diperbaiki'])->default('belum_diajukan');
            $table->enum('status_kominfo', ['sedang_diperiksa', 'disetujui'])->default('sedang_diperiksa');
            $table->enum('status_bps', ['sedang_diperiksa', 'perlu_perbaikan', 'disetujui'])->default('sedang_diperiksa');
            $table->timestamps();
            $table->softDeletes();

            $table->index('status_dinas');
            $table->index('status_kominfo');
            $table->index('status_bps');
            $table->index('tahun');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('romantik');
    }
};
