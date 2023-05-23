<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
//Home
Route::get('/',[HomeController::class, "index"])->name('home');
//Product

Route::prefix('/product')->group(function(){
    Route::get('/', [ProductController::class, "index"])->name('product');
    Route::post('/store',[ProductController::class, "store"])->name('product.store');
    Route::get('/{item_id}/delete',[ProductController::class, "delete"])->name('product.delete');
    Route::get('/edit',[ProductController::class, "edit"])->name('product.edit');
    Route::post('/{item_id}/update',[ProductController::class, "update"])->name('product.update');
    Route::get('/{item_id}/status',[ProductController::class, "status"])->name('product.status');

});