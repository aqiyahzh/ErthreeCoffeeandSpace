<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('contact', function (Blueprint $table) {
        $table->id();

        // Title di Page Header
        $table->string('title')->nullable();

        // Deskripsi pembuka
        $table->text('description')->nullable();

        // Jam operasional
        $table->string('weekday_hours')->nullable();
        $table->string('weekend_hours')->nullable();

        // Sosmed & kontak
        $table->string('instagram')->nullable();
        $table->string('whatsapp')->nullable();
        $table->string('email')->nullable();

        // Google Maps Embed URL
        $table->longText('map_url')->nullable();

        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('contact');
}

};
