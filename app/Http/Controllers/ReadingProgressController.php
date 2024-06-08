<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ReadingMaterials;
use Illuminate\Http\Request;
use App\Models\ReadingProgress;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;


class ReadingProgressController extends Controller
{
    public function retrieveReadingProgress() {
        $userId = session('user_id');
        
        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        $readingMaterials = ReadingMaterials::all();
    
        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);
        
        return view('materials', compact('user', 'readingProgress', 'readingMaterials'));
    }


    // Chapter 1
    public function toChapterOne() {
        $userId = session('user_id');
        
        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();
        $material = ReadingMaterials::where('id',1)->first();
    
        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);
        
        return view('reading chapters/first_chapter', compact('user', 'readingProgress','material'));
    }

    public function markChapterOneAsDone() {
        $userId = session('user_id');

        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }

        $readingProgress->update(['first_chapter_is_done' => true]);

        return redirect()->route('reading-materials');
    }

    //chapter 2
    public function toChapterTwo() {
        $userId = session('user_id');
        
        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();
        $material = ReadingMaterials::where('id',2)->first();
    
        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);
        
        return view('reading chapters/second_chapter', compact('user', 'readingProgress', 'material'));
    }

    public function markChapterTwoAsDone() {
        $userId = session('user_id');

        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }

        $readingProgress->update(['second_chapter_is_done' => true]);

        return redirect()->route('reading-materials');
    }


    //Chapter 3
    public function toChapterThree() {
        $userId = session('user_id');
        
        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        $material = ReadingMaterials::where('id',3)->first();
    
        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);
        
        return view('reading chapters/third_chapter', compact('user', 'readingProgress','material'));
    }

    public function markChapterThreeAsDone() {
        $userId = session('user_id');

        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }

        $readingProgress->update(['third_chapter_is_done' => true]);

        return redirect()->route('reading-materials');
    }

    //Chapter 4
    public function toChapterFour() {
        $userId = session('user_id');
        
        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        $material = ReadingMaterials::where('id',4)->first();
    
        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);
        
        return view('reading chapters/fourth_chapter', compact('user', 'readingProgress', 'material'));
    }

    public function markChapterFourAsDone() {
        $userId = session('user_id');

        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }

        $readingProgress->update(['fourth_chapter_is_done' => true]);

        return redirect()->route('reading-materials');
    }

    //Chapter 5
    public function toChapterFive() {
        $userId = session('user_id');
        
        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        $material = ReadingMaterials::where('id',5)->first();
    
        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);
        
        return view('reading chapters/fifth_chapter', compact('user', 'readingProgress','material'));
    }

    public function markChapterFiveAsDone() {
        $userId = session('user_id');

        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }

        $readingProgress->update(['fifth_chapter_is_done' => true]);

        return redirect()->route('reading-materials');
    }

    //Chapter 6
    public function toChapterSix() {
        $userId = session('user_id');
        
        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        $material = ReadingMaterials::where('id',6)->first();
    
        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }
    
        $user = User::findOrFail($userId);
        
        return view('reading chapters/sixth_chapter', compact('user', 'readingProgress', 'material'));
    }

    public function markChapterSixAsDone() {
        $userId = session('user_id');

        $readingProgress = ReadingProgress::where('reading_progress_user_id', $userId)->first();

        if (!$readingProgress) {
            abort(404, 'Reading progress not found for the user.');
        }

        $readingProgress->update(['sixth_chapter_is_done' => true]);

        return redirect()->route('reading-materials');
    }
}
