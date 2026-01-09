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
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('wilayah');

            $table->string('kecamatan')->after('longitude');
            $table->string('kelurahan')->after('kecamatan');
            $table->text('alamat_lengkap')->after('kelurahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->string('wilayah');

            $table->dropColumn(['kecamatan', 'kelurahan', 'alamat_lengkap']);
         });
    }
};
