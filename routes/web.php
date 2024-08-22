<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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

/* Route::get('/', [SignupController::class, 'index'])->name('signup');
Route::post('/', [SignupController::class, 'signUp'])->name('signup.form'); */

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'loginForm'])->name('login.form');

Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('admin/dashboard', [AdminController::class, 'newUser'])->name('admin.new.user');

Route::get('staff/home', [StaffController::class, 'index'])->name('staff.home');

    /******************************************** This Route is For Logout *****************************/
    Route::get('/logout', function (Request $request) {
      Session::flush();
      Auth::logout();
  
      return redirect()->route('login');
  })->name('logout');
  /******************************************** This Route is For Logout *****************************/
