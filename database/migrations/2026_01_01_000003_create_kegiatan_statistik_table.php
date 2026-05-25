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
            $table->foreignId('dinas_id')->constrained('dinas')->cascadeOnDelete();
            $table->string('nama');
            $table->enum('jenis', ['survei', 'pendataan_lengkap', 'kompromin']);
            $table->unsignedSmallInteger('tahun');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_statistik');
    }
};
