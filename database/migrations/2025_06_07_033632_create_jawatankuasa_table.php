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
        Schema::create('jawatankuasa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paper_work_id')->constrained()->onDelete('cascade');
            $table->string('jawatan');
            $table->text('nama_pemegang_jawatan');
            $table->string('no_matrik_pemegang_jawatan')->nullable();
            $table->string('tahun_pemegang_jawatan')->nullable();
            $table->string('pusat_tanggungjawab');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawatankuasa');
    }
};
