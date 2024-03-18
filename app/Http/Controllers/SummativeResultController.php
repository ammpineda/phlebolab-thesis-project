<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SummativeResult;
use App\Models\LabProgress;
use App\Models\User;
use Illuminate\Http\Request;

class SummativeResultController extends Controller
{
    public function toTest(){
        $userId = session('user_id');
        $summativeTestProgress = SummativeResult::where('summative_results_user_id', $userId)->first();

        if (!$summativeTestProgress) {
            abort(404, 'Summative Test progress not found for the user.');
        }

        $labProgress = LabProgress::where('lab_progress_user_id', $userId)->first();
    
        if (!$labProgress) {
            abort(404, 'Lab progress not found for the user.');
        }
    

        $user = User::findOrFail($userId);

        $isAllowed = $labProgress->third_lab_is_done;

        return view('summative-quiz', compact('user', 'summativeTestProgress', 'isAllowed'));

    }

    public function saveScore(Request $request) {
        $userId = session('user_id');
        
        $score = $request->input('score');
    
        $summativeTestProgress = SummativeResult::where('summative_results_user_id', $userId)->first();
    
        if (!$summativeTestProgress) {
            return response()->json(['error' => 'Summative Test progress not found for the user.'], 404);
        }
    
        $summativeTestProgress->update(['score' => $score]);

        $user = User::findOrFail($userId);
    
        return view('home', compact('user'));
    }
    
}
