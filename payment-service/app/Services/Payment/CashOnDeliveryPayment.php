<?php
namespace App\Services\Payment;

class CashOnDeliveryPayment implements PaymentStrategy
{
    public function processPayment($paymentData)
    {
        return 'success';
    }
}