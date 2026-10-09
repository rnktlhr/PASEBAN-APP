<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_statistik', function (Blueprint $table) {
            $table->id();
            // restrictOnDelete: dinas yang masih punya kegiatan tidak bisa dihapus,
            // supaya jejak audit kegiatan (yang memakai soft delete) tidak hilang permanen.
            $table->foreignId('id_dinas')->constrained('dinas')->restrictOnDelete();
            $table->string('nama');
            $table->enum('jenis', ['survei', 'pendataan_lengkap', 'kompromin']);
            $table->unsignedSmallInteger('tahun');
            $table->timestamps();
            $table->softDeletes();

            // id_dinas sudah otomatis ter-index oleh FK.
            $table->index('jenis');
            $table->index('tahun');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_statistik');
    }
};
