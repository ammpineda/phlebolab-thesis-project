<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function displayHome()
    {
        $userId = session('user_id');
        $user = User::findOrFail($userId);
        return view('home', compact('user'));
    }

    public function displayManagementHome()
    {
        $userId = session('user_id');
        $user = User::findOrFail($userId);
        return view('management/home', compact('user'));
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'confirm_password' => 'required',
            ]);
            
            if($request->input('password') === $request->input('confirm_password')){

                $user = User::create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    'type' => "Student",
                ]);


                // automatically creates a record for progress tracking
                $user->readingProgress()->create([
                    'first_chapter_is_done' => false,
                    'second_chapter_is_done' => false,
                    'third_chapter_is_done' => false,
                    'fourth_chapter_is_done' => false,
                    'fifth_chapter_is_done' => false,
                    'sixth_chapter_is_done' => false,
                ]);

                $user->labProgress()->create([
                    'first_lab_is_done' => false,
                    'second_lab_is_done' => false,
                    'third_lab_is_done' => false,
                ]);

                $user->summativeResult()->create([
                    'score' => 0
                ]);

            } else {
                return redirect()->back()->with('error', 'The password fields do not match.')->withInput();
            }
            
    
            return redirect()->back()->with('success', 'Registration successful. You can now log in.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            $errors = new \Illuminate\Support\MessageBag(['error' => $e->getMessage()]);
            return redirect()->back()->withErrors($errors)->withInput();
        }

    }

    public function login(Request $request)
    {
        try{

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $email = $request->input('email');
            $password = $request->input('password');

            $user = DB::table('users')
                ->where('email',$email)
                ->where('password', $password)
                ->first();
            
                if ($user) {
                    // Check the type of the user
                    if ($user->type === 'Student') {
                        Session::put('user_id', $user->id);
                        Session::put('is_student', true);
                        Session::put('is_admin', false);
                        Session::put('is_instructor', false);
                        return redirect(route('home'));
                    } elseif ($user->type === 'Admin') {
                        Session::put('user_id', $user->id);
                        Session::put('is_student', false);
                        Session::put('is_admin', true);
                        Session::put('is_instructor', false);
                        return redirect(route('management-home'));
                    } elseif ($user->type === 'Instructor'){
                        Session::put('user_id', $user->id);
                        Session::put('is_student', false);
                        Session::put('is_admin', false);
                        Session::put('is_instructor', true);
                        return redirect(route('management-home'));
                    }
                    
                    
                    else {
                        return redirect()->back()->with('error', 'Invalid user type.')->withInput();
                    }
                } else {
                    return redirect()->back()->with('error', 'Login failed. Invalid email or password.')->withInput();
                }
            
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Login failed. Invalid email or password.')->withInput();
        }
    }

}
