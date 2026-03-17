<?php
namespace App\Services;

use App\Jobs\SendNotificationJob;
use App\Repositories\NotificationRepository;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function paymentSuccess($data)
    {
        // save notification (optional)
        $saved = $this->notificationRepository->store([
            'user_id' => $data['user_id'],
            'order_id' => $data['order_id'],
            'type' => $data['type'],
            'message' => $data['message']
        ]);

        // send notification (for now log)
        if($saved)
        {
            Log::info('Payment success notification sent to user '.$data['user_id']);
            SendNotificationJob::dispatch($data);       // add queue
            return true;
        }

        return false;
        
    }
}
