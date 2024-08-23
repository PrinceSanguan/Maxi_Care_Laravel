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

/******************************************** This Route is For Admin *****************************/
Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('admin/dashboard', [AdminController::class, 'newUser'])->name('admin.new.user');

Route::get('admin/sales-report', [AdminController::class, 'salesReport'])->name('admin.sales-report');
/******************************************** This Route is For Admin *****************************/

/******************************************** This Route is For Staff *****************************/
Route::get('staff/home', [StaffController::class, 'index'])->name('staff.home');

Route::get('staff/stock', [StaffController::class, 'stock'])->name('staff.stock');
Route::get('staff/sales', [StaffController::class, 'sales'])->name('staff.sales');
Route::get('staff/receiving', [StaffController::class, 'receiving'])->name('staff.receiving');
Route::get('staff/product-category', [StaffController::class, 'productCategory'])->name('staff.product-category');
Route::get('staff/product-list', [StaffController::class, 'productList'])->name('staff.product-list');
Route::get('staff/expired-list', [StaffController::class, 'expiredList'])->name('staff.expired-list');
Route::get('staff/supplier-list', [StaffController::class, 'supplierList'])->name('staff.supplier-list');
/******************************************** This Route is For Staff *****************************/


    /******************************************** This Route is For Logout *****************************/
    Route::get('/logout', function (Request $request) {
      Session::flush();
      Auth::logout();
  
      return redirect()->route('login');
  })->name('logout');
  /******************************************** This Route is For Logout *****************************/
