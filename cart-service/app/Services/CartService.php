<?php
namespace App\Services;

use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;

class CartService
{
    private $cartRepository;
    private $cartItemRepository;

    public function __construct(CartRepository $cartRepository, CartItemRepository $cartItemRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
    }
    
    public function addToCart($request)
    {
        $userId = $request->user_id;
        $productId = $request->product_id;
        $qty = $request->qty;
        $price = $request->price;
        $color = $request->color;
        $size = $request->size;

        // get pending count of cart
        $countCart = $this->cartRepository->getCartByUserId($userId, 'pending');

        if($countCart == 0)
            $cart = $this->cartRepository->addToCart($userId);        
        else if($countCart == 1)
            $cart = $this->cartRepository->getCartByUserIdAndStatus($userId, 'pending');
        
        $cartId = $cart->id;

        // add the product to the cart_items table with the cart_id and product_id

        $countCartItems = $this->cartItemRepository->countCartItemsByCartIdAndProductId($cartId, $productId);

        if($countCartItems == 0){
            $this->cartItemRepository->addToCartItem($cartId, $productId, $qty, $price, $color, $size);
        }
        else
        {
            $cartItem = $this->cartItemRepository->getCartItemByCartIdAndProductId($cartId, $productId);
            $newQty = $cartItem->qty + $qty;
            $this->cartItemRepository->updateCartItem($cartItem->id, $newQty);
        }

        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function deleteCart($cartId)
    {
        // delete all data from item and cart table with the cart_id
        $deleteCartItem = $this->cartItemRepository->deleteCartItemsByCartId($cartId);
        $deleteCart = $this->cartRepository->deleteCart($cartId);

        if($deleteCart && $deleteCartItem)
            return response()->json(['message' => 'Cart deleted successfully']);
        else
            return response()->json(['message' => 'Cart deletion failed']);
    }

    public function updateCartStatus($cartId, $status): bool
    {
        return $this->cartRepository->updateCartStatus($cartId, $status);
    }
}