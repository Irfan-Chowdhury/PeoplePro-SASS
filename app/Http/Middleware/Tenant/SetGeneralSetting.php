<?php

namespace App\Http\Middleware\Tenant;

use App\Models\GeneralSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetGeneralSetting
{
    public function handle(Request $request, Closure $next): Response
    {
        $generalSetting = GeneralSetting::latest()->first();;
        if (isset($generalSetting->time_zone)) {
            self::setTimeZone($generalSetting);
            self::setRtlLayout($generalSetting);
            self::setClockInClockOut($generalSetting);
            self::setEarlyClockIn($generalSetting);
        }
        return $next($request);
    }

    private static function setTimeZone($generalSetting): void
    {
        date_default_timezone_set($generalSetting->time_zone);
    }

    private static function setRtlLayout($generalSetting)
    {
        $isEnableRtlLayout = $generalSetting->rtl_layout ? true : false;

        view()->composer([
            'layout.main',
        ], function ($view) use ($isEnableRtlLayout) {
            $view->with('isEnableRtlLayout', $isEnableRtlLayout);
        });
    }

    private static function setClockInClockOut($generalSetting)
    {
        $isEnableClockInClockOut = $generalSetting->enable_clockin_clockout ?? false;

        view()->composer([
            'dashboard.employee_dashboard',
        ], function ($view) use ($isEnableClockInClockOut) {
            $view->with('isEnableClockInClockOut', $isEnableClockInClockOut);
        });
    }

    private static function setEarlyClockIn($generalSetting)
    {
        $isEnableEarlyClockIn = $generalSetting->enable_early_clockin ? true : null;
        Session::put('isEnableEarlyClockIn', $isEnableEarlyClockIn);
    }

}
