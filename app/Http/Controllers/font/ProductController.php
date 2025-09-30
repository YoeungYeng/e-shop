<?php

namespace App\Http\Controllers\font;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function getAllProducts(){
        $products = Product::all();
        return view ('welcome', compact('products'));
    }
}
