<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users/test', function(){
    return Http::get('http://localhost:8001/api/test')->json();
});

Route::post('/users/user_registration', function(){
    $response = Http::post('http://localhost:8001/api/user_registration', request()->all());
    return response()->json($response->json(), $response->status());
});

Route::get('/users/user/{id}', function($id){
    return Http::get('http://localhost:8001/api/user/'.$id)->json();
});

Route::get('/users/rolelist', function(){
    return Http::get('http://localhost:8001/api/rolelist')->json();
});

Route::get('/product/test', function(){
    return Http::get('http://localhost:8002/api/test')->json();
});

Route::get('/cart/test', function(){
    return Http::get('http://localhost:8003/api/test')->json();
});

Route::get('/order/test', function(){
    return Http::get('http://localhost:8004/api/test')->json();
});

Route::get('/payment/test', function(){
    return Http::get('http://localhost:8005/api/test')->json();
});

Route::get('/notification/test', function(){
    return Http::get('http://localhost:8006/api/test')->json();
});