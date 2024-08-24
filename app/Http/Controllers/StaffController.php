<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Medicine;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkStaffRole');
    }

    public function index()
    {
        return view ('staff.home');
    }

    public function stock()
    {
        return view ('staff.stock');
    }

    public function sales()
    {
        return view ('staff.sales');
    }

    public function receiving()
    {
        return view ('staff.receiving');
    }

    public function productCategory()
    {
        $category = Category::all();

        return view ('staff.product-category', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        // Find the category by ID
        $category = Category::find($request->input('categoryId'));

        if ($category) {
            // Update the category name
            $category->category = $request->input('categoryName');
            
            // Save the updated category
            $category->save();

            return redirect()->back()->with('success', 'Category updated successfully');
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
    }

    public function makeProductCategory(Request $request)
    {
        // Validate the request data with custom error messages
        $request->validate([
        'category' => 'required'
        ]);

         // Saving in the database
         $category = Category::create([
            'category' => $request->input('category'),
        ]);

        if (!$category) {
            return redirect()->route('staff.product-category')->with('error', 'Failed to create category.');
        }
    
        // Redirect with success message
        return redirect()->route('staff.product-category')->with('success', 'You have successfully added a category!');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Category not found.');
        }
    }

    public function productList()
    {
        $categories = Category::all();
        $medicine = Medicine::all();
        
        return view ('staff.product-list', compact('categories', 'medicine'));
    }



    public function addMedicine(Request $request)
    {
        // Validate the request data with custom error messages
        $request->validate([
            'category' => 'required',
            'product' => 'required',
            'price' => 'required'
        ]);

        // Saving in the database
        $medicine = Medicine::create([
            'category' => $request->input('category'),
            'product' => $request->input('product'),
            'price' => $request->input('price'),
        ]);

        if (!$medicine) {
            return redirect()->route('staff.product-list')->with('error', 'Failed to create medicine.');
        }
    
        // Redirect with success message
        return redirect()->route('staff.product-list')->with('success', 'You have successfully added a medicine!');

    }

    public function updateMedicine(Request $request)
    {
        $medicine = Medicine::find($request->input('medicineId'));
        $medicine->product = $request->input('medicineProduct');
        $medicine->category = $request->input('medicineCategory');
        $medicine->price = $request->input('medicinePrice');
        $medicine->save();

        return redirect()->back()->with('success', 'Supplier updated successfully');
    }

    public function deleteMedicine($id)
    {
        $medicine = Medicine::find($id);

        if ($medicine) {
            $medicine->delete();
            return redirect()->back()->with('success', 'Medicine deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Medicine not found.');
        }
    }

    public function expiredList()
    {
        
        return view ('staff.expired-list');
    }

    public function supplierList()
    {

        $supply = Supplier::all();

        // Pass the supply collection to the view
        return view ('staff.supplier-list', compact('supply'));
    }

    public function supplierForm(Request $request)
    {
          // Validate the request data with custom error messages
          $request->validate([
            'supplier' => 'required',
            'email' => 'required',
            'product' => 'required'
        ]);

         // Saving in the database
         $supplier = Supplier::create([
            'supplier' => $request->input('supplier'),
            'email' => $request->input('email'),
            'product' => $request->input('product'),
        ]);
    
        if (!$supplier) {
            return redirect()->route('staff.supplier-list')->with('error', 'Failed to create user.');
        }
    
        // Redirect with success message
        return redirect()->route('staff.supplier-list')->with('success', 'You have successfully added a product!');
    }

    public function updateSupplier(Request $request)
    {
        $supply = Supplier::find($request->input('supplyId'));
        $supply->supplier = $request->input('supplierName');
        $supply->email = $request->input('email');
        $supply->product = $request->input('product');
        $supply->save();

        return redirect()->back()->with('success', 'Supplier updated successfully');
    }

    public function deleteSupplier($id)
    {
        $supply = Supplier::find($id);

        if ($supply) {
            $supply->delete();
            return redirect()->back()->with('success', 'Supplier deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Supplier not found.');
        }
    }
}
