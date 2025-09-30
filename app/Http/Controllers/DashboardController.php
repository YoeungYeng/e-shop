<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // index
    public function index(){
        // count value
        $categories = Category::count();
        $products = Product::count();
        $users = User::count();
        return view('dashboard', compact('categories', 'products', 'users'));
    }
}
