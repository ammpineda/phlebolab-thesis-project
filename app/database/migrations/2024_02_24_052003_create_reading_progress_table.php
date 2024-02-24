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
        Schema::create('reading_progress', function (Blueprint $table) {
            $table->id();
            $table->boolean('first_chapter_is_done');
            $table->boolean('second_chapter_is_done');
            $table->boolean('third_chapter_is_done');
            $table->boolean('fourth_chapter_is_done');
            $table->boolean('fifth_chapter_is_done');
            $table->boolean('sixth_chapter_is_done');
            $table->unsignedBigInteger('reading_progress_user_id');
            $table->foreign('reading_progress_user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reading_progress');
    }
};
