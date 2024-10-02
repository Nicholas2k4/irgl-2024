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
        Schema::table('teams', function (Blueprint $table) {
            $table->uuid('curr_question_id')->after('curr_game_rotation')->nullable();
            $table->foreign('curr_question_id')->references('id')->on('elim_questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            
            $table->dropForeign(['curr_question_id']);
            $table->dropColumn('curr_question_id');
        });
    }
};
