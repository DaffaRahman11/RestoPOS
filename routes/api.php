<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products/getData', [ProductController::class, 'getProductData']);
