<?php

use App\Console\Consumers\PaymentSuccessConsumer;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/payment-success', [NotificationController::class, 'paymentSuccess']);

Route::get('/consume', function () {
    (new PaymentSuccessConsumer())->consume();
});