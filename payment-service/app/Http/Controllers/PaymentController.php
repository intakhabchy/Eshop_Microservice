<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function paymentInitiate(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'user_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
            'amount' => 'required|numeric'
        ]);

        $payment = $this->paymentService->initiatePayment($request->all());

        return response()->json($payment, 201);
    }

    public function updatePaymentStatus($id, Request $request)
    {
        return $this->paymentService->updatePaymentStatus($id, $request->input('status'));
    }
}
