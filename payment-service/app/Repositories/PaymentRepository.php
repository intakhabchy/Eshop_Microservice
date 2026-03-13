<?php
namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function initiatePayment($data)
    {
        return Payment::create($data);
    }
}