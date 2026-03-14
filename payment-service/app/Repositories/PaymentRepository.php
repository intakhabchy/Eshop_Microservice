<?php
namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function createPayment($data)
    {
        return Payment::create($data);
    }

    public function updateStatus($paymentId,$status)
    {
        return Payment::where('id', $paymentId)->update(['status' => $status]);
    }

    public function findByOrderId($orderId)
    {
        return Payment::where('order_id', $orderId)->first();
    }

    public function getById($paymentId)
    {
        return Payment::where('id',$paymentId)->first();
    }
}