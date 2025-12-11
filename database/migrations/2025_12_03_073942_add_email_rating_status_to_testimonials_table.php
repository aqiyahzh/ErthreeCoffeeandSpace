<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'email')) {
                $table->string('email')->nullable()->after('name');
            }
            if (!Schema::hasColumn('testimonials', 'rating')) {
                $table->tinyInteger('rating')->nullable()->after('email');
            }
            if (!Schema::hasColumn('testimonials', 'status')) {
                $table->string('status')->default('pending')->after('content'); // pending / approved / rejected
            }
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            if (Schema::hasColumn('testimonials', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('testimonials', 'rating')) {
                $table->dropColumn('rating');
            }
            if (Schema::hasColumn('testimonials', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
