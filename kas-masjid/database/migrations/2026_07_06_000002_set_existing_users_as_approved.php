<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Set all admin users as approved
        DB::table('users')
            ->where('role', 'admin')
            ->update(['status' => 'approved']);

        // Set all existing bendahara as approved (for backward compatibility)
        DB::table('users')
            ->where('role', 'bendahara')
            ->where('status', '!=', 'pending')
            ->update(['status' => 'approved']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse as we only set statuses
    }
};
