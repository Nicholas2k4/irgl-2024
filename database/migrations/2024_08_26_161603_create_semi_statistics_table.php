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
        Schema::create('semi_statistics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_team');
            $table->float('score')->default(0);
            $table->integer('email_filter')->default(0);
            $table->integer('encryption_machine')->default(0);
            $table->integer('traffic_controller')->default(0);
            $table->integer('antivirus')->default(0);
            $table->integer('input_validator')->default(0);
            $table->foreign('id_team')->references('id')->on('teams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semi_statistics');
    }
};
