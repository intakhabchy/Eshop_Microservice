<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['service' => 'User Service working']);
});

Route::post('/user_registration', [\App\Http\Controllers\UserController::class, 'user_registration']);

Route::get('/user/{id}',[\App\Http\Controllers\UserController::class, 'getUserById']);

Route::get('rolelist', [\App\Http\Controllers\RoleController::class, 'index']);