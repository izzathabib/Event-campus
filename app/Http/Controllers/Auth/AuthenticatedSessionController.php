<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
       
        $request->authenticate();

        $request->session()->regenerate();
        
        return $this->getRedirectByRole();
    }

    /**
     * Get the redirect route based on user role.
     */
    private function getRedirectByRole(): RedirectResponse
    {
        $role = Auth::user()->roles->desc;
        $routes = [
            'society' => 'society.dashboard',
            'admin' => 'admin.dashboard',
            'student' => 'homeEvent'
        ];
        
        
        $route = $routes[$role] ?? abort(403, 'Unauthorized roles.'); // Default to home if role not found
        return redirect()->intended(route($route, absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
