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
        Schema::table('mycsd_maps', function (Blueprint $table) {
            // Add new columns
            $table->string('pertubuhan', 30)->after('poster');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mycsd_maps', function (Blueprint $table) {
            // Remove new columns
            $table->dropColumn('pertubuhan');
        });
    }
};
