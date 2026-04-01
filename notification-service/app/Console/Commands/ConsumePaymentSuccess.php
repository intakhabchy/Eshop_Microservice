<?php

namespace App\Console\Commands;

use App\Console\Consumers\PaymentSuccessConsumer;
use Illuminate\Console\Command;

class ConsumePaymentSuccess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Payment consumer started...");

        $consumer = new PaymentSuccessConsumer();
        $consumer->consume(); // call your existing consumer function

        $this->info("Payment consumer stopped.");
    }
}
