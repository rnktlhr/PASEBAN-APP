<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembinaan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tanggal');
            $table->text('deskripsi')->nullable();
            $table->string('file_absensi')->nullable(); // path to uploaded CSV/XLSX
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembinaan');
    }
};
