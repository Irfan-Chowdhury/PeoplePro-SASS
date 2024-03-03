<?php

namespace App\Listeners\PackageChange;

use App\Events\PackageChanged;
use App\Models\User;
use App\Notifications\PackageChangeNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class PackageChangeDatabaseNotification
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

        $notifiable = User::where('is_super_admin',true)->get();

        Notification::send($notifiable, new PackageChangeNotify());
    }
}
