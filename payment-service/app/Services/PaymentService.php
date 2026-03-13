<?php
namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Services\Payment\CashOnDeliveryPayment;
use App\Services\Payment\SslCommerzPayment;

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

        // Choose strategy
        $strategy = $this->getStrategy($data['payment_method_id']);

        // Process payment
        $status = $strategy->processPayment($data);

        // 4. Update payment status
        $this->paymentRepository->updateStatus($payment->id, 'success');

        // Return response
        return [
            'payment_id' => $payment->id,
            'status' => 'success',
            'message' => 'Payment processed successfully'
        ];
    }

    public function updatePaymentStatus($paymentId, $status)
    {
        return $this->paymentRepository->updateStatus($paymentId, $status);
    }

    private function getStrategy($paymentMethodId)
    {
        // Map IDs to strategy classes (adjust IDs according to your DB)
        return match ($paymentMethodId) {
            1 => new SslCommerzPayment(),
            2 => new CashOnDeliveryPayment(),
            default => new CashOnDeliveryPayment()
        };
    }
}