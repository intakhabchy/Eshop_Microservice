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
        $paymentResponse = Http::post("http://localhost:8005/api/payment/initiate", [
            'order_id' => $order->id,
            'user_id' => $request->user_id,
            'payment_method_id' => $request->payment_method_id,
            'amount' => $request->total_amount
        ]);

        // Handle Payment Response, if success then update cart and stock-out products
        if ($paymentResponse['status'] === 'success') {

            $cartId = $order->cart_id;
            $status = "completed";

            // update cart to completed
            Http::put("http://localhost:8003/api/update-cart-status/".$cartId."/".$status);

            // stock-out products
            foreach ($request->items as $item) {
                $payload = [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'reference_id' => $order->id
                ];
                Http::post("http://localhost:8002/api/stock-out", $payload);
            }
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
