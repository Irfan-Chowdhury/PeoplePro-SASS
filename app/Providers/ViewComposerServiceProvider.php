<?php

namespace App\Providers;

use App\Models\GeneralSetting as TenantGeneralSetting;
use App\Services\PageService;
use App\Services\SettingService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('general_settings') && in_array(request()->getHost(), config('tenancy.central_domains'))) {
            $settingService = app()->make(SettingService::class);
            $pages = app()->make(PageService::class);

            view()->composer([
                'landlord.public-section.layouts.master',
                'landlord.public-section.pages.landing-page.index',
                'landlord.public-section.pages.renew.contact_for_renewal',
                'landlord.super-admin.pages.dashboard.index',
                'landlord.super-admin.partials.header',
                'landlord.super-admin.auth.login',
                'documentation-landlord.index',
            ], function ($view) use ($settingService) {
                $view->with('generalSetting',
                    Cache::remember('generalSetting', config('cache.duration'), function () use ($settingService) {
                        return $settingService->getLatestGeneralSettingData();
                    }));
            });

            view()->composer('landlord.public-section.layouts.master', function ($view) use ($settingService) {
                $view->with('seoSetting',
                    Cache::remember('seoSetting', config('cache.duration'), function () use ($settingService) {
                        return $settingService->getLatestSeoSettingData();
                    }));
            });

            view()->composer('landlord.public-section.partials.footer', function ($view) use ($pages) {
                $view->with('pages',
                    Cache::remember('pages', config('cache.duration'), function () use ($pages) {
                        return $pages->getAllByLanguageId(view()->shared('languageId'));
                    }));
            });
        }
        // else {
        elseif (Schema::hasTable('general_settings')) {

            $general_settings = TenantGeneralSetting::latest()->first();

            view()->composer([
                'layout.main',
                'layout.client',
                'documentation.index',
            ], function ($view) use ($general_settings) {
                $view->with('general_settings', $general_settings);
            });
        }
    }
}
