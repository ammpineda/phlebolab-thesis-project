<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LabProgress;
use App\Models\QuizQuestions;
use App\Models\ReadingMaterials;
use App\Models\SummativeResult;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementController extends Controller
{

    public function displayManagementUsers()
    {
        $users = User::all();
        $lab_progress = LabProgress::all();
        $summative_results = SummativeResult::all();
        return view('management/manage-users', compact('users', 'lab_progress', 'summative_results'));
    }

    public function addInstructor(Request $request)
    {
        // Validate the form data
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Create a new instructor instance
        $instructor = new User([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'type' => 'Instructor',
            'is_active' => true,
        ]);

        // Save the instructor
        $instructor->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Instructor added successfully.');
    }

    public function addStudent(Request $request)
    {

        // Validate the form data
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            
        ]);

        // Create a new student instance
        $student = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'type' => 'Student',
            'is_active' => true,
        ]);

        // automatically creates a record for progress tracking
        $student->readingProgress()->create([
            'first_chapter_is_done' => false,
            'second_chapter_is_done' => false,
            'third_chapter_is_done' => false,
            'fourth_chapter_is_done' => false,
            'fifth_chapter_is_done' => false,
            'sixth_chapter_is_done' => false,
        ]);

        $student->labProgress()->create([
            'first_lab_is_done' => false,
            'second_lab_is_done' => false,
            'third_lab_is_done' => false,
        ]);

        $student->summativeResult()->create([
            'score' => 0
        ]);

        // Save the student
        $student->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Student added successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);


        $user->labProgress()->delete();
        $user->readingProgress()->delete();
        $user->summativeResult()->delete();
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        // Update the user
        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return redirect()->back()->with('success', 'User details updated successfully.');
    }

    public function updateAccountStatus($id)
    {

        $user = User::findOrFail($id);

        if($user->is_active){
            $user->update([
                'is_active' => false
            ]);

        } else{
            $user->update([
                'is_active' => true
            ]);
        }
        

        return redirect()->back()->with('success', 'User details updated successfully.');
    }


    public function displayManagementMaterials()
    {
        $reading_materials = ReadingMaterials::all();
        return view('management/manage-materials', compact('reading_materials'));
    }

    public function updateMaterial(Request $request, $id)
    {
        $request->validate([
            'lesson_title' => 'required|string|max:255',
            'display_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'reading_material_pdf' => 'nullable|mimes:pdf|max:50000',
        ]);

        $material = ReadingMaterials::findOrFail($id);

        $material->lesson_title = $request->input('lesson_title');

        if ($request->hasFile('display_image')) {
            $displayImage = $request->file('display_image');
            $imagePath = $displayImage->getClientOriginalName(); // Get only the file name
            $displayImage->storeAs('public/thumbnail', $imagePath);
            $material->display_image = $imagePath;
        }

        if ($request->hasFile('reading_material_pdf')) {
            $pdf = $request->file('reading_material_pdf');
            $pdfPath = $pdf->getClientOriginalName(); // Get only the file name
            $pdf->storeAs('public/pdf', $pdfPath);
            $material->reading_material_pdf = $pdfPath;
        }

        $material->save();

        return redirect()->back()->with('success', 'Material details updated successfully.');
    }

    public function displayManagementLaboratory()
    {
        $questions = QuizQuestions::where('quiz_for', 'lab_1')
            ->orWhere('quiz_for', 'lab_2')
            ->orWhere('quiz_for', 'lab_3')
            ->get();


        return view('management/manage-laboratory', compact('questions'));
    }

    public function updateQuestion(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'question' => 'required|string',
            'choice_a' => 'required|string',
            'choice_b' => 'required|string',
            'correct_answer' => 'required|string',
            'quiz_for' => 'required|string'
        ]);

        $question = QuizQuestions::findOrFail($request->id);
        $question->question = $request->question;
        $question->choice_a = $request->choice_a;
        $question->choice_b = $request->choice_b;

        // Set the correct answer based on the selected option
        if ($request->correct_answer === 'choice_a') {
            $question->correct_answer = $request->choice_a;
        } elseif ($request->correct_answer === 'choice_b') {
            $question->correct_answer = $request->choice_b;
        }

        $question->quiz_for = $request->quiz_for;
        $question->save();

        return redirect()->back()->with('success', 'Question updated successfully');
    }

    public function displayManagementQuiz()
    {
        $questions = QuizQuestions::where('quiz_for', 'lab_4')
            ->get();


        return view('management/manage-quiz', compact('questions'));
    }
}
