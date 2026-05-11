<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;

Route::apiResource('brands', BrandController::class);
Route::apiResource('products', ProductController::class);