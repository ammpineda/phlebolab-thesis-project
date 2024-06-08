<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingMaterials extends Model
{
    use HasFactory;

    protected $table = 'reading_materials';

    protected $fillable = ['lesson_title','display_image', 'reading_material_pdf'];

    
}
