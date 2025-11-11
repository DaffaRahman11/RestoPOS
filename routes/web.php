<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\TransactionController;


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth']);
Route::resource('/dashboard/ingredient', IngredientController::class)->except(['show'])->middleware(['auth']);
Route::resource('/dashboard/menu', MenuController::class)->except(['show'])->middleware(['auth']);
Route::resource('/dashboard/transaction', TransactionController::class)->only(['index','create', 'store'])->middleware(['auth']);
Route::get('/dashboard/products/data', [MenuController::class, 'getProductData']);

