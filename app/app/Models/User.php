<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    public function results() {
        return $this->hasMany(Result::class, 'results_user_id', 'id');
    }
}
