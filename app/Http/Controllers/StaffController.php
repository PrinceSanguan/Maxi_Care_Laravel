<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Receive;
use App\Models\Sales;

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

    public function stock() {
        // Fetch the product name and quantity from the Receiving model
        $productNames = Receive::select('product', 'quantity')->get();
    
        // Pass the product name to the view
        return view('staff.stock', compact('productNames'));
    }

    public function sales()
    {
        $sales = Sales::all();
        return view ('staff.sales', compact('sales'));
    }

    public function newSales(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:255',  
            'amount' => 'required|integer|min:1', 
        ]);

        
        // Saving in the database
        $sales = Sales::create([
            'reference' => $request->input('reference'),
            'amount' => $request->input('amount'),
        ]);

        if (!$sales) {
            return redirect()->route('staff.sales')->with('error', 'Failed to create a sales.');
        }
    
        // Redirect with success message
        return redirect()->route('staff.sales')->with('success', 'You have successfully create a sales');
    }

    public function updateSales(Request $request)
    {
        $sales = Sales::find($request->input('salesId'));
        $sales->reference = $request->input('salesReference');
        $sales->amount = $request->input('salesAmount');
        
        $sales->save();

        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function deleteSales($id)
    {
        $sales = Sales::find($id);

        if ($sales) {
            $sales->delete();
            return redirect()->back()->with('success', 'deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'not found.');
        }
    }

    public function receiving()
    {
        $suppliers = Supplier::all();
        $receives = Receive::all();

        return view ('staff.receiving', compact('suppliers', 'receives'));
    }

    public function receiveForm(Request $request)
    {
        $request->validate([
            'supplier' => 'required|string|max:255',   // Ensure supplier is a string and not too long
            'product' => 'required|string|max:255',    // Ensure product is a string and not too long
            'reference' => 'required|string|max:255', // Ensure reference is unique in the 'receives' table
            'quantity' => 'required|integer|min:1',    // Ensure quantity is an integer and greater than or equal to 1
            'amount' => 'required|numeric|min:0',      // Ensure amount is a number and not negative
            'dateReceived' => 'required|date',
            'expired' => 'required|date|after:today',  // Ensure expired is a valid date and after today
        ]);

        // Saving in the database
        $receive = Receive::create([
            'supplier' => $request->input('supplier'),
            'product' => $request->input('product'),
            'reference' => $request->input('reference'),
            'quantity' => $request->input('quantity'),
            'amount' => $request->input('amount'),
            'dateReceived' => $request->input('dateReceived'),
            'expired' => $request->input('expired'),
        ]);

        if (!$receive) {
            return redirect()->route('staff.receiving')->with('error', 'Failed to receive a product.');
        }
    
        // Redirect with success message
        return redirect()->route('staff.receiving')->with('success', 'You have successfully receive a product');

    }

    public function updateReceive(Request $request)
    {
        $receive = Receive::find($request->input('receiveId'));
        $receive->reference = $request->input('receiveReference');
        $receive->product = $request->input('receiveProduct');
        $receive->quantity = $request->input('receiveQuantity');
        $receive->dateReceived = $request->input('receiveDateReceived');
        $receive->expired = $request->input('receiveExpired');
        $receive->amount = $request->input('receiveAmount');
        $receive->supplier = $request->input('receiveSupplier');
        
        $receive->save();

        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function deleteReceive($id)
    {
        $receive = Receive::find($id);

        if ($receive) {
            $receive->delete();
            return redirect()->back()->with('success', 'deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'not found.');
        }
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
