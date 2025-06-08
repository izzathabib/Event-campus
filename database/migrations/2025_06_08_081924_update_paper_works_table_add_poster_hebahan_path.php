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
            $table->string('poster_hebahan_path')->after('penaja');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paper_works', function (Blueprint $table) {
            if (Schema::hasColumn('paper_works', 'poster_hebahan_path')) {
                $table->dropColumn('poster_hebahan_path');
            }
        });
    }
};
