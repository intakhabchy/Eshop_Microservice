<?php
namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository
{
    public function createOrderDetail($data)
    {
        return OrderDetail::class::create($data);
    }
}