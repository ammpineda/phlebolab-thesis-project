<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\QuizQuestions;
use App\Models\ReadingMaterials;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => 'password123', // Ensure you hash the password
            'type' => 'Admin',
            'is_active' => true,
            'is_archived' => false
        ]);


        // set the number of reading materials (6)
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

        // set the number of questions for each laboratory exercise

        $lab1_questions = [
            [
                'quiz_for' => 'lab_1',
                'question' => 'The use of syringe and needle destroys the integrity of the vein.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'b. False'
            ],
            [
                'quiz_for' => 'lab_1',
                'question' => 'There are a total of 13 equipment to be used in a syringe-based venipuncture technique.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'a. True'
            ],
            [
                'quiz_for' => 'lab_1',
                'question' => 'The evacuated tubes are made of plastic or __.',
                'choice_a' => 'a. Glass',
                'choice_b' => 'b. Silicon',
                'correct_answer' => 'a. Glass'
            ],
            [
                'quiz_for' => 'lab_1',
                'question' => 'The most common gauge sizes are 20 and 21.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'b. False'
            ],
            [
                'quiz_for' => 'lab_1',
                'question' => 'A(n) __ constricts the flow of blood in the arm and makes the veins more prominent.',
                'choice_a' => 'a. Adhesive Bandages',
                'choice_b' => 'b. Tourniquet',
                'correct_answer' => 'b. Tourniquet'
            ],
        ];

        foreach ($lab1_questions as $question) {
            QuizQuestions::create($question);
        }

        $lab2_questions = [
            [
                'quiz_for' => 'lab_2',
                'question' => 'It is not important to identify the patient before the venipuncture procedure.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'b. False'
            ],
            [
                'quiz_for' => 'lab_2',
                'question' => 'A substitute for patient identification is a current picture identification if the patient cannot verbally provide the information.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'a. True'
            ],
            [
                'quiz_for' => 'lab_2',
                'question' => 'Proper labeling must be followed to ensure correctness of patient information.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'a. True'
            ],
            [
                'quiz_for' => 'lab_2',
                'question' => 'You can draw blood even if the patient is not wearing a correct identification band.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'b. False'
            ],
            [
                'quiz_for' => 'lab_2',
                'question' => 'How many verifiers are needed to ensure proper identification of patient?',
                'choice_a' => 'a. One',
                'choice_b' => 'b. Two',
                'correct_answer' => 'b. Two'
            ],
        ];


        foreach ($lab2_questions as $question) {
            QuizQuestions::create($question);
        }

        $lab3_questions = [
            [
                'quiz_for' => 'lab_3',
                'question' => 'The first step in the venipuncture using syringe procedure is to identify the patient.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'a. True'
            ],
            [
                'quiz_for' => 'lab_3',
                'question' => 'The needle should be in a bevel __ position when performing the venipuncture.',
                'choice_a' => 'a. Up',
                'choice_b' => 'b. Down',
                'correct_answer' => 'a. Up'
            ],
            [
                'quiz_for' => 'lab_3',
                'question' => 'The venipuncture area should be cleaned using a(n) __.',
                'choice_a' => 'a. Hand Sanitizer',
                'choice_b' => 'b. Alcohol Swab',
                'correct_answer' => 'b. Alcohol Swab'
            ],
            [
                'quiz_for' => 'lab_3',
                'question' => 'It is not important to ask the patient to close their hand during blood collection.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'b. False'
            ],
            [
                'quiz_for' => 'lab_3',
                'question' => 'You need to draw the skin taut of the patient with your dominant thumb.',
                'choice_a' => 'a. True',
                'choice_b' => 'b. False',
                'correct_answer' => 'b. False'
            ],
        ];


        foreach ($lab3_questions as $question) {
            QuizQuestions::create($question);
        }


        $lab4_questions = [
            [
                'quiz_for' => 'lab_4',
                'question' => 'Phlebotomists often have many duties and tasks. Which of the following is the primary duty?',
                'choice_a' => 'a. sample processing',
                'choice_b' => 'b. sample accession',
                'choice_c' => 'c. collecting venous blood samples',
                'choice_d' => 'd. collecting arterial blood samples',
                'correct_answer' => 'c. collecting venous blood samples'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'What laboratory procedure tests a routine urine sample?',
                'choice_a' => 'a. chemistry',
                'choice_b' => 'b. cytology',
                'choice_c' => 'c. urinalysis',
                'choice_d' => 'd. microbiology',
                'correct_answer' => 'c. urinalysis'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'The single most important way to prevent the spread of infection in a hospital or other facility is',
                'choice_a' => 'a. gowning and gloving',
                'choice_b' => 'b. handwashing',
                'choice_c' => 'c. always wearing masks',
                'choice_d' => 'd. avoiding breathing on patients',
                'correct_answer' => 'b. handwashing'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'A potential source of infectious material from a patient in protective isolation includes',
                'choice_a' => 'a. feces',
                'choice_b' => 'b. none (the phlebotomist is considered a potential source of infection to the patient)',
                'choice_c' => 'c. urine',
                'choice_d' => 'd. blood',
                'correct_answer' => 'b. none (the phlebotomist is considered a potential source of infection to the patient)'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'The process in which oxygen-rich blood diffuses into tissue cells is',
                'choice_a' => 'a. exhaling',
                'choice_b' => 'b. external respiration',
                'choice_c' => 'c. internal respiration',
                'choice_d' => 'd. breathing',
                'correct_answer' => 'c. internal respiration'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'The most common disorder of the endocrine system is',
                'choice_a' => 'a. rheumatoid arthritis',
                'choice_b' => 'b. diabetes mellitus',
                'choice_c' => 'c. infertility',
                'choice_d' => 'd. respiratory distress',
                'correct_answer' => 'b. diabetes mellitus'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'The formed elements make up about __ percent of the whole blood volume',
                'choice_a' => 'a. 30',
                'choice_b' => 'b. 60',
                'choice_c' => 'c. 55',
                'choice_d' => 'd. 45',
                'correct_answer' => 'd. 45'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'The two components of blood found in a tube of blood drawn without anticoagulant are',
                'choice_a' => 'a. plasma and clot',
                'choice_b' => 'b. buffy coat and erythrocytes',
                'choice_c' => 'c. serum and buffy coat',
                'choice_d' => 'd. serum and clot',
                'correct_answer' => 'd. serum and clot'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'The fluid portion of the whole blood that contains fibrinogen is called',
                'choice_a' => 'a. the buffy coat',
                'choice_b' => 'b. erythrocytes',
                'choice_c' => 'c. plasma',
                'choice_d' => 'd. serum',
                'correct_answer' => 'c. plasma'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'When serum is needed for blood chemistry testing, blood must be collected in which of the following colored tubes?',
                'choice_a' => 'a. light blue',
                'choice_b' => 'b. green',
                'choice_c' => 'c. lavender',
                'choice_d' => 'd. red',
                'correct_answer' => 'd. red'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'The tourniquet should be applied how many inches above the proposed venipuncture site?',
                'choice_a' => 'a. 1 to 2 inches',
                'choice_b' => 'b. 3 to 4 inches',
                'choice_c' => 'c. 4 to 5 inches',
                'choice_d' => 'd. 5 to 6 inches',
                'correct_answer' => 'b. 3 to 4 inches'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'Leaving the tourniquet on a patient\'s arm for an extended length of time before drawing blood may cause',
                'choice_a' => 'a. hemoconcentration',
                'choice_b' => 'b. sample hemolysis',
                'choice_c' => 'c. stress',
                'choice_d' => 'd. bruising',
                'correct_answer' => 'a. hemoconcentration'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'A phlebotomist is requested to go to a patient\'s hospital room and draw a sample from an unconscious patient. The room number and the name on the door agree with the request form and the patient identification bracelet. What else should be done to ensure patient identification?',
                'choice_a' => 'a. refuse to draw the patient until he or she is conscious',
                'choice_b' => 'b. attempt to find the name of the patient on some other item in the room',
                'choice_c' => 'c. nothing else is necessary',
                'choice_d' => 'd. verify if the identity of the patient from a relative or nurse',
                'correct_answer' => 'c. nothing else is necessary'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'When drawing multiple samples in evacuated tubes, it is important to fill which of the following color-stoppered tubes first?',
                'choice_a' => 'a. light-blue',
                'choice_b' => 'b. green',
                'choice_c' => 'c. lavender',
                'choice_d' => 'd. red',
                'correct_answer' => 'a. light-blue'
            ],
            [
                'quiz_for' => 'lab_4',
                'question' => 'The doctor orders tests requiring a light-blue-stoppered tube for coagulation studies, a lavender-stoppered tube, a red-stoppered tube, and a set of blood cultures. What is the correct order of draw?',
                'choice_a' => 'a. red, light-blue, blood cultures, lavender',
                'choice_b' => 'b. blood cultures, light-blue, red, lavender',
                'choice_c' => 'c. blood cultures, red, light-blue, lavender',
                'choice_d' => 'd. blood cultures, lavender, light-blue, red',
                'correct_answer' => 'b. blood cultures, light-blue, red, lavender'
            ],
        ];

        foreach ($lab4_questions as $question) {
            QuizQuestions::create($question);
        }

    }
}
