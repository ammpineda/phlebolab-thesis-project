<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LabProgress;
use App\Models\SummativeResult;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function displayManagementUsers(){
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
            'type' => 'Instructor'
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
            'type' => 'Student'
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

}
