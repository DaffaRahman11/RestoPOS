<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/menus/getData', [MenuController::class, 'getMenuData']);
