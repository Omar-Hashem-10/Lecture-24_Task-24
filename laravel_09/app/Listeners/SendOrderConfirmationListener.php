<?php

namespace App\Listeners;

use App\Mail\OrderCreateMail;
use App\Events\OrderCreatedEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderConfirmationListener
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
    public function handle(OrderCreatedEvent $event): void
    {
        Mail::to($event->email)->send(new OrderCreateMail($event->data));
    }
}
