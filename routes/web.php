<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


use App\Models\Product;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\HomeController;
Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
})->name('home');

Route::get('/', [HomeController::class, 'index']);
// Cart and Checkout Routes
Route::resource('cart', CartController::class)->only(['index', 'store', 'destroy']);
Route::put('/cart/update-item/{id}', [CartController::class, 'updateItem'])->name('cart.updateItem');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('products.addToCart');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

// Product Routes
Route::name("products.")->prefix("products")->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
    Route::post('/update/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::name("categories.")->prefix("categories")->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('/update/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});



Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');

    Route::resource('coupons', CouponController::class);


Route::name("roles.")->prefix("roles")->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('edit');
    Route::post('/update/{role}', [RoleController::class, 'update'])->name('update');
    Route::delete('/delete/{role}', [RoleController::class, 'destroy'])->name('destroy');
});


//roles
//Route::get('/roles/index', [RoleController::class, 'index'])->name('roles.index');
//Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
//Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
//Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
//Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
//Route::get('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

//users
Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}', function ($id) {
    $user = User::find($id);
    return view('users.show', compact('user'));
})->name('users.show');


Route::name("reviews.")->prefix("reviews")->group(function () {
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('/create', [ReviewController::class, 'create'])->name('create');
    Route::post('/', [ReviewController::class, 'store'])->name('store');
    Route::get('/edit/{review}', [ReviewController::class, 'edit'])->name('edit');
    Route::post('/update/{review}', [ReviewController::class, 'update'])->name('update');
    Route::delete('/delete/{review}', [ReviewController::class, 'destroy'])->name('destroy');
    Route::get('/{review}', [ReviewController::class, 'show'])->name('show');       
});