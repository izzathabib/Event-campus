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
            $table->json('holistic')->nullable()->after('pertubuhan');
            $table->json('entrepreneurial')->nullable()->after('holistic');
            $table->json('balanced')->nullable()->after('entrepreneurial');
            $table->json('articulate')->nullable()->after('balanced');
            $table->json('thinking')->nullable()->after('articulate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mycsd_maps', function (Blueprint $table) {
            $table->dropColumn([
                'holistic', 
                'entrepreneurial', 
                'balanced', 
                'articulate', 
                'thinking',
            ]);
        });
    }
};
