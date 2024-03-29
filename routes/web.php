<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('items', App\Http\Controllers\ItemController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('products', App\Http\Controllers\ProductsController::class);

Route::get('/', function () {
    return view('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products/{category_id}', [App\Http\Controllers\ProductsController::class, 'show'])->name('products');
Route::get('/products/{category_id}/{id}', [App\Http\Controllers\ProductsController::class, 'showItem'])->name('productView');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::get('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('addItem');
Route::delete('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('removeItem');
Route::put('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('updateCart');
Route::post('/cart-clear', [App\Http\Controllers\CartController::class, 'clearCart'])->name('clearCart');
Route::post('/check-order', [App\Http\Controllers\OrderController::class, 'checkOrder'])->name('checkOrder');
Route::get('/confirm', [App\Http\Controllers\OrderController::class, 'thanks'])->name('thanks');
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'orders'])->name('orders');
Route::get('/order/{order_id}', [App\Http\Controllers\OrderController::class, 'viewOrder'])->name('viewOrder');
