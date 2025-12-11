<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('menus') && Schema::hasColumn('menus','title')) {
            try {
                DB::statement("ALTER TABLE `menus` MODIFY `title` VARCHAR(255) NULL;");
            } catch (\Exception $e) {
                // swallow - if it's already nullable or DB doesn't support MODIFY syntax
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('menus') && Schema::hasColumn('menus','title')) {
            try {
                DB::statement("ALTER TABLE `menus` MODIFY `title` VARCHAR(255) NOT NULL;");
            } catch (\Exception $e) {
                // swallow
            }
        }
    }
};
