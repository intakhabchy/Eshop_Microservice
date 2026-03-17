<?php
namespace App\Services;

use App\Repositories\PaymentRepository;
use App\Services\Payment\CashOnDeliveryPayment;
use App\Services\Payment\SslCommerzPayment;
use Illuminate\Support\Facades\Http;

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

        $paymentPayload = ['payment_id' => $payment->id, 'status'=> $status];

        $this->completePayment($paymentPayload);

        // 4. Update payment status
        $this->paymentRepository->updateStatus($payment->id, $status);

        $token = 'PAY' . rand(100000, 999999);

        // Return response
        return [
            'payment_id' => $payment->id,
            'status' => $status,
            'token' => $token,
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

    public function completePayment($data)
    {
        $this->paymentRepository->updateStatus($data['payment_id'], $data['status']);

        $payment = $this->paymentRepository->getById($data['payment_id']);

        if ($data['status'] === 'success') {

            $orderId = $payment->order_id;

            $response = Http::put("http://localhost:8004/api/update-payment-status/".$orderId, [
                'payment_status' => 'paid'
            ]);

            // send notification to the user with notification service
            Http::post("http://localhost:8006/api/payment-success", [
                'user_id' => $payment->user_id,
                'order_id' => $payment->order_id,
                'type' => "Payment Success",
                'message' => "Your payment for ".$orderId." is successfull"
            ]);

        }
        else
        {
            // handle cancel or failed   
        }

        return [
            'payment_id' => $payment->id,
            'status' => $data['status'],
            'message' => 'Payment completed'
        ];
    }
}