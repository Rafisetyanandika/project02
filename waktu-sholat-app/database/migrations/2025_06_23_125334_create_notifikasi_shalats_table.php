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
    Schema::create('notifikasi_shalats', function (Blueprint $table) {
        $table->id();
        $table->string('kota');
        $table->string('waktu_shalat'); // Subuh, Dzuhur, dst
        $table->time('waktu_notifikasi'); // misalnya 04:30
        $table->string('pesan'); // misalnya: "Jangan lupa Shalat Subuh 🌅"
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi_shalats');
    }
};
