<?php

namespace App\Console;

use App\Console\Commands\DocumentExpiryReminder;
use App\Models\EmployeeDocument;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        //
		Commands\DocumentExpiryReminder::class,
        Commands\OfficialDocumentExpiryReminder::class,
        Commands\EmployeeImmigrationExpiryReminder::class,
        Commands\VersionNotify::class,
        Commands\MakeService::class,
        Commands\MakeContract::class,
        Commands\MakeRepository::class,
        Commands\MakeRepositoryWithInterface::class,
        Commands\MakeRepositoryWithInterfaceAndService::class,
	];


    protected function schedule(Schedule $schedule)
    {
		$schedule->command('document:expiry')->everyMinute();
        $schedule->command('officialDocument:expiry')->everyMinute();
        $schedule->command('employeeImmigration:expiry')->everyMinute();
        $schedule->command('version:notify')->everyMinute();
	}

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
