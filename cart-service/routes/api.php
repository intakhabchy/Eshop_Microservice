<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/add-to-cart', [CartController::class, 'addToCart']);
Route::delete('/delete-cart/{cart_id}', [CartController::class, 'deleteCart']);

Route::get('/cart-items/{cart_id}', [CartItemController::class, 'getCartItems']);
Route::delete('/delete-cart-item/{cart_item_id}', [CartItemController::class, 'deleteCartItem']);
