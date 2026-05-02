<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        if (!in_array($userRole, $roles)) {
            
            return match($userRole) {
                'admin'        => redirect()->route('admin.dashboard'),
                'nurse'        => redirect()->route('staff.dashboard'),
                'receptionist' => redirect()->route('staff.dashboard'),
                'doctor'       => redirect()->route('doctor.dashboard'),
                default        => redirect()->route('login'),
            };
        }

        return $next($request);
    }
}