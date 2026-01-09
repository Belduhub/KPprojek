<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('warga'); // lurah / camat / warga
            }
            if (!Schema::hasColumn('users', 'wilayah')) {
                $table->string('wilayah')->nullable();    // nama kelurahan
            }
            if (!Schema::hasColumn('users', 'kecamatan')) {
                $table->string('kecamatan')->nullable();  // nama kecamatan
            }
            if (!Schema::hasColumn('users', 'must_change_password')) {
                $table->boolean('must_change_password')->default(true); // force change password
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'wilayah')) {
                $table->dropColumn('wilayah');
            }
            if (Schema::hasColumn('users', 'kecamatan')) {
                $table->dropColumn('kecamatan');
            }
            if (Schema::hasColumn('users', 'must_change_password')) {
                $table->dropColumn('must_change_password');
            }
        });
    }
};
