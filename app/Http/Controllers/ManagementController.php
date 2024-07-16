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
            'is_archived' => false
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
            'is_archived' => false
        ]);

        $totalMaterials = ReadingMaterials::count();


        for ($i = 1; $i <= $totalMaterials; $i++) {
            $student->readingProgress()->create([
                'chapter_number' => $i,
                'is_done' => false,
            ]);
        }

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

    public function archiveUser(User $user)
    {
        // Toggle the user's `is_archived` attribute
        $user->is_archived = !$user->is_archived;
        $user->save();

        $message = $user->is_archived ? 'User archived successfully.' : 'User unarchived successfully.';
        return redirect()->back()->with('success', $message);
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


    public function storeMaterial(Request $request)
{
    // Validate incoming request data
    $validatedData = $request->validate([
        'lesson_title' => 'required|string|max:255',
        'display_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000', // Optional image upload, max 10MB
        'reading_material_pdf' => 'nullable|file|mimes:pdf|max:50000', // Optional PDF upload, max 50MB
    ]);

    // Initialize variables for file names
    $imageName = null;
    $pdfName = null;

    // Handle display image upload if provided
    if ($request->hasFile('display_image')) {
        $displayImage = $request->file('display_image');
        $imageName = time() . '_' . $displayImage->getClientOriginalName();
        $displayImage->storeAs('public/thumbnail', $imageName); // Store image in storage/app/public/thumbnail
    }

    // Handle PDF file upload if provided
    if ($request->hasFile('reading_material_pdf')) {
        $pdfFile = $request->file('reading_material_pdf');
        $pdfName = time() . '_' . $pdfFile->getClientOriginalName();
        $pdfFile->storeAs('public/pdf', $pdfName); // Store PDF file in storage/app/public/pdf
    }

    // Create new material record
    $material = new ReadingMaterials();
    $material->lesson_title = $validatedData['lesson_title'];
    $material->display_image = $imageName;
    $material->reading_material_pdf = $pdfName;
    $material->save();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Material added successfully.');
}

public function destroyMaterial($id)
    {
        $material = ReadingMaterials::findOrFail($id);
        $material->delete();

        return redirect()->back()->with('success', 'Reading material deleted successfully.');
    }



    public function displayManagementLaboratory()
    {
        $questions = QuizQuestions::where('quiz_for', 'lab_1')
            ->orWhere('quiz_for', 'lab_2')
            ->orWhere('quiz_for', 'lab_3')
            ->get();


        return view('management/manage-laboratory', compact('questions'));
    }

    public function deleteQuestion($id){
        $question = QuizQuestions::findOrFail($id);

        $question->delete();

        return redirect()->back()->with('success', 'Question deleted successfully.');
    }

    public function storeQuestion(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'question' => 'required|string',
        'choice_a' => 'required|string',
        'choice_b' => 'required|string',
        'correct_answer' => 'required|string|in:choice_a,choice_b',
        'quiz_for' => 'required|string',
    ]);

    // Set the correct answer based on the selected option
    if ($validatedData['correct_answer'] === 'choice_a') {
        $validatedData['correct_answer'] = $validatedData['choice_a'];
    } elseif ($validatedData['correct_answer'] === 'choice_b') {
        $validatedData['correct_answer'] = $validatedData['choice_b'];
    }

    // Create a new question
    $question = QuizQuestions::create($validatedData);

    // Redirect or respond as needed
    return redirect()->back()->with('success', 'Question added successfully!');
}

public function storeQuestionWithCD(Request $request){
    $validatedData = $request->validate([
        'question' => 'required|string',
        'choice_a' => 'required|string',
        'choice_b' => 'required|string',
        'choice_c' => 'required|string',
        'choice_d' => 'required|string',
        'correct_answer' => 'required|string',
        'quiz_for' => 'required|string',
    ]);

    // Set the correct answer based on the selected option
    switch ($validatedData['correct_answer']) {
        case 'choice_a':
            $validatedData['correct_answer'] = $validatedData['choice_a'];
            break;
        case 'choice_b':
            $validatedData['correct_answer'] = $validatedData['choice_b'];
            break;
        case 'choice_c':
            $validatedData['correct_answer'] = $validatedData['choice_c'];
            break;
        case 'choice_d':
            $validatedData['correct_answer'] = $validatedData['choice_d'];
            break;
        default:
            // Handle any unexpected cases
            break;
    }

    // Create a new question
    $question = QuizQuestions::create($validatedData);

    // Redirect or respond as needed
    return redirect()->back()->with('success', 'Question added successfully!');
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

    public function updateQuestionWithCD(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'question' => 'required|string',
            'choice_a' => 'required|string',
            'choice_b' => 'required|string',
            'choice_c' => 'required|string',
            'choice_d' => 'required|string',
            'correct_answer' => 'required|string|in:choice_a,choice_b,choice_c,choice_d',
            'quiz_for' => 'required|string'
        ]);

        $question = QuizQuestions::findOrFail($request->id);
        $question->question = $request->question;
        $question->choice_a = $request->choice_a;
        $question->choice_b = $request->choice_b;
        $question->choice_c = $request->choice_c;
        $question->choice_d = $request->choice_d;

        // Set the correct answer based on the selected option
        $question->correct_answer = $request->input($request->correct_answer);

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
