<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->getRedirectByRole($request);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->getRedirectByRole($request);
    }

    /**
     * Get the redirect route based on user role.
     */
    private function getRedirectByRole($request): RedirectResponse
    {
        $role = $request->user()->roles->desc;
        $routes = [
            'society' => 'society.dashboard',
            'admin' => 'homeEvent',
            'student' => 'homeEvent'
        ];
        
        $route = $routes[$role] ?? abort(403, 'Unauthorized roles.'); 

        return redirect()->intended(route($route, absolute: false).'?verified=1');
    }
}
