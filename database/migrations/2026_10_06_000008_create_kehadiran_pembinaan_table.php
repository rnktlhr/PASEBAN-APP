<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel pivot N:M dinas <-> pembinaan (revisi Capstone 2).
        Schema::create('kehadiran_pembinaan', function (Blueprint $table) {
            $table->id();
            // cascadeOnDelete: data kehadiran tidak bermakna tanpa sesi atau dinasnya.
            $table->foreignId('id_pembinaan')->constrained('pembinaan')->cascadeOnDelete();
            $table->foreignId('id_dinas')->constrained('dinas')->cascadeOnDelete();
            $table->boolean('hadir')->default(false);
            $table->timestamps();

            // Mencegah satu dinas tercatat dua kali di sesi yang sama (mis. saat import Excel).
            $table->unique(['id_pembinaan', 'id_dinas']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kehadiran_pembinaan');
    }
};
