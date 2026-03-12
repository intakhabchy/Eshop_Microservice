<?php
namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function createOrder($data)
    {
        return Order::class::create($data);
    }

    public function getOrderById($id)
    {
        // return Order::class::find($id);
        return Order::class::with('orderDetails')->find($id);
    }

    public function getAllOrders()
    {
        return Order::class::with('orderDetails')->get();
    }
}