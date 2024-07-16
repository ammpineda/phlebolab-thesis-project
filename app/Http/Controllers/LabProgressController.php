<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LabProgress;
use App\Models\QuizQuestions;
use App\Models\ReadingProgress;
use App\Models\User;
use Illuminate\Http\Request;

class LabProgressController extends Controller
{
    public function retrieveLabProgress() {
        $userId = session('user_id');
        
        // Retrieve the lab progress for the user
        $labProgress = LabProgress::where('lab_progress_user_id', $userId)->first();
    
        if (!$labProgress) {
            abort(404, 'Lab progress not found for the user.');
        }
    
        // Retrieve the last reading progress chapter based on the highest chapter_number
        $lastReadingProgress = ReadingProgress::where('user_id', $userId)
                                               ->orderBy('chapter_number', 'desc')
                                               ->first();
    
        if (!$lastReadingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }
    
        // Check if the last chapter is done
        $isLastChapterDone = $lastReadingProgress->is_done;
    
        // Retrieve user information
        $user = User::findOrFail($userId);
    
        // Pass the last chapter status to the view
        return view('labs', compact('user', 'labProgress', 'isLastChapterDone'));
    }
    
    

    // Exercise 1 Quiz
    public function toPracticeQuizOne(){
        $userId = session('user_id');
        
        $labProgress = LabProgress::where('lab_progress_user_id', $userId)->first();
    
        if (!$labProgress) {
            abort(404, 'Lab progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);

        $questions = QuizQuestions::where('quiz_for', 'lab_1')->get();
        
        return view('lab exercises/quiz1', compact('user', 'labProgress', 'questions'));

    }

    public function markExerciseOneAsDone() {
        $userId = session('user_id');

        $labProgress = LabProgress::where('lab_progress_user_id', $userId)->first();

        if (!$labProgress) {
            abort(404, 'Lab progress not found for the user.');
        }

        $labProgress->update(['first_lab_is_done' => true]);

        return redirect()->route('laboratory-exercises');
    }

    // Exercise 2 Quiz
    public function toPracticeQuizTwo(){
        $userId = session('user_id');
        
        $labProgress = LabProgress::where('lab_progress_user_id', $userId)->first();
    
        if (!$labProgress) {
            abort(404, 'Lab progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);

        $questions = QuizQuestions::where('quiz_for', 'lab_2')->get();
        
        return view('lab exercises/quiz2', compact('user', 'labProgress', 'questions'));

    }

    public function markExerciseTwoAsDone() {
        $userId = session('user_id');

        $labProgress = LabProgress::where('lab_progress_user_id', $userId)->first();

        if (!$labProgress) {
            abort(404, 'Lab progress not found for the user.');
        }

        $labProgress->update(['second_lab_is_done' => true]);

        return redirect()->route('laboratory-exercises');
    }


    // Exercise 3
    public function toPracticeQuizThree(){
        $userId = session('user_id');
        
        $labProgress = LabProgress::where('lab_progress_user_id', $userId)->first();
    
        if (!$labProgress) {
            abort(404, 'Lab progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);

        $questions = QuizQuestions::where('quiz_for', 'lab_3')->get();
        
        return view('lab exercises/quiz3', compact('user', 'labProgress', 'questions'));

    }

    public function markExerciseThreeAsDone() {
        $userId = session('user_id');

        $labProgress = LabProgress::where('lab_progress_user_id', $userId)->first();

        if (!$labProgress) {
            abort(404, 'Lab progress not found for the user.');
        }

        $labProgress->update(['third_lab_is_done' => true]);

        return redirect()->route('laboratory-exercises');
    }
}
