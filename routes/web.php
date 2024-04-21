<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('products/', 'index')->name('products.index');
    Route::get('products/create', 'create')->name('products.create');
    Route::post('products/store', 'store')->name('products.store');
    Route::get('products/edit/{product}', 'edit')->name('products.edit');
    Route::put('products/{product}', 'update')->name('products.update');
    Route::delete('products/{product}', 'destroy')->name('products.destroy');
});