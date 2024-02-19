<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';

    protected $fillable = ['results_user_id', 'results_quiz_id', 'score'];

    public function user() {
        return $this->belongsTo(User::class, 'results_user_id', 'id');
    }

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'results_quiz_id', 'id');
    }
}
