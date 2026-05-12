<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kas_masuks', function (Blueprint $table) {
            $table->string('kode_transaksi', 30)->nullable()->unique()->after('id');
        });

        Schema::table('kas_keluars', function (Blueprint $table) {
            $table->string('kode_transaksi', 30)->nullable()->unique()->after('id');
            $table->string('bukti_path')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('kas_masuks', function (Blueprint $table) {
            $table->dropUnique(['kode_transaksi']);
            $table->dropColumn('kode_transaksi');
        });

        Schema::table('kas_keluars', function (Blueprint $table) {
            $table->dropUnique(['kode_transaksi']);
            $table->dropColumn(['kode_transaksi', 'bukti_path']);
        });
    }
};
