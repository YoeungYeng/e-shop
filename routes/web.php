<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// fontend
Route::get ('/', [App\Http\Controllers\font\CategoryController::class, 'getAllCategory']);
// show product detail
Route::get ('/singleproduct/{product}', [App\Http\Controllers\font\CategoryController::class, 'getSingleProduct']);
// add to cart
Route::post ('/cart/add/{product}', [App\Http\Controllers\font\CategoryController::class, 'addToCart'])->name('cart.add');
Route::post ('/cart/remove/{product}', [App\Http\Controllers\font\CategoryController::class, 'removeFromCart'])->name('cart.remove');


Route::get ('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware (['auth', 'verified'])->name ('dashboard');

Route::middleware ('auth')->group (function () {
    Route::get ('/profile', [ProfileController::class, 'edit'])->name ('profile.edit');
    Route::patch ('/profile', [ProfileController::class, 'update'])->name ('profile.update');
    Route::delete ('/profile', [ProfileController::class, 'destroy'])->name ('profile.destroy');
    // category
//    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
//    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
//    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
//    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
//    Route::patch('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::resource ('/category', CategoryController::class);
    // products
    Route::resource ('/product', ProductController::class);
});


require __DIR__ . '/auth.php';
