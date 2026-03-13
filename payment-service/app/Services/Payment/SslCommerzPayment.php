<?php
namespace App\Services\Payment;

class SslCommerzPayment implements PaymentStrategy
{
    public function processPayment($paymentData)
    {
        return 'success';
    }
}