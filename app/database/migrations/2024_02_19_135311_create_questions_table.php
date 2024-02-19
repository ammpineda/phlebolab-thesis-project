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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->string('first_option');
            $table->string('second_option');
            $table->string('third_option');
            $table->string('fourth_option');
            $table->string('answer');
            $table->unsignedBigInteger('questions_quiz_id');
            $table->foreign('questions_quiz_id')->references('id')->on('quizzes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
