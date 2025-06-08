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
        Schema::create('penceramahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paper_work_id')->constrained()->onDelete('cascade');
            $table->string('namaPenceramah')->nullable();
            $table->integer('umurPenceramah')->nullable();
            $table->text('alamatPenceramah')->nullable();
            $table->string('emailPenceramah')->nullable();
            $table->string('telefonPenceramah')->nullable();
            $table->string('media_sosialPenceramah')->nullable();
            $table->string('kerjayaPenceramah')->nullable();
            $table->string('bidangPenceramah')->nullable();
            $table->text('pendidikanPenceramah')->nullable();
            $table->string('photoPenceramahPath')->nullable(); // If you want to store photo path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penceramahs');
    }
};
