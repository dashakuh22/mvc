<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

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

Route::get('/', [CatalogController::class, 'index']);

Route::get('/cart', [CartController::class, 'index']);

Route::post('/add', [CartController::class, 'addToCart']);

Route::get('/buy', [CartController::class, 'removeFromCart']);

Route::get('/category/{category}', [CatalogController::class, 'show'])->whereAlpha('category');
