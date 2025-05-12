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
            $table->text('peng_kump_sasar')->after('tajuk_kk'); // Add after 'tajuk_kk'
            $table->text('obj')->after('peng_kump_sasar'); // Add after 'peng_kump_sasar'
            $table->text('impak')->after('obj'); // Add after 'obj'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paper_works', function (Blueprint $table) {
            $table->dropColumn(['peng_kump_sasar', 'obj', 'impak']);
        });
    }
};
