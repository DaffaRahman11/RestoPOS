<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('login.login');
});


Route::resource('/dashboard/ingredient', IngredientController::class)->except(['show']);
Route::resource('/dashboard/menu', MenuController::class)->except(['show']);
Route::resource('/dashboard/transaction', TransactionController::class)->only(['index','create', 'store']);
Route::get('/dashboard/products/data', [ProductController::class, 'getProductData']);

