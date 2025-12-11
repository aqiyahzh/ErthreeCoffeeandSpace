<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();

            // tipe ruangan: vip, reguler, dll
            $table->string('room_type')->default('regular');

            // tanggal dan waktu
            $table->date('date');
            $table->time('time');

            // durasi (menit)
            $table->integer('duration')->default(60);

            // jam berakhir (boleh null)
            $table->time('end_time')->nullable();

            // untuk WhatsApp automation
            $table->text('wa_message')->nullable();
            $table->boolean('wa_sent')->default(false);

            // jumlah orang & catatan tambahan
            $table->text('person_detail')->nullable();

            // status reservasi
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
