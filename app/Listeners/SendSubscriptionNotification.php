<?php

namespace App\Listeners;

use App\Events\NewSubscription;
use App\Mail\SubcriptionEmail;
use App\Mail\SubscriptionMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewSubscription  $event
     * @return void
     */
    public function handle(NewSubscription $event)
    {
        Mail::to($event->email)->send(new SubcriptionEmail($event->subscriberEmail));
    }
}
