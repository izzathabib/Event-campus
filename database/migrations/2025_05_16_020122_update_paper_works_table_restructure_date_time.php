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
            // Add new columns
            $table->date('start_date')->after('impak');
            $table->time('start_time')->after('start_date');
            $table->date('end_date')->after('start_time');
            $table->time('end_time')->after('end_date');
            
            // Drop old columns if they exist
            if (Schema::hasColumn('paper_works', 'tarikh')) {
                $table->dropColumn('tarikh');
            }
            if (Schema::hasColumn('paper_works', 'masa')) {
                $table->dropColumn('masa');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paper_works', function (Blueprint $table) {
            // Recreate old columns
            $table->date('tarikh');
            $table->time('masa');
            
            // Drop new columns
            $table->dropColumn([
                'start_date',
                'start_time',
                'end_date',
                'end_time'
            ]);
        });
    }
};
