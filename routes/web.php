<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories', [CategoryController::class, 'showCategoriesWithItems']);
Route::get('/category-tree', [CategoryController::class, 'showCategoryTreeWithItems']);
