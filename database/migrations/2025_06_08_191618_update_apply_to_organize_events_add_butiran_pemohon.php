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
        Schema::table('apply_to_organize_events', function (Blueprint $table) {
            $table->string('no_ic',14)->after('nama');
            $table->string('jawatan_borg_adkn_prog', 100)->after('no_ic');
            $table->string('no_matric', 20)->after('jawatan_borg_adkn_prog');
            $table->string('tel_bimbit', 20)->after('no_matric');
            $table->string('email_borg_adkn_prog', 255)->after('tel_bimbit');
            $table->string('alamat_penggal', 255)->nullable()->after('email_borg_adkn_prog');
            $table->string('alamat_cuti', 255)->nullable()->after('alamat_penggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_to_organize_events', function (Blueprint $table) {
            $table->dropColumn([
                'no_ic',
                'jawatan_borg_adkn_prog',
                'no_matric',
                'tel_bimbit',
                'email_borg_adkn_prog',
                'alamat_penggal',
                'alamat_cuti',
            ]);
        });
    }
};
