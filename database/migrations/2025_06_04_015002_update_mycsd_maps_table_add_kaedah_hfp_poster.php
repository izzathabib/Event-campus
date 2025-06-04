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
            $table->string('kaedah', 20)->after('paper_work_id');
            $table->string('hfp', 10)->after('kaedah');
            $table->string('poster', 10)->after('hfp');

            // Drop old columns (example: drop 'old_column1' and 'old_column2')
            if (Schema::hasColumn('mycsd_maps', 'taj_prog')) {
                $table->dropColumn('taj_prog');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mycsd_maps', function (Blueprint $table) {
            // Remove new columns
            $table->dropColumn(['kaedah', 'hfp', 'poster']);

            // Add back dropped columns (adjust types as needed)
            $table->string('taj_prog')->nullable();
        });
    }
};
