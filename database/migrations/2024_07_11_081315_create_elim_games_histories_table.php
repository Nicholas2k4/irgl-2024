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
        Schema::create('elim_games_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('game_id');
            $table->uuid('team_id');
            $table->integer('rotation');
            $table->foreign('game_id')->references('id')->on('elim_games');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
