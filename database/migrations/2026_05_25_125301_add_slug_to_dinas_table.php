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
        Schema::table('dinas', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('singkatan');
        });

        // Update existing data
        $dinas = \Illuminate\Support\Facades\DB::table('dinas')->get();
        foreach ($dinas as $d) {
            \Illuminate\Support\Facades\DB::table('dinas')
                ->where('id', $d->id)
                ->update(['slug' => \Illuminate\Support\Str::slug($d->singkatan)]);
        }

        // Make it non-nullable and unique
        Schema::table('dinas', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dinas', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
