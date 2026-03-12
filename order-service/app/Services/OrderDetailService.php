<?php
namespace App\Services;

use App\Repositories\OrderDetailRepository;

class OrderDetailService
{
    private $orderDetailRepository;

    public function __construct(OrderDetailRepository $orderDetailRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function createOrderDetail($data,$orderId)
    {
        foreach ($data->items as $item) {

            $orderDetailData = [
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price']
            ];
            
            $this->orderDetailRepository->createOrderDetail($orderDetailData);
        }

        return response()->json(['message' => 'Order details created successfully'], 201);
    }
}