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
        Schema::create('elim_question_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_team');
            $table->uuid('id_question');
            $table->foreign('id_team')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('id_question')->references('id')->on('elim_questions')->onDelete('cascade');
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
