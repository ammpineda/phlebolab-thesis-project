<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'type', 'is_active'];

    public function summativeResult() {
        return $this->hasMany(SummativeResult::class, 'summative_results_user_id', 'id');
    }

    public function readingProgress()
    {
        return $this->hasOne(ReadingProgress::class, 'reading_progress_user_id');
    }

    public function labProgress()
    {
        return $this->hasOne(LabProgress::class, 'lab_progress_user_id');
    }
    
}
