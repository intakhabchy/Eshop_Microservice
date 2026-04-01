<?php
namespace App\Console\Consumers;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class PaymentSuccessConsumer
{
    public function consume()
    {
        $connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('payment_success', false, true, false, false);

        $callback = function ($msg) {
            $data = json_decode($msg->body, true);
            app(\App\Services\NotificationService::class)->paymentSuccess($data);
            echo "Notification processed\n";
            $msg->ack(); // manual ack
        };

        $channel->basic_consume('payment_success', '', false, false, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }
    }
}