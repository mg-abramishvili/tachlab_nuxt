<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// FRONT
Route::get('products','App\Http\Controllers\Front\ProductController@index');
Route::get('product/{id}','App\Http\Controllers\Front\ProductController@product_item');

Route::get('categories','App\Http\Controllers\Front\CategoryController@index');
Route::get('category/{id}','App\Http\Controllers\Front\CategoryController@category_item');

Route::get('category/{id}/products','App\Http\Controllers\Front\ProductController@products_by_category');

// ADMIN
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', LoginController::class);