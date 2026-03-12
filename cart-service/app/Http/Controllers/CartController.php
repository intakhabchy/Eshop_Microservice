<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    
    public function addToCart(Request $request)
    {
        return $this->cartService->addToCart($request);
    }

    public function deleteCart($cartId)
    {
        return $this->cartService->deleteCart($cartId);
    }

    public function updateCartStatus($cartId, $status)
    {
        return $this->cartService->updateCartStatus($cartId, $status);
    }
}
