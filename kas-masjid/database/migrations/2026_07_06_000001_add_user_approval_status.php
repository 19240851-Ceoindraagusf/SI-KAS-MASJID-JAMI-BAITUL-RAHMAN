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
        Schema::table('users', function (Blueprint $table) {
            // Tambah kolom status untuk menandai apakah user sudah disetujui admin
            // 'pending' = menunggu persetujuan admin
            // 'approved' = sudah disetujui admin
            $table->enum('status', ['pending', 'approved'])->default('approved')->after('role');
            
            // Tambah kolom untuk mencatat kapan user disetujui
            $table->timestamp('approved_at')->nullable()->after('status');
            
            // Tambah kolom untuk mencatat siapa yang menyetujui
            $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
            
            // Foreign key untuk approved_by
            $table->foreign('approved_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['status', 'approved_at', 'approved_by']);
        });
    }
};
