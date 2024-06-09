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
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->string('quiz_for'); // lab_1, lab_2, lab_3, summative
            $table->text('question');
            $table->string('choice_a')->nullable();
            $table->string('choice_b')->nullable();
            $table->string('choice_c')->nullable();
            $table->string('choice_d')->nullable();
            $table->string('correct_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
