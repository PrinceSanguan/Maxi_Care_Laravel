<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view ('staff.product-category');
    }

    public function productList()
    {
        return view ('staff.product-list');
    }

    public function expiredList()
    {
        return view ('staff.expired-list');
    }

    public function supplierList()
    {
        return view ('staff.supplier-list');
    }
}
