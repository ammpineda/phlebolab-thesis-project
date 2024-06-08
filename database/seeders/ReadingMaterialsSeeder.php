<?php

namespace Database\Seeders;

use App\Models\ReadingMaterials;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReadingMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReadingMaterials::create([
            'lesson_title' => 'Introduction to Phlebotomy'
        ]);

        ReadingMaterials::create([
            'lesson_title' => 'Safety in Phlebotomy'
        ]);

        ReadingMaterials::create([
            'lesson_title' => 'Basic Human Anatomy and Physiology'
        ]);

        ReadingMaterials::create([
            'lesson_title' => 'Anatomy and Physiology of the Circulatory System'
        ]);

        ReadingMaterials::create([
            'lesson_title' => 'Phlebotomy Equipment'
        ]);

        ReadingMaterials::create([
            'lesson_title' => 'Phlebotomy Technique'
        ]);
    }
}
