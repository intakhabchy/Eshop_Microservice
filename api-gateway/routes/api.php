<?php

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users/test', function(){
    return Http::get('http://localhost:8001/api/test')->json();
});

Route::post('/users/login', function(){
    $response = Http::post('http://localhost:8001/api/login', request()->all());
    return response()->json($response->json(), $response->status());
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


// ------- Product Service -------
Route::get('/product/brands', function(){
    return Http::get('http://localhost:8002/api/brands')->json();
});

Route::get('/product/brands/{id}', function($id){
    return Http::get('http://localhost:8002/api/brands/'.$id)->json();
});

Route::post('/product/brands', function(){
    $response = Http::post('http://localhost:8002/api/brands', request()->all());
    return response()->json($response->json(), $response->status());
});

Route::put('/product/brands/{id}', function($id){
    $response = Http::put('http://localhost:8002/api/brands/'.$id, request()->all());
    return response()->json($response->json(), $response->status());
});

Route::delete('/product/brands/{id}', function($id){
    $response = Http::delete('http://localhost:8002/api/brands/'.$id);
    return response()->json($response->json(), $response->status());
});

Route::get('/product/categories', function(){
    return Http::get('http://localhost:8002/api/categories')->json();
});

Route::get('/product/categories/{id}', function($id){
    return Http::get('http://localhost:8002/api/categories/'.$id)->json();
});

Route::post('/product/categories', function(){
    $response = Http::post('http://localhost:8002/api/categories', request()->all());
    return response()->json($response->json(), $response->status());
});

Route::put('/product/categories/{id}', function($id){
    $response = Http::put('http://localhost:8002/api/categories/'.$id, request()->all());
    return response()->json($response->json(), $response->status());
});

Route::delete('/product/categories/{id}', function($id){
    $response = Http::delete('http://localhost:8002/api/categories/'.$id);
    return response()->json($response->json(), $response->status());
});

Route::get('/product/suppliers', function(){
    return Http::get('http://localhost:8002/api/suppliers')->json();
});

Route::get('/product/suppliers/{id}', function($id){
    return Http::get('http://localhost:8002/api/suppliers/'.$id)->json();
});

Route::post('/product/suppliers', function(){
    $response = Http::post('http://localhost:8002/api/suppliers', request()->all());
    return response()->json($response->json(), $response->status());
});

Route::put('/product/suppliers/{id}', function($id){
    $response = Http::put('http://localhost:8002/api/suppliers/'.$id, request()->all());
    return response()->json($response->json(), $response->status());
});

Route::delete('/product/suppliers/{id}', function($id){
    $response = Http::delete('http://localhost:8002/api/suppliers/'.$id);
    return response()->json($response->json(), $response->status());
});

Route::get('/product/products', function(){
    return Http::get('http://localhost:8002/api/products')->json();
});

Route::get('/product/products/{id}', function($id){
    return Http::get('http://localhost:8002/api/products/'.$id)->json();
});

Route::post('/product/products', function(){
    $response = Http::post('http://localhost:8002/api/products', request()->all());
    return response()->json($response->json(), $response->status());
});

Route::put('/product/products/{id}', function($id){
    $response = Http::put('http://localhost:8002/api/products/'.$id, request()->all());
    return response()->json($response->json(), $response->status());
});

Route::delete('/product/products/{id}', function($id){
    $response = Http::delete('http://localhost:8002/api/products/'.$id);
    return response()->json($response->json(), $response->status());
});

Route::get('/product/reviews', function(){
    return Http::get('http://localhost:8002/api/reviews')->json();
});

Route::post('/product/reviews', function(){
    $response = Http::post('http://localhost:8002/api/reviews', request()->all());
    return response()->json($response->json(), $response->status());
});

Route::get('/product/reviews/{id}', function($id){
    return Http::get('http://localhost:8002/api/reviews/'.$id)->json();
});

Route::post('/product/stock-in', function(){
    $response = Http::post('http://localhost:8002/api/stock-in', request()->all());
    return response()->json($response->json(), $response->status());
});

Route::post('/product/stock-out', function(){
    $response = Http::post('http://localhost:8002/api/stock-out', request()->all());
    return response()->json($response->json(), $response->status());
});

// ------- // Product Service -------

// ------- Cart Service -------

Route::post('/cart/add-to-cart', function(){
    return Http::post('http://localhost:8003/api/add-to-cart', request()->all());
});
Route::delete('/cart/delete-cart/{cart_id}', function($cart_id){
    return Http::delete('http://localhost:8003/api/delete-cart/'.$cart_id);
});

Route::get('/cart/cart-items/{cart_id}', function($cart_id){
    return Http::get('http://localhost:8003/api/cart-items/'.$cart_id);
});
Route::delete('/cart/delete-cart-item/{cart_item_id}', function($cart_item_id){
    return Http::delete('http://localhost:8003/api/delete-cart-item/'.$cart_item_id);
});

// ------- // Cart Service -------

// ------- Order Service -------
Route::post('/order/orders', function(){
    return Http::post('http://localhost:8004/api/orders', request()->all());
});

Route::get('/order/orders/{user_id}', function($userId){
    return Http::get('http://localhost:8004/api/orders/'.$userId);
});

Route::get('/order/orders/{id}/{user_id}', function($id,$userId){
    return Http::get('http://localhost:8004/api/orders/'.$id.'/'.$userId);
});
// ------- // Order Service -------

// ------- Payment Service -------

Route::post('/payment/initiate', function(){
    return Http::post('http://localhost:8005/api/initiate', request()->all());
});

// ------- // Payment Service -------


Route::get('/notification/test', function(){
    return Http::get('http://localhost:8006/api/test')->json();
});