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
        Schema::dropIfExists('aliran_data');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('aliran_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatan_statistik')->cascadeOnDelete();
            $table->string('nama_data');
            $table->integer('tahun');
            $table->string('frekuensi')->nullable();
            $table->boolean('sudah_tayang')->default(false);
            $table->date('tanggal_tayang')->nullable();
            $table->timestamps();
        });
    }
};
