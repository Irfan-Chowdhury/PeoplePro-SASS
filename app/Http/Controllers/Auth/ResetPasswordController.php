<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        if (Schema::hasTable('general_settings') && in_array(request()->getHost(), config('tenancy.central_domains'))) {
            // Landlord
            return view('landlord.super-admin.auth.passwords.reset')->with(
                ['token' => $token, 'email' => $request->email]
            );
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function sendResetResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            return new JsonResponse(['message' => trans($response)], 200);
        }

        if (Schema::hasTable('general_settings') && in_array(request()->getHost(), config('tenancy.central_domains'))) {
            return redirect()->route('admin.profile');
        }
        return redirect($this->redirectPath())->with('status', trans($response));
    }
}
