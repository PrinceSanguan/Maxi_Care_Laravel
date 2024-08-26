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
Route::post('staff/sales', [StaffController::class, 'newSales'])->name('staff.new-sales');
Route::post('staff/sales/update', [StaffController::class, 'updateSales'])->name('staff.update-sales');
Route::delete('staff/sales/delete/{id}', [StaffController::class, 'deleteSales'])->name('staff.delete-sales');

Route::get('staff/receiving', [StaffController::class, 'receiving'])->name('staff.receiving');
Route::post('staff/receiving/add', [StaffController::class, 'receiveForm'])->name('staff.receive-form');
Route::post('staff/receiving/update', [StaffController::class, 'updateReceive'])->name('staff.receive-update');
Route::delete('staff/receiving/delete/{id}', [StaffController::class, 'deleteReceive'])->name('staff.receive-delete');

Route::get('staff/product-category', [StaffController::class, 'productCategory'])->name('staff.product-category');
Route::post('staff/product-category', [StaffController::class, 'makeProductCategory'])->name('staff.make-category');
Route::post('staff/product-category/update', [StaffController::class, 'updateCategory'])->name('staff.update-category');
Route::delete('staff/product-category/delete/{id}', [StaffController::class, 'deleteCategory'])->name('staff.delete-category');

Route::get('staff/product-list', [StaffController::class, 'productList'])->name('staff.product-list');
Route::post('staff/product-list', [StaffController::class, 'addMedicine'])->name('staff.add-medicine');
Route::post('staff/product-list/update', [StaffController::class, 'updateMedicine'])->name('staff.update-medicine');
Route::delete('staff/product-list/delete/{id}', [StaffController::class, 'deleteMedicine'])->name('staff.delete-medicine');

Route::get('staff/expired-list', [StaffController::class, 'expiredList'])->name('staff.expired-list');

Route::get('staff/supplier-list', [StaffController::class, 'supplierList'])->name('staff.supplier-list');
Route::post('staff/supplier-list', [StaffController::class, 'supplierForm'])->name('staff.supplier-form');
Route::post('staff/supplier-list/update', [StaffController::class, 'updateSupplier'])->name('staff.update-supplier');
Route::delete('staff/supplier-list/delete/{id}', [StaffController::class, 'deleteSupplier'])->name('staff.delete-supplier');
/******************************************** This Route is For Staff *****************************/


    /******************************************** This Route is For Logout *****************************/
    Route::get('/logout', function (Request $request) {
      Session::flush();
      Auth::logout();
  
      return redirect()->route('login');
  })->name('logout');
  /******************************************** This Route is For Logout *****************************/
