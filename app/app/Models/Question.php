<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = ['question', 'first_option', 'second_option', 'third_option', 'fourth_option', 'answer', 'questions_quiz_id'];

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'questions_quiz_id', 'id');
    }
}
