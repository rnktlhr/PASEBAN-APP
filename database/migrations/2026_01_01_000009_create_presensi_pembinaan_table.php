<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensi_pembinaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembinaan_id')->constrained('pembinaan')->cascadeOnDelete();
            $table->foreignId('dinas_id')->constrained('dinas')->cascadeOnDelete();
            $table->boolean('hadir')->default(false);
            $table->timestamps();

            $table->unique(['pembinaan_id', 'dinas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensi_pembinaan');
    }
};
