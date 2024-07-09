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
        Schema::create('elim_questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('question');
            $table->string('choice_1');
            $table->string('choice_2');
            $table->string('choice_3');
            $table->string('choice_4');
            $table->string('answer');
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
