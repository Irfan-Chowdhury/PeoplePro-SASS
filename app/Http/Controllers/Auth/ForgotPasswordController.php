<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {

        if (self::isCentral()) {
            return view('landlord.super-admin.auth.passwords.email'); // Landlord
        }
        return view('auth.passwords.email'); // Tenant
    }

    protected function isCentral() : bool
    {
        if (Schema::hasTable('general_settings') && in_array(request()->getHost(), config('tenancy.central_domains')))
            return true;
        else
            return false;
    }



}
