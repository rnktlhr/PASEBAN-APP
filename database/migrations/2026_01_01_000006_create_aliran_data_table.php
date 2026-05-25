<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aliran_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatan_statistik')->cascadeOnDelete();
            $table->string('nama_data');
            $table->unsignedSmallInteger('tahun');
            $table->enum('frekuensi', ['triwulanan', 'tahunan'])->default('tahunan');
            $table->boolean('sudah_tayang')->default(false);
            $table->date('tanggal_tayang')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aliran_data');
    }
};
