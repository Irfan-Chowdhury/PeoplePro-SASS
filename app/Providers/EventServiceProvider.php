<?php

namespace App\Providers;

use App\Events\CustomerRegistered;
use App\Events\PackageChanged;
use App\Listeners\NewTenantDatabaseNotification;
use App\Listeners\NewTenantEmailNotification;
use App\Listeners\PackageChange\PackageChangeDatabaseNotification;
use App\Listeners\PackageChange\PackageChangeEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CustomerRegistered::class => [
            NewTenantEmailNotification::class,
            NewTenantDatabaseNotification::class,
        ],
        PackageChanged::class => [
            // PackageChangeEmailNotification::class,
            PackageChangeDatabaseNotification::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
