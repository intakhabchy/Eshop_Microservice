<?php
namespace App\Services\Payment;

interface PaymentStrategy
{
    public function processPayment($paymentData);       // returns payment result (success/failure)
}