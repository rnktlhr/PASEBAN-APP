<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_pendampingan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal');
            // Varchar (bukan enum) supaya admin bisa menambah kategori baru selain pendampingan/pembinaan.
            $table->string('kategori');
            $table->string('gambar')->nullable();
            $table->text('ringkasan')->nullable();
            $table->text('narasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_pendampingan');
    }
};
