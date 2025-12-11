<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            if (!Schema::hasColumn('menus', 'name')) {
                $table->string('name')->nullable()->after('category_id');
            }
            if (!Schema::hasColumn('menus', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('menus', 'price')) {
                $table->string('price')->nullable()->after('description');
            }
            if (!Schema::hasColumn('menus', 'image')) {
                $table->string('image')->nullable()->after('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            if (Schema::hasColumn('menus', 'image')) {
                $table->dropColumn('image');
            }
            if (Schema::hasColumn('menus', 'price')) {
                $table->dropColumn('price');
            }
            if (Schema::hasColumn('menus', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('menus', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
