<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index($userId)
    {
        return $this->orderService->getAllOrders($userId);
    }

    public function store(Request $request)
    {
        return $this->orderService->store($request);
    }

    public function show($id, $userId)
    {
        $order = $this->orderService->getOrderById($id, $userId);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return response()->json($order);
    }

    public function updatePaymentStatus($id, Request $request)
    {
        return $this->orderService->updateOrderPaymentStatus($id, $request->payment_status);
    }
}
