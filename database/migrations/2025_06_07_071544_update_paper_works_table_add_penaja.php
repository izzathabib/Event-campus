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
        Schema::table('paper_works', function (Blueprint $table) {
            $table->string('penaja', 200)->nullable()->after('collaboration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('paper_works', 'penaja')) {
            Schema::table('paper_works', function (Blueprint $table) {
                $table->dropColumn('penaja');
            });
        }
    }
};
