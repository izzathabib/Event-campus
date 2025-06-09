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
            $table->string('klasifikasi_program', 100)->after('alamat_cuti');
            $table->string('bilangan_kumpulan_pengelola', 100)->after('klasifikasi_program');
            $table->string('bilangan_sasaran', 100)->after('bilangan_kumpulan_pengelola');
            $table->string('kutipan_dari_peserta', 100)->nullable()->after('bilangan_sasaran');
            $table->string('tujuan_kutipan_wang', 100)->nullable()->after('kutipan_dari_peserta');
            $table->json('tempat_kutipan')->nullable()->after('tujuan_kutipan_wang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apply_to_organize_events', function (Blueprint $table) {
            $table->dropColumn([
                'klasifikasi_program',
                'bilangan_kumpulan_pengelola',
                'bilangan_sasaran',
                'kutipan_dari_peserta',
                'tujuan_kutipan_wang',
                'tempat_kutipan'
            ]);
        });
    }
};
