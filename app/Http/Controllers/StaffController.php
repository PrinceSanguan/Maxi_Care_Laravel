<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Receive;
use App\Models\Sales;
use App\Models\Stock;
use Carbon\Carbon; // Make sure to include Carbon for date handling
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkStaffRole');
    }

    public function index()
    {
        // Fetch the total sales amount for the current day
        $salesToday = Sales::whereDate('created_at', Carbon::today())
            ->sum('amount');
    
        // Fetch the total sales amount for the current month
        $salesMonth = Sales::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');
    
        // Format the date and month
        $todayDate = Carbon::today()->format('m-d-Y'); // e.g., 06-24-2024
        $currentMonth = Carbon::now()->format('F'); // e.g., June
    
        // Pass the formatted date and month to the view
        return view('staff.home', compact('salesToday', 'salesMonth', 'todayDate', 'currentMonth'));
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
            'productName' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Generate the reference number
        $reference = $this->generateReferenceNumber();
    
        // Get the product amount from the Receive database using productName
        $receive = Receive::where('product', $request->input('productName'))->first();
        
        if (!$receive) {
            return redirect()->route('staff.sales')->with('error', 'Product not found in Receive records.');
        }
    
        $price = $receive->amount; // Price fetched from the Receive model
        $totalAmount = $price * $request->input('quantity'); // Calculate total amount for the sale
    
        // Start a transaction to ensure atomicity
        DB::beginTransaction();
    
        try {
            // Create a new sales record
            $sales = Sales::create([
                'reference' => $reference,
                'productName' => $request->input('productName'),
                'quantity' => $request->input('quantity'),
                'price' => $price, // Use the price fetched from the Receive model
                'amount' => $totalAmount,
            ]);
    
            // Update the stock based on the name of product
            $stock = Stock::where('productName', $request->input('productName'))->first();
            
            if ($stock) {
                if ($stock->stockAvailable < $request->input('quantity')) {
                    // Rollback transaction and return an error if not enough stock is available
                    DB::rollBack();
                    return redirect()->route('staff.sales')->with('error', 'Not enough stock available.');
                }
    
                $stock->stockOut += $request->input('quantity'); // Increment stockOut
                $stock->stockAvailable -= $request->input('quantity'); // Decrement stockAvailable
                $stock->save();
            } else {
                // Rollback transaction and return an error if no stock record is found
                DB::rollBack();
                return redirect()->route('staff.sales')->with('error', 'Stock record not found.');
            }
    
            // Commit the transaction
            DB::commit();
    
        } catch (\Exception $e) {
            // Rollback the transaction in case of any exception
            DB::rollBack();
            return redirect()->route('staff.sales')->with('error', 'Failed to create a sale: ' . $e->getMessage());
        }
    
        // Redirect with success message
        return redirect()->route('staff.sales')->with('success', 'Sale successfully created.');
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
        // Fetch suppliers and product names
        $suppliers = Supplier::all();
        $productNames = Medicine::all();
    
        // Fetch records where the expiration date is greater than today's date
        $receives = Receive::where('expired', '>', Carbon::now())->get();
    
        // Return view with the filtered receives
        return view('staff.receiving', compact('suppliers', 'receives', 'productNames'));
    }

    public function receiveForm(Request $request)
    {
        // Validate the request input
        $request->validate([
            'supplier' => 'required|string|max:255',
            'product' => 'required',
            'quantity' => 'required|integer|min:1',
            'dateReceived' => 'required|date',
            'expired' => 'required|date', // If in production, you can use 'expired' => 'required|date|after:today'
            'stockType' => 'required|in:safetyStock,stockAvailable',
        ]);
    
        // Find the product category in Medicine database based on input product
        $productName = $request->input('product');
        $productCategory = Medicine::where('productName', $productName)->first();
    
        if ($productCategory) {
            $category = $productCategory->category;
            $price = $productCategory->price;
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        // Generate the reference number
        $reference = $this->generateReferenceNumber();
    
        // Determine stock quantities
        $stockType = $request->input('stockType');
        $quantity = $request->input('quantity');
        $safetyStock = 0;
        $stockAvailable = 0;
    
        if ($stockType === 'safetyStock') {
            $safetyStock = $quantity;
        } elseif ($stockType === 'stockAvailable') {
            $stockAvailable = $quantity;
        }
    
        // Save to Receive database
        $receive = Receive::create([
            'supplier' => $request->input('supplier'),
            'product' => $productName,
            'reference' => $reference,
            'quantity' => $quantity,
            'safetyStock' => $safetyStock,
            'stockAvailable' => $stockAvailable,
            'amount' => $price,
            'dateReceived' => $request->input('dateReceived'),
            'productCategory' => $category,
            'expired' => $request->input('expired'),
        ]);
    
        // Save to Stock database
        Stock::create([
            'productName' => $productName,
            'reference' => $reference,
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
    
    private function generateReferenceNumber()
    {
        // Get today's date in MMDDYYYY format
        $today = Carbon::now()->format('mdY');
        
        // Find the highest reference number for today
        $latestReference = Receive::whereRaw('SUBSTR(reference, 1, 8) = ?', [$today])
                                   ->orderBy('reference', 'desc')
                                   ->first();
        
        if ($latestReference) {
            // Extract the numeric part and increment
            $lastNumber = intval(substr($latestReference->reference, 8));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // Start with 001 if no records exist for today
            $newNumber = '001';
        }
    
        return $today . $newNumber;
    }
    
    public function updateReceive(Request $request)
    {


        // Find the product category in Medicine database based on input product in Receive Database
        $productName = $request->input('receiveProduct');
        $productCategory = Medicine::where('productName', $productName)->first();

          if ($productCategory) {
            // Product found, you can access $productCategory attributes
            $category = $productCategory->category; 
            $price = $productCategory->price;
        } else {
            // Handle the case where no product is found
            return redirect()->back()->with('error', 'Product not found.');
        }

        $receive = Receive::find($request->input('receiveId'));
        $receive->reference = $request->input('receiveReference');
        $receive->product = $request->input('receiveProduct');
        $receive->quantity = $request->input('receiveQuantity');
        $receive->dateReceived = $request->input('receiveDateReceived');
        $receive->expired = $request->input('receiveExpired');
        $receive->amount = $price;
        $receive->supplier = $request->input('receiveSupplier');
        $receive->productCategory = $category;
        
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
            'productName' => 'required',
            'productInformation' => 'required',
            'price' => 'required',
        ]);
    
        // Get the prescription input or default to 'off' if null
        $prescription = $request->input('prescription', 'off');
    
        // Saving in the database
        $medicine = Medicine::create([
            'category' => $request->input('category'),
            'productName' => $request->input('productName'),
            'productInformation' => $request->input('productInformation'),
            'prescription' => $prescription,
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
        $medicine->productName = $request->input('medicineProduct');
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
        // Fetch records where the expiration date is less than or equal to today's date and time
        $receives = Receive::where('expired', '<=', Carbon::now()->endOfDay())->get();
    
        if ($receives->isEmpty()) {
            return view('staff.expired-list', [
                'receives' => $receives, // Pass the variable to the view
                'info' => 'No expired items found.'
            ]);
        }
    
        $errorMessage = null;
    
        foreach ($receives as $receive) {
            // Find the corresponding stock record
            $stock = Stock::where('reference', $receive->reference)->first();
            
            if ($stock) {
                // Update the stock record
                $remainingStock = $stock->stockAvailable;
                $stock->expired = $remainingStock;
                $stock->stockAvailable = 0;
                $stock->save();
            } else {
                // Set an error message if stock record is not found
                $errorMessage = 'Stock record not found for reference: ' . $receive->reference;
                // Continue processing remaining records even if one fails
            }
        }
    
        // Return the view with a success or error message
        return view('staff.expired-list', [
            'receives' => $receives,
            'success' => 'Expired items updated successfully.',
            'error' => $errorMessage
        ]);
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
