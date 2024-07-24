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
        Schema::create('reschedule', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_kelompok');
            $table->foreign('id_kelompok')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('id_jadwal_awal');
            $table->foreign('id_jadwal_awal')->references('id')->on('jadwal')->onDelete('cascade');
            $table->unsignedBigInteger('id_jadwal_resched');
            $table->foreign('id_jadwal_resched')->references('id')->on('jadwal')->onDelete('cascade');
            $table->string('alasan');
            $table->string('bukti');
            $table->boolean('approval');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reschedule');
    }
};
