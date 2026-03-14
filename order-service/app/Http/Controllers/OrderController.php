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
        $order = $this->orderService->createOrder($request->all());
        
        $orderDetailController = new OrderDetailController(app()->make('App\Services\OrderDetailService'));
        $orderDetailController->store($request,$order->id);

        // Call Payment Service
        $orderId = $order->id;
        $total = $this->orderService->calculateTotal($request->items);
        $vat = $this->orderService->calculateVat($total);
        $amount_payable = $total+$vat;

        $paymentResponse = $this->orderService->submitPayment($orderId, $request->user_id, $request->payment_method_id, $amount_payable);

        // Handle Payment Response, if success then update cart and stock-out products
        if (!empty($paymentResponse['status']) && $paymentResponse['status'] === 'success') {

            $cartId = $order->cart_id;
            $status = "completed";

            // update cart to completed
            $this->orderService->updateCartStatus($cartId, $status);

            // stock-out products
            $this->orderService->stockOutProducts($request, $orderId);
        }

        return response()->json($order, 201);
    }

    public function show($id, $userId)
    {
        $order = $this->orderService->getOrderById($id, $userId);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return response()->json($order);
    }
}
