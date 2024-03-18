<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabProgress extends Model
{
    use HasFactory;

    protected $fillable = ['first_lab_is_done', 'second_lab_is_done', 'third_lab_is_done', 'lab_progress_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'lab_progress_user_id');
    }
    
}
