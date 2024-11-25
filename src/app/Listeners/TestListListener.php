<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Services\RabbitMQ\RabbitMQ;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class TestListListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendEmailEvent $event): void
    {
        RabbitMQ::sendEmail($event->email->toJson());
    }
}
