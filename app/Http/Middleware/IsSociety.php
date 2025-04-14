<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsSociety
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // // Get the user's role ID
        // $userRoleId = $request->user()->role_id;

        // // Find the role desc based on the user's role ID
        // $role = Role::find($userRoleId);
        dd(Auth::user()->roles->desc);
        // Check if the role exists and if its description matches the required role name
        if (Auth::user()->role_id != 1) {
            abort(403, 'Error dekat society middleware');
        }

        return $next($request);
    }
}
