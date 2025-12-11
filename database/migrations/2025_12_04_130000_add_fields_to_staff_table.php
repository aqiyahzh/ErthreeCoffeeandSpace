<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('staff')) {
            Schema::table('staff', function (Blueprint $table) {
                if (!Schema::hasColumn('staff', 'name')) {
                    $table->string('name')->after('id')->nullable();
                }
                if (!Schema::hasColumn('staff', 'position')) {
                    $table->string('position')->nullable()->after('name');
                }
                if (!Schema::hasColumn('staff', 'photo')) {
                    $table->string('photo')->nullable()->after('position');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('staff')) {
            Schema::table('staff', function (Blueprint $table) {
                if (Schema::hasColumn('staff', 'photo')) {
                    $table->dropColumn('photo');
                }
                if (Schema::hasColumn('staff', 'position')) {
                    $table->dropColumn('position');
                }
                if (Schema::hasColumn('staff', 'name')) {
                    $table->dropColumn('name');
                }
            });
        }
    }
};
