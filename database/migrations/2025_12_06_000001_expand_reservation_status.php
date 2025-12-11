<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('reservations')) {
            return;
        }

        // Use a raw statement to adjust column type safely without requiring doctrine/dbal
        // This will set the `status` column to VARCHAR(20) with default 'pending'.
        try {
            DB::statement("ALTER TABLE `reservations` MODIFY `status` VARCHAR(20) NOT NULL DEFAULT 'pending'");
        } catch (\Throwable $e) {
            // ignore failures (e.g. permission) but surface in logs
            \Log::warning('Failed to ALTER reservations.status: '.$e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (! Schema::hasTable('reservations')) {
            return;
        }

        try {
            // best-effort revert to VARCHAR(10)
            DB::statement("ALTER TABLE `reservations` MODIFY `status` VARCHAR(10) NOT NULL DEFAULT 'pending'");
        } catch (\Throwable $e) {
            \Log::warning('Failed to revert reservations.status change: '.$e->getMessage());
        }
    }
};
