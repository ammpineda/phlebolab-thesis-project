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
        Schema::create('lab_progress', function (Blueprint $table) {
            $table->id();
            $table->boolean('first_lab_is_done');
            $table->boolean('second_lab_is_done');
            $table->boolean('third_lab_is_done');
            $table->unsignedBigInteger('lab_progress_user_id');
            $table->foreign('lab_progress_user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_progress');
    }
};
