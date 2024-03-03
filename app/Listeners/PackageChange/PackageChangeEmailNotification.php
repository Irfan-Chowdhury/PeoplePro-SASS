<?php

namespace App\Listeners\PackageChange;

use App\Events\PackageChanged;
use App\Mail\PackageChangeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PackageChangeEmailNotification
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
    public function handle(PackageChanged $event): void
    {
        // $previousPackageName, $newPackageName
        if (config('mail.is_active'))
            Mail::to($event->tenant->customer->email)->send(new PackageChangeEmail($event->tenant, $event->previousPackageName, $event->newPackageName));
    }
}
