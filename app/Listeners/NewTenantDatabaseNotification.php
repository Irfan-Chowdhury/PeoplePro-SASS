<?php

namespace App\Listeners;

use App\Events\CustomerRegistered;
use App\Models\Tenant;
use App\Models\User;
use App\Notifications\NewTenantNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewTenantDatabaseNotification
{

    public function __construct()
    {
        //
    }

    public function handle(CustomerRegistered $event): void
    {

        $notifiable = User::where('is_super_admin',true)->get();

        Notification::send($notifiable, new NewTenantNotify());
    }
}
