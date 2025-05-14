<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('paper_works', function (Blueprint $table) {
      $table->date('tarikh')->after('impak')->nullable();
      $table->time('masa')->after('tarikh')->nullable();
      $table->string('lokasi')->after('masa')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('paper_works', function (Blueprint $table) {
      $table->dropColumn(['tarikh', 'masa', 'lokasi']);
    });
  }
};
