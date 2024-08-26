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
        Schema::create('semi_states', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('current_news_slug');
            $table->integer('email_filter_price')->default(0);
            $table->integer('encryption_machine_price')->default(0);
            $table->integer('traffic_controller_price')->default(0);
            $table->integer('antivirus_price')->default(0);
            $table->integer('input_validator_price')->default(0);
            $table->foreign('current_news_slug')->references('slug')->on('semi_news')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semi_states');
    }
};
