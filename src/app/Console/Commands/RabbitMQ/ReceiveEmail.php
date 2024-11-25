<?php

namespace App\Console\Commands\RabbitMQ;

use App\Services\RabbitMQ\RabbitMQ;
use Illuminate\Console\Command;

class ReceiveEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:receive';

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
        echo "RabbitMQ Consumer starting";
        RabbitMQ::receiveEmail();
    }
}
