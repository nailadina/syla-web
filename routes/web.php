<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something  great!
|
*/

Route::get('/', function () {
    return view('auth.loginPage');
});

Route::get('dashboard', function(){
    return view('layout.base');
});

// CRUD Category
Route::get('dashboard/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('dashboard/category', [CategoryController::class, 'store'])->name('category.store');
Route::delete('dashboard/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('dashboard/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::patch('dashboard/category/{id}', [CategoryController::class, 'update'])->name('category.update');

//CRUD Product
Route::get('dashboard/product/admin', [ProductController::class, 'admin']);
Route::get('dashboard/product/create', [ProductController::class, 'create']);
Route::post('dashboard/product', [ProductController::class, 'store']);
Route::get('dashboard/product/{product_id}/edit', [ProductController::class, 'edit']);
Route::put('dashboard/product/{product_id}', [ProductController::class, 'update']);
Route::delete('dashboard/product/{product_id}', [ProductController::class, 'destroy']);

//Cart
Route::post('/add-to-cart/{user_id}/{product_id}', [CartController::class, 'addToCart']);
Route::post('/subtract-quntity/{user_id}/{product_id}', [CartController::class, 'subtractCartItemQuantity']);
Route::post('/add-quntity/{user_id}/{product_id}', [CartController::class, 'addCartItemQuantity']);
// Route::get('/product', [CartController::class, 'index']);

//Order
Route::get('/checkout', [OrderController::class, 'index']);
Route::post('/order', [OrderController::class, 'store']);
// Route::get('/myorders', [CustomerController::class, 'order_index']);

//Update Profile
// Route::get('/profile/{id}/show', [ProfileController::class, 'index']);
Route::patch('/profile/{id}', [ProfileController::class, 'update']);

Route::get('/profile/{id}/show', function(){
    return view('profile.index');
});

 Route::get('/logout', function() {
 Session::forget('key');
  if(!Session::has('key'))
   {
      return redirect('/');
   }
 });

Auth::routes();

Route::get('/product', [CartController::class, 'index']);
