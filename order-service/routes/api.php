<?php


use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/{user_id}', [OrderController::class, 'index']);
Route::get('/orders/{id}/{user_id}', [OrderController::class, 'show']);
Route::put('/update-payment-status/{id}', [OrderController::class, 'updatePaymentStatus']);