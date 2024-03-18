<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingProgress extends Model
{
    use HasFactory;

    protected $fillable = ['first_chapter_is_done', 'second_chapter_is_done', 'third_chapter_is_done', 'fourth_chapter_is_done', 'fifth_chapter_is_done', 'sixth_chapter_is_done', 'reading_progress_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'reading_progress_user_id');
    }
    
}
