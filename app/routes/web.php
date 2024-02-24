<?php

use App\Http\Controllers\ReadingProgressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'login'])->name('login-user');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [UserController::class, 'register'])->name('register-user');

Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
})->name('terms-and-conditions');

Route::get('/home', 
    [UserController::class, 'displayHome']
)->name('home');


Route::get('/reading-materials', 
    [ReadingProgressController::class, 'retrieveReadingProgress']
)->name('reading-materials');

// chapter 1

Route::get('/reading-chapter-1', 
    [ReadingProgressController::class, 'toChapterOne']
)->name('first_chapter');

Route::post('/chapter1-done', [ReadingProgressController::class, 'markChapterOneAsDone'])->name('chapter1-done');

// chapter 2

Route::get('/reading-chapter-2', 
    [ReadingProgressController::class, 'toChapterTwo']
)->name('second_chapter');

Route::post('/chapter2-done', [ReadingProgressController::class, 'markChapterTwoAsDone'])->name('chapter2-done');

// chapter 3

Route::get('/reading-chapter-3', 
    [ReadingProgressController::class, 'toChapterThree']
)->name('third_chapter');

Route::post('/chapter3-done', [ReadingProgressController::class, 'markChapterThreeAsDone'])->name('chapter3-done');

// chapter 4

Route::get('/reading-chapter-4', 
    [ReadingProgressController::class, 'toChapterFour']
)->name('fourth_chapter');

Route::post('/chapter4-done', [ReadingProgressController::class, 'markChapterFourAsDone'])->name('chapter4-done');

// chapter 5

Route::get('/reading-chapter-5', 
    [ReadingProgressController::class, 'toChapterFive']
)->name('fifth_chapter');

Route::post('/chapter5-done', [ReadingProgressController::class, 'markChapterFiveAsDone'])->name('chapter5-done');

// chapter 6

Route::get('/reading-chapter-6', 
    [ReadingProgressController::class, 'toChapterSix']
)->name('sixth_chapter');

Route::post('/chapter6-done', [ReadingProgressController::class, 'markChapterSixAsDone'])->name('chapter6-done');
