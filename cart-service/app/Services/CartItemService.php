<?php
namespace App\Services;

use App\Repositories\CartItemRepository;

class CartItemService
{
    private $cartItemRepository;

    public function __construct(CartItemRepository $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    public function getCartItems($cart_id)
    {
        return $this->cartItemRepository->getCartItemsByCartId($cart_id);
    }

    public function deleteCartItem($cartItemId)
    {
        $this->cartItemRepository->deleteCartItemsByCartItemId($cartItemId);
        return response()->json(['message' => 'Product deleted from cart successfully']);
    }
}