<?php

namespace App\Http\Controllers\font;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;


class CategoryController extends Controller
{
    // get all Category
    public function getAllCategory()
    {
        $endTime = Carbon::now()->addDay()->setTime(12, 0, 0)->toIso8601String();
        $categories = Category::all();
        $products = Product::all();

        return view('welcome', compact('categories', 'endTime', 'products'));
    }

    // show product detail
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // view cart
    public function cart()
    {
        return view('cart.index');
    }

    // add to cart
    public function addToCart($id)
    {
        // check if product exists
        $product = Product::findOrFail($id);
        if (!$product) {
            abort(404);
        }

        // Get cart from session
        $cart = session()->get('cart', []);

        // Add or update product in cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'sale_price' => $product->sale_price,
                'quantity' => 1,
                'image' => $product->image,

            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart(Product $product)
    {
        // check if product exists
        if (!$product) {
            abort(404);
        }

        // Get cart from session
        $cart = session()->get('cart', []);

        // If product exists in cart
        if (isset($cart[$product->id])) {
            // Decrease quantity
            $cart[$product->id]['quantity']--;

            // If quantity hits 0, remove product entirely
            if ($cart[$product->id]['quantity'] <= 0) {
                unset($cart[$product->id]);
            }

            session()->put('cart', $cart);
        }

        return redirect()->route("product.show", $product->id);
    }


}
