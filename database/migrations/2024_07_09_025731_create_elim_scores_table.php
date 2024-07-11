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
        Schema::create('elim_scores', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_team');
            $table->unsignedBigInteger('id_game');
            $table->integer('score');
            $table->dateTime('time')->nullable();
            $table->foreign('id_team')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('id_game')->references('id')->on('elim_games')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('elim_scores');
    }
};
