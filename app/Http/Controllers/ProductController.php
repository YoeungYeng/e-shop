<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index ()
    {
        $products = Product::all ();
        return view ('products.index', compact ('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create ()
    {
        $categories = Category::all ();
        return view ('products.create', compact ('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (StoreProductRequest $request)
    {
        try {
            $products = $request->validated ();
            // upload image
            if ($request->hasFile ("image")) {
                $products["image"] = $request->file ("image")->store ("images", "public");
            }
            // products
            Product::create ($products);

            return redirect ()->route ('product.index');
        } catch (Exception $e) {
            
            return view ('errors.custom', [
                'message' => 'News not found.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show (Product $product)
    {
        $products = Product::find ($product);
        return view ('products.show', compact ('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit (Product $product)
    {
        $categories = Category::all ();
        return view ('products.edit', compact ('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update (UpdateProductRequest $request, Product $product)
    {
        $products = $request->validated();
        if ($request->hasFile ("image")) {
            $products["image"] = $request->file ("image")->store ("images", "public");

        }
        $product->update ($products);
        return redirect ()->route ('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy (Product $product)
    {
        $product->delete();
        return redirect ()->route ('product.index');
    }
}
