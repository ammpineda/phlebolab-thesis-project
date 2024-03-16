<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummativeResult extends Model
{
    use HasFactory;

    protected $fillable = ['score', 'summative_results_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'summative_results_user_id');
    }

}
