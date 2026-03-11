<?php

namespace App\Http\Controllers;

use App\Services\CartItemService;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    private $cartItemService;

    public function __construct(CartItemService $cartItemService)
    {
        $this->cartItemService = $cartItemService;
    }

    public function getCartItems($cart_id)
    {
        return $this->cartItemService->getCartItems($cart_id);
    }

    public function deleteCartItem($cartItemId)
    {
        return $this->cartItemService->deleteCartItem($cartItemId);
    }
}
