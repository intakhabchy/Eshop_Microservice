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

    public function store($request)
    {
        $order = $this->createOrder($request->all());

        $orderDetailService = new OrderDetailService(app()->make('App\Repositories\OrderDetailRepository'));
        $orderDetailService->createOrderDetail($request,$order->id);

        // Call Payment Service
        $orderId = $order->id;
        $total = $this->calculateTotal($request->items);
        $vat = $this->calculateVat($total);
        $amount_payable = $total+$vat;

        $paymentResponse = $this->submitPayment($orderId, $request->user_id, $request->payment_method_id, $amount_payable);

        // Handle Payment Response, if success then update cart and stock-out products
        if (!empty($paymentResponse['status']) && $paymentResponse['status'] === 'success') {

            $cartId = $order->cart_id;
            $status = "completed";

            // update cart to completed
            $this->updateCartStatus($cartId, $status);

            // stock-out products
            $this->stockOutProducts($request, $orderId);
        }

        return response()->json($order, 201);
    }

    public function createOrder($data)
    {
        $userId = $data['user_id'];
        $cartId = $data['cart_id'];

        $total_price = $this->calculateTotal($data['items']);
        $vat = $this->calculateVat($total_price);

        $data['total_price'] = $total_price;
        $data['vat'] = $vat;
        $data['payable_price'] = $total_price + $vat;
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

    public function calculateTotal($items)
    {
        $total = 0;
        foreach ($items as $item) {
            $total += $item['quantity'] * $item['unit_price'];
        }
        return $total;
    }

    public function calculateVat($total)
    {
        return $total * 0.15;
    }

    public function submitPayment($orderId, $userId, $paymentMethodId, $payableAmount)
    {
        return Http::post("http://localhost:8005/api/initiate", [
            'order_id' => $orderId,
            'user_id' => $userId,
            'payment_method_id' => $paymentMethodId,
            'amount' => $payableAmount
        ])->json();
    }

    public function updateCartStatus($cartId, $status)
    {
        return Http::put("http://localhost:8003/api/update-cart-status/".$cartId."/".$status);
    }

    public function stockOutProducts($request, $orderId)
    {
        foreach ($request->items as $item) {
            $payload = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'reference_id' => $orderId
            ];
            Http::post("http://localhost:8002/api/stock-out", $payload);
        }
    }
}