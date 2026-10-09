<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin_bps', 'kominfo', 'dinas', 'bappeda'])->default('dinas');
            // Nullable: Admin BPS, Kominfo, dan Bappeda tidak terikat ke dinas.
            // nullOnDelete: dinas dihapus, akunnya tetap ada.
            $table->foreignId('id_dinas')->nullable()->constrained('dinas')->nullOnDelete();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
