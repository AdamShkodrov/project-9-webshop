<?php
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


use App\Models\Product;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);//
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
    Route::get('/detail/{product}', [ProductController::class, 'detail'])->name('detail');
});

Route::middleware('auth')->name('products.')->group(function () {
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
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
Route::get('/roles/index', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::get('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

//users
Route::name("users.")->prefix("users")->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::post('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/show/{user}', [UserController::class, 'show'])->name('show');
});



Route::name("reviews.")->prefix("reviews")->group(function () {
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('/create', [ReviewController::class, 'create'])->name('create');
    Route::post('/', [ReviewController::class, 'store'])->name('store');
    Route::get('/edit/{review}', [ReviewController::class, 'edit'])->name('edit');
    Route::post('/update/{review}', [ReviewController::class, 'update'])->name('update');
    Route::delete('/delete/{review}', [ReviewController::class, 'destroy'])->name('destroy');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
