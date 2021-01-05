<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SaleController extends Controller
{
    public function index()
    {
        $products = Product::where('available', '!=', 0)->get();
        return view('sale', compact('products'));
    }
}
