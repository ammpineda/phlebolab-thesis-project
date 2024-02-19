<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';

    protected $fillable = ['title', 'instructions'];

    public function questions() {
        return $this->hasMany(Question::class, 'questions_quiz_id', 'id');
    }

    public function results() {
        return $this->hasMany(Result::class, 'results_quiz_id', 'id');
    }
}
