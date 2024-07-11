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
        //
        Schema::create('elim_statistics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_team');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->boolean('won_grand_prize')->default('0');
            $table->integer('highest_gp_streak')->default('0');
            $table->integer('highest_streak')->default('0');
            $table->integer('total_score')->default('0');
            $table->integer('total_game_finished')->default('0');
            $table->foreign('id_team')->references('id')->on('teams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('elim_statistics');
    }
};
