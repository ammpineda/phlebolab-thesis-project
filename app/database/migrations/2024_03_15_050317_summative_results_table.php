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
        Schema::create('summative_results', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('score');
            $table->unsignedBigInteger('summative_results_user_id');
            $table->foreign('summative_results_user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summative_results');
    }
};
