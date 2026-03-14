<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/initiate', [PaymentController::class,'paymentInitiate']);
Route::put('/update-status/{id}', [PaymentController::class,'updatePaymentStatus']);
Route::post('/complete', [PaymentController::class, 'completePayment']);