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
            // UNIQUE menegakkan relasi 1:1 dengan romantik.
            $table->foreignId('id_romantik')->unique()->constrained('romantik')->cascadeOnDelete();
            $table->enum('jenis', ['kegiatan', 'variabel', 'indikator']);
            $table->unsignedSmallInteger('tahun');
            $table->enum('status_dinas', ['belum_menyusun', 'sudah_menyusun'])->default('belum_menyusun');
            $table->enum('status_kominfo', ['belum_diajukan', 'draft', 'submit', 'sudah_diperbaiki', 'disetujui'])->default('belum_diajukan');
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
        Schema::dropIfExists('metadata');
    }
};
