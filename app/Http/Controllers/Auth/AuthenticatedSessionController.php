<?php
// app/Http/Controllers/Auth/AuthenticatedSessionController.php
// Replace the existing Breeze file with this one.

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Redirect based on role
        return match(Auth::user()->role) {
            'admin'        => redirect()->route('admin.dashboard'),
            'nurse'        => redirect()->route('staff.dashboard'),
            'receptionist' => redirect()->route('staff.dashboard'),
            'doctor'       => redirect()->route('doctor.dashboard'),
            default        => redirect()->route('admin.dashboard'),
        };
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}