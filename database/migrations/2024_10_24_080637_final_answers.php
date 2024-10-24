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
        Schema::create('final_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('final_questions', 'id', 'final_question_id');
            $table->uuid('team_id');
            $table->string('answer');
            $table->boolean('is_correct');
            $table->dateTime('incorrect_at')->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
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
