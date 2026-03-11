<?php
namespace App\Repositories;

use App\Models\CartItem;

class CartItemRepository
{
    public function addToCartItem($cartId, $productId, $qty, $price, $color, $size)
    {
        $cartItem = CartItem::create(['cart_id' => $cartId,'product_id' => $productId,'qty' => $qty,'price' => $price,'color' => $color,'size' => $size]);
        return $cartItem;
    }

    public function countCartItemsByCartIdAndProductId($cartId, $productId)
    {
        return CartItem::where('cart_id', $cartId)->where('product_id', $productId)->count();
    }

    public function getCartItemByCartIdAndProductId($cartId, $productId)
    {
        return CartItem::where('cart_id', $cartId)->where('product_id', $productId)->first();
    }

    public function updateCartItem($cartItemId, $qty)
    {
        $cartItem = CartItem::find($cartItemId);
        $cartItem->qty = $qty;
        $cartItem->save();
        return $cartItem;
    }

    public function getCartItemsByCartId($cartId)
    {
        return CartItem::where('cart_id', $cartId)->get();
    }

    public function deleteCartItemsByCartItemId($cartItemId)
    {
        return CartItem::where('id', $cartItemId)->delete();
    }

    public function deleteCartItemsByCartId($cartId)
    {
        return CartItem::where('cart_id', $cartId)->delete();
    }
}