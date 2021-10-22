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
Route::get('admin/products','App\Http\Controllers\Admin\ProductController@index');
Route::get('admin/product/{id}','App\Http\Controllers\Admin\ProductController@product_item');
Route::post('admin/product/{id}','App\Http\Controllers\Admin\ProductController@product_update');
Route::post('admin/products/add_image_upload','App\Http\Controllers\Admin\ProductController@add_image_store');

Route::get('admin/categories','App\Http\Controllers\Admin\CategoryController@index');
Route::get('admin/category/{id}','App\Http\Controllers\Admin\CategoryController@category_item');

Route::get('admin/category/{id}/products','App\Http\Controllers\Admin\ProductController@products_by_category');

// AUTH
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', LoginController::class);