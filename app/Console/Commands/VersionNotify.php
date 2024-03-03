<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\VersionReleaseNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use IrfanChowdhury\VersionElevate\Traits\AutoUpdateTrait;

class VersionNotify extends Command
{
    use AutoUpdateTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'version:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "It'll notify the new version";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(env('PRODUCT_MODE')==='CLIENT' && env('VERSION') && config('version_elevate.target_url')) {
            $autoUpdateData = $this->general();
            $newVersion = isset($autoUpdateData['generalData']->general->demo_version) ? $autoUpdateData['generalData']->general->demo_version : null;

            if(isset($autoUpdateData['alertVersionUpgradeEnable']) && $autoUpdateData['alertVersionUpgradeEnable']) {
                $notifiable = User::where('is_super_admin',true)->get();

                Notification::send($notifiable, new VersionReleaseNotification($newVersion));

                $this->info('New version released.');
            }

        }else {
            $this->info('No Action.');
        }
    }
}
