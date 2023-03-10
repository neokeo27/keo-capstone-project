<?php

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
Route::resource('cart', App\Http\Controllers\CartController::class);
Route::resource('productView', App\Http\Controllers\ProductViewController::class);

Route::get('/', function () {
    return view('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products/{category_id}', [App\Http\Controllers\ProductsController::class, 'products']);
