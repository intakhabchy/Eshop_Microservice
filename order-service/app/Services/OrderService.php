<?php
namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Http;

class OrderService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder($data)
    {
        $userId = $data['user_id'];
        $cartId = $data['cart_id'];

        $total_price = 0;
        foreach ($data['items'] as $item) {
            $total_price += $item['quantity'] * $item['unit_price'];
        }

        $data['total_price'] = $total_price;
        $data['vat'] = $total_price * 0.15;
        $data['payable_price'] = $total_price + $data['vat'];
        $data['tracking_id'] = 'TRK' . rand(100000, 999999);

        $response = Http::get("http://localhost:8001/api/user/".$userId);
        $user = $response->json();
        $shippingAddress = $user['profile']['shipping_address'];
        $data['shipping_address'] = $shippingAddress;

        return $this->orderRepository->createOrder($data);
    }

    public function getOrderById($id, $userId)
    {
        return $this->orderRepository->getOrderById($id, $userId);
    }

    public function getAllOrders($userId)
    {
        return $this->orderRepository->getAllOrders($userId);
    }
}