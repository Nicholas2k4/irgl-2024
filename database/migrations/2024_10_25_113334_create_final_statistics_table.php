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
        Schema::create('final_statistics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('team_id');
            $table->dateTime('decode_time')->nullable();
            $table->integer('score')->default(0);
            $table->boolean('has_clue1')->default(0);
            $table->boolean('has_clue2')->default(0);
            $table->boolean('has_clue3')->default(0);
            $table->boolean('has_clue4')->default(0);
            $table->boolean('has_clue5')->default(0);
            $table->boolean('has_clue6')->default(0);
            $table->boolean('has_clue7')->default(0);
            $table->boolean('has_clue8')->default(0);
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_statistics');
    }
};
