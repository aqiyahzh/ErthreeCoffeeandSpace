<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            // if table doesn't exist, skip - user should create reservations table first
            return;
        }

        // Add columns if they don't already exist
        Schema::table('reservations', function (Blueprint $table) {
            if (! Schema::hasColumn('reservations', 'duration')) {
                $table->integer('duration')->default(60)->after('time')->comment('duration in minutes');
            }

            if (! Schema::hasColumn('reservations', 'end_time')) {
                $table->time('end_time')->nullable()->after('duration');
            }

            if (! Schema::hasColumn('reservations', 'wa_message')) {
                $table->text('wa_message')->nullable()->after('end_time');
            }

            if (! Schema::hasColumn('reservations', 'wa_sent')) {
                $table->boolean('wa_sent')->default(false)->after('wa_message');
            }

            if (! Schema::hasColumn('reservations', 'status')) {
                $table->string('status')->default('pending')->after('wa_sent');
            }
        });
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

        Schema::table('reservations', function (Blueprint $table) {
            if (Schema::hasColumn('reservations', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('reservations', 'wa_sent')) {
                $table->dropColumn('wa_sent');
            }
            if (Schema::hasColumn('reservations', 'wa_message')) {
                $table->dropColumn('wa_message');
            }
            if (Schema::hasColumn('reservations', 'end_time')) {
                $table->dropColumn('end_time');
            }
            if (Schema::hasColumn('reservations', 'duration')) {
                $table->dropColumn('duration');
            }
        });
    }
};
