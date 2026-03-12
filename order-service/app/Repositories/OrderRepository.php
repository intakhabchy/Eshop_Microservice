<?php
namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function createOrder($data)
    {
        return Order::class::create($data);
    }
}