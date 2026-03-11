<?php

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::get('/cart-items/{cart_id}', [CartController::class, 'getCartItems']);
Route::delete('/delete-cart-item/{cart_item_id}', [CartController::class, 'deleteCartItem']);
Route::delete('/delete-cart/{cart_id}', [CartController::class, 'deleteCart']);