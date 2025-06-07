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
        Schema::create('belanjawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paper_work_id')->constrained()->onDelete('cascade');
            $table->string('pendapatan')->nullable();
            $table->integer('unit_pendapatan')->nullable();
            $table->decimal('rm_pendapatan', 10, 2)->nullable();
            $table->string('perbelanjaan')->nullable();
            $table->integer('unit_perbelanjaan')->nullable();
            $table->decimal('rm_perbelanjaan', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belanjawans');
    }
};
