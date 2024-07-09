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
        Schema::create('teams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama')->unique();
            $table->string('password');
            $table->string('link_bukti_tf');
            $table->boolean('is_validated')->default(false);
            $table->unsignedBigInteger('id_jadwal')->nullable();
            $table->foreign('id_jadwal')->references('id')->on('jadwal')->onDelete('set null');
            $table->string('alasan_resched')->nullable()->default(null);
            $table->string('link_bukti_resched')->nullable()->default(null);
            $table->boolean('can_spin_roulette')->nullable();
            $table->integer('game_id_allowed_play')->nullable();
            $table->string('game_pass')->nullable();
            $table->string('curr_streak')->default('0');
            $table->string('curr_gp_streak')->default('0');
            $table->string('curr_game_rotation')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
