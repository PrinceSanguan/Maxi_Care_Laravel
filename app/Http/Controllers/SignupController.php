<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignupController extends Controller
{
    public function index()
    {
        return view ('signup');
    }

    public function signUp(Request $request)
    {
        // Validate the request data with custom error messages
        $request->validate([
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
        ]);


         // Saving in the database
         $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        if (!$user) {
            return redirect()->route('signup')->with('error', 'Failed to create user.');
        }
    
        // Redirect with success message
        return redirect()->route('login')->with('success', 'You have successfully signed up!');
    }
}
