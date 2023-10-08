<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\BookController;

Route::get('/dashboard', [BookController::class, 'dashboard']);
Route::post('/dashboard/search', [BookController::class, 'search']);
Route::post('/add-book', [BookController::class, 'addBook']);

use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'viewCart']);
Route::post('/add-to-cart/{book}', [CartController::class, 'addToCart']);
Route::post('/remove-from-cart/{book}', [CartController::class, 'removeFromCart']);
Route::get('/checkout', [CartController::class, 'checkout']);
Route::post('/checkout', [CartController::class, 'processCheckout']);


Route::get('/', function () {
    return view('welcome');
});
