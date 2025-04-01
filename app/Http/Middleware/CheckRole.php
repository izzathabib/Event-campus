<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure the user is authenticated
        // if (! $request->user()) {
        //     abort(401, 'Unauthorized action.'); // Or redirect to login
        // }

        // Get the user's role ID
        $userRoleId = $request->user()->role_id;

        // Find the role desc based on the user's role ID
        $role = Role::find($userRoleId);

        // Check if the role exists and if its description matches the required role name
        if (! $role || $role->desc !== $roleName) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
