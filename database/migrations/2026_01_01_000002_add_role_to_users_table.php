<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin_bps', 'kominfo', 'dinas', 'bappeda'])->default('dinas')->after('email');
            $table->foreignId('dinas_id')->nullable()->after('role')->constrained('dinas')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['dinas_id']);
            $table->dropColumn(['role', 'dinas_id']);
        });
    }
};
