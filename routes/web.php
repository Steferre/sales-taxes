<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\shoppingBasketController;

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

/* Route::get('/', function () {
    return view('bill.index');
}); */

Route::get('/', [shoppingBasketController::class, 'index'])->name('bill.index');
Route::post('/', [shoppingBasketController::class, 'store'])->name('bill.store');
Route::get('/create', [shoppingBasketController::class, 'create'])->name('bill.create');
Route::get('/{id}', [shoppingBasketController::class, 'show'])->name('bill.show');