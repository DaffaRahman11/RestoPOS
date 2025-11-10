<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

Route::get('/login', function () {
    return view('login');
});


Route::resource('/dashboard/product', ProductController::class)->except(['show']);
Route::resource('/dashboard/transaction', TransactionController::class)->only(['index','create', 'store']);
Route::get('/dashboard/products/data', [ProductController::class, 'getProductData']);

