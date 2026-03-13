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
        // Create payment record (pending)
        $payment = $this->paymentRepository->createPayment([
            'order_id' => $data['order_id'],
            'user_id' => $data['user_id'],
            'payment_method_id' => $data['payment_method_id'],
            'amount' => $data['amount'],
            'status' => 'pending'
        ]);

        // Replace this simulated success with actual gateway call
        // Example: SSLCommerz API call, handle response, then update status accordingly
        $this->paymentRepository->updateStatus($payment->id, 'success');

        // Return response
        return [
            'payment_id' => $payment->id,
            'status' => 'success',
            'message' => 'Payment processed successfully'
        ];
    }
}