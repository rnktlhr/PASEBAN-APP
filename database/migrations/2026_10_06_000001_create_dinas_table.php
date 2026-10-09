<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dinas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('singkatan')->nullable();
            $table->string('slug')->unique();
            $table->string('instansi_code')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dinas');
    }
};
