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

                User::create([
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ]);

            } else {
                return redirect()->back()->with('error', 'The password fields do not match.')->withInput();
            }
            
    
            return redirect()->back()->with('success', 'Registration successful. You can now log in.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Registration failed. Please try again later.')->withInput();
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
            
                Session::put('user_id', $user->id);
                return redirect(route('home'));
            
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Login failed. Invalid email or password.')->withInput();
        }
    }
}
