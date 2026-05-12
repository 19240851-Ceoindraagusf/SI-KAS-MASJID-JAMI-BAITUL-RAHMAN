<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('masjid_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_masjid')->default('Masjid Jami Baitul Rahman');
            $table->string('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('ketua_masjid')->nullable();
            $table->string('bendahara')->nullable();
            $table->string('logo_path')->nullable();
            $table->text('catatan_laporan')->nullable();
            $table->boolean('transparansi_publik')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masjid_settings');
    }
};
