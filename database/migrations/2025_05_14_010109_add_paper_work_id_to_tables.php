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
            $table->foreignId('paper_work_id')
                  ->after('user_id')
                  ->constrained('paper_works')
                  ->onDelete('cascade');
        });

        Schema::table('apply_to_organize_events', function (Blueprint $table) {
            $table->foreignId('paper_work_id')
                  ->after('user_id')
                  ->constrained('paper_works')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mycsd_maps', function (Blueprint $table) {
            $table->dropForeign(['paper_work_id']);
            $table->dropColumn('paper_work_id');
        });

        Schema::table('apply_to_organize_events', function (Blueprint $table) {
            $table->dropForeign(['paper_work_id']);
            $table->dropColumn('paper_work_id');
        });
    }
};
