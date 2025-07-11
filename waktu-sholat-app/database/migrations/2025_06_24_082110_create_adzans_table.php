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
        Schema::create('adzans', function (Blueprint $table) {
            $table->id(); // ID auto increment
            $table->string('nama'); // Nama adzan, contoh: Adzan Subuh
            $table->string('audio_path'); // Path atau lokasi file audio mp3
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adzans');
    }
};
