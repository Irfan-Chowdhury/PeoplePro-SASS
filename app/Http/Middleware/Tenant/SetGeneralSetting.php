<?php

namespace App\Http\Middleware\Tenant;

use App\Models\GeneralSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetGeneralSetting
{
    public function handle(Request $request, Closure $next): Response
    {
        $generalSetting = GeneralSetting::latest()->first();;
        if (isset($generalSetting->time_zone)) {
            self::setTimeZone($generalSetting);
        }
        return $next($request);
    }

    private static function setTimeZone($generalSetting): void
    {
        date_default_timezone_set($generalSetting->time_zone);
    }
}
