<?php
namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function createOrder($data)
    {
        return Order::class::create($data);
    }

    public function getOrderById($id, $userId)
    {
        return Order::with('orderDetails')->where('id', $id)->where('user_id', $userId)->first();
    }

    public function getAllOrders($userId)
    {
        return Order::with('orderDetails')->where('user_id', $userId)->get();
    }

    public function updateOrderPaymentStatus($orderId, $paymentStatus)
    {
        return Order::where('id', $orderId)->update(['payment_status' => $paymentStatus]);
    }
}