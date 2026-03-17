<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function paymentSuccess(Request $request)
    {
        $result = $this->notificationService->paymentSuccess($request->all());

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Notification sent successfully'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to send notification'
        ], 500);
    }
}
