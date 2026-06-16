<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('monev', function (Blueprint $table) {
            $table->string('status_metadata')->nullable();
            $table->string('status_romantik')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('monev', function (Blueprint $table) {
            $table->dropColumn(['status_metadata', 'status_romantik']);
        });
    }
};
