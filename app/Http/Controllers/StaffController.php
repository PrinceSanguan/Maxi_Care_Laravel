<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Receive;
use App\Models\Sales;
use App\Models\Stock;

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
    
        // get the information from the table Stock
        $stocks = Stock::all();

        // Pass the product name to the view
        return view('staff.stock', compact('stocks'));
    }

    public function sales()
    {
        // Fetch all sales records
        $sales = Sales::all();

        // Fetch records from the Stock table where quantity is greater than 0
        $stocks = Stock::where('stockAvailable', '>', 0)->get();

        // Pass both sales and receives data to the view
        return view('staff.sales', compact('sales', 'stocks'));
    }

    public function newSales(Request $request)
    {
        // Validate the request input
        $request->validate([
            'reference' => 'required|string|max:255',
            'productName' => 'required|string|max:255', // Ensure this is a string
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Get the product amount from the Receive database using productName
        $receive = Receive::where('product', $request->input('productName'))->first();
    
        if (!$receive) {
            return redirect()->route('staff.sales')->with('error', 'Product not found in Receive records.');
        }
    
        $price = $receive->amount; // Price fetched from the Receive model
        $totalAmount = $price * $request->input('quantity'); // Calculate total amount for the sale
    
        // Create a new sales record
        $sales = Sales::create([
            'reference' => $request->input('reference'),
            'productName' => $request->input('productName'),
            'quantity' => $request->input('quantity'),
            'price' => $price, // Use the price fetched from the Receive model
            'amount' => $totalAmount,
        ]);
    
        // Update the stock based on the product name
        $stock = Stock::where('productName', $request->input('productName'))->first();
    
        if ($stock) {
            $stock->stockOut += $request->input('quantity'); // Increment stockOut
            $stock->stockAvailable -= $request->input('quantity'); // Decrement stockAvailable
            $stock->save();
        } else {
            return redirect()->route('staff.sales')->with('error', 'Stock record not found.');
        }
    
        if (!$sales) {
            return redirect()->route('staff.sales')->with('error', 'Failed to create a sale.');
        }
    
        // Redirect with success message
        return redirect()->route('staff.sales')->with('success', 'Sale successfully created.');
    }

    public function updateSales(Request $request)
    {
        $sales = Sales::find($request->input('salesId'));
        $sales->reference = $request->input('salesReference');
        $sales->productName = $request->input('salesProductName');
        $sales->quantity = $request->input('salesQuantity');
        $sales->price = $request->input('salesPrice');
        $sales->amount = $request->input('salesPrice') * $request->input('salesQuantity');
        
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
            'supplier' => 'required|string|max:255',
            'product' => 'required|string|max:255|unique:receives,product',
            'reference' => 'required|string|max:255|unique:receives,reference',
            'quantity' => 'required|integer|min:1',
            'amount' => 'required|numeric|min:0',
            'dateReceived' => 'required|date',
            'expired' => 'required|date|after:today',
            'stockType' => 'required|in:safetyStock,stockAvailable', // Ensure stockType is one of the allowed values
        ]);
    
        $stockType = $request->input('stockType');
        $quantity = $request->input('quantity');
    
        // Set default values for safetyStock and stockAvailable
        $safetyStock = 0;
        $stockAvailable = 0;
    
        // Assign quantity to the relevant stock type
        if ($stockType === 'safetyStock') {
            $safetyStock = $quantity;
        } elseif ($stockType === 'stockAvailable') {
            $stockAvailable = $quantity;
        }
    
        // Saving in the database
        $receive = Receive::create([
            'supplier' => $request->input('supplier'),
            'product' => $request->input('product'),
            'reference' => $request->input('reference'),
            'quantity' => $quantity,
            'safetyStock' => $safetyStock,
            'stockAvailable' => $stockAvailable,
            'amount' => $request->input('amount'),
            'dateReceived' => $request->input('dateReceived'),
            'expired' => $request->input('expired'),
        ]);

        // Saving in the Stock Database
        Stock::create([
            'productName' => $request->input('product'),
            'reference' => $request->input('reference'),
            'stockIn' => $quantity,
            'stockOut' => 0,
            'expired' => 0,
            'stockAvailable' => $stockAvailable,
            'safetyStock' => $safetyStock,
        ]);
        

    
        if (!$receive) {
            return redirect()->route('staff.receiving')->with('error', 'Failed to receive a product.');
        }
    
        // Redirect with success message
        return redirect()->route('staff.receiving')->with('success', 'You have successfully received a product.');
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


    // Find the Stock record reference
    $stock = Stock::where('reference', $request->input('receiveReference'))->first();


        if (!$stock) {
            return redirect()->back()->with('error', 'Stock record not found');
        }

        // update the stock!
    
        $stock->productName = $request->input('receiveProduct');
        $stock->stockIn = $request->input('receiveQuantity');
        $stock->save();

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
