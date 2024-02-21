<?php

namespace App\Listeners;

use App\Mail\ConfirmationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewTenantEmailNotification
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
    public function handle(object $event): void
    {
        // asynchronously
        if (config('mail.is_active'))
            Mail::to($event->customerRequest->email)->send(new ConfirmationEmail($event->customerRequest));
    }
}
