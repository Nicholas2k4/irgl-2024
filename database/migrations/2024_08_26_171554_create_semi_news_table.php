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
        Schema::create('semi_news', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug');
            $table->text('content');
            $table->integer('email_filter_price');
            $table->integer('encryption_machine_price');
            $table->integer('traffic_controller_price');
            $table->integer('antivirus_price');
            $table->integer('input_validator_price');
            $table->integer('slot')->default(20);
            $table->string('next_slug')->nullable();
            $table->string('attack_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semi_news');
    }
};
