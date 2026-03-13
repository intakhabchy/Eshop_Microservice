<?php
namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function initiatePayment($data)
    {
        return $this->paymentRepository->initiatePayment($data);
    }
}