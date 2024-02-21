<?php

namespace App\Listeners\PackageChange;

use App\Events\PackageChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
