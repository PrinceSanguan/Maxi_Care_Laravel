<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkAdminRole');
    }

    public function index()
    {
        return view ('admin.home');
    }

    public function dashboard()
    {
        // Fetch all users where userRole is 'staff'
        $staff = User::where('userRole', 'staff')->get();
    
        // Pass the $staff collection to the view
        return view('admin.dashboard', compact('staff'));
    }

    public function newUser(Request $request)
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
            'userRole' => 'staff',
            'password' => bcrypt($request->input('password')),
            
        ]);

        if (!$user) {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to create user.');
        }
    
        // Redirect with success message
        return redirect()->route('admin.dashboard')->with('success', 'You have successfully  added new user!');
    }

    public function salesReport()
    {
        return view ('admin.sales-report');
    }
}
