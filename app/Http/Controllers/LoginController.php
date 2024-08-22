<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view ('login');
    }

    public function loginForm(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log in the user
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, now check the user's role
            $user = Auth::user();

            if ($user->userRole === 'admin') {
                // Redirect to the admin dashboard
                return redirect()->route('admin.dashboard');
            } elseif ($user->userRole === 'staff') {
                // Redirect to the staff home
                return redirect()->route('staff.home');
            }

            // Default redirect if role doesn't match
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        } else {
            // Authentication failed, redirect back with error message
            return redirect()->route('login')->with('error', 'Invalid email or password.');
        }
    }
}
