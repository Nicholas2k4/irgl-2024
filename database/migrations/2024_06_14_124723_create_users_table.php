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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('alamat');
            $table->string('kode_pos');
            $table->string('no_telp');
            $table->string('id_line');
            $table->string('link_foto');
            $table->boolean('is_ketua');
            $table->string('bank')->nullable();
            $table->string('no_rek')->nullable();
            $table->unsignedBigInteger('id_tim');
            $table->timestamps();

            $table->foreign('id_tim')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
