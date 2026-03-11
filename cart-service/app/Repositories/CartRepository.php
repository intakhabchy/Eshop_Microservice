<?php
namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function addToCart($userId, $cartStatus = 'pending')
    {
        $cart = Cart::create(['user_id' => $userId,'cart_status' => $cartStatus]);
        return $cart;
    }

    public function getCartByUserId($userId,$cartStatus)
    {
        return Cart::where('user_id', $userId)->where('cart_status',$cartStatus)->count();
    }

    public function getCartByUserIdAndStatus($userId, $cartStatus)
    {
        return Cart::where('user_id', $userId)->where('cart_status', $cartStatus)->latest()->first();
    }

    public function deleteCart($cartId)
    {
        return Cart::where('id', $cartId)->delete();
    }
}