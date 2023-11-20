<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = strtolower(auth()->user()->role);

        // Check if the user's role is in the provided roles array
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Redirect based on the user's role
        if ($userRole == 'admin') {
            return Redirect::route('admin.index');
        } elseif ($userRole == 'user') {
            return Redirect::route('user.index');
        }

        // Default redirection for other cases
        return abort(403, 'Unauthorized.');
    }
}