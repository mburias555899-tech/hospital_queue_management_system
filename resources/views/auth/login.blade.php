<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MedSyst — Login</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --teal-50:  #e8f5f3;
            --teal-100: #b8e3db;
            --teal-200: #88d0c4;
            --teal-400: #4aadA0;
            --teal-500: #2e9d91;   
            --teal-600: #1f7a70;
            --teal-700: #155c55;
            --teal-800: #0d3d38;
            --teal-900: #061f1c;
            --dark: #1a1a1a;
            --mid:  #4a4a4a;
            --muted: #8a8a8a;
            --border: #e2e8e6;
            --white: #ffffff;
            --bg: #f4f7f6;
        }

        html, body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--dark);
        }

        
        .page {
            display: grid;
            grid-template-columns: 480px 1fr;
            min-height: 100vh;
        }

        
        .left-panel {
            background: var(--teal-500);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        
        .left-panel::before,
        .left-panel::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,0.12);
        }
        .left-panel::before { width: 600px; height: 600px; top: -180px; left: -200px; }
        .left-panel::after  { width: 420px; height: 420px; bottom: -160px; right: -160px; }

        .brand-card {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.22);
            border-radius: 28px;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(8px);
        }

        .logo-wrap {
            width: 120px;
            height: 120px;
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
        }

        .logo-wrap img { width: 100%; height: auto; display: block; }

        .brand-name {
            font-family: 'DM Serif Display', serif;
            font-size: 2.2rem;
            color: #fff;
            letter-spacing: -0.5px;
        }

        .brand-tagline {
            font-size: 0.9rem;
            color: rgba(255,255,255,0.75);
            text-align: center;
            line-height: 1.6;
            max-width: 240px;
        }

       
        .badge-row {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            margin-top: 0.5rem;
        }

        .badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 12px;
            padding: 10px 14px;
            color: #fff;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .badge-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .dot-red    { background: #ff6b6b; }
        .dot-amber  { background: #ffcc5c; }
        .dot-green  { background: #6ddb9e; }

        
        .right-panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
        }

        .form-card {
            width: 100%;
            max-width: 420px;
        }

        .form-header { margin-bottom: 2.5rem; }

        .form-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 2.4rem;
            color: var(--dark);
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        .form-header p {
            margin-top: 0.5rem;
            font-size: 0.95rem;
            color: var(--muted);
        }

        
        .field { margin-bottom: 1.4rem; }

        .field label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--mid);
            margin-bottom: 0.5rem;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: var(--muted);
            pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--dark);
            background: var(--white);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-wrap input::placeholder { color: #bcc5c3; }

        .input-wrap input:focus {
            border-color: var(--teal-500);
            box-shadow: 0 0 0 4px rgba(46,157,145,0.1);
        }

        
        .input-wrap input.is-invalid { border-color: #e24b4a; }
        .error-msg { margin-top: 6px; font-size: 0.8rem; color: #e24b4a; }

        
        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.88rem;
            color: var(--mid);
        }

        .remember input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--teal-500);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 0.88rem;
            color: var(--teal-600);
            text-decoration: none;
            font-weight: 500;
        }
        .forgot-link:hover { text-decoration: underline; }

        
        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--dark);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-login:hover { background: var(--teal-700); }
        .btn-login:active { transform: scale(0.99); }

       
        .register-wrap {
            margin-top: 1.6rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .register-link {
            margin-left: 6px;
            font-weight: 600;
            color: var(--teal-600);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .register-link:hover {
            color: var(--teal-700);
            text-decoration: underline;
        }

       
        .session-error {
            background: #fff0f0;
            border: 1px solid #f7c1c1;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 0.875rem;
            color: #a32d2d;
            margin-bottom: 1.4rem;
        }

        .session-status {
            background: #eaf3de;
            border: 1px solid #c0dd97;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 0.875rem;
            color: #3b6d11;
            margin-bottom: 1.4rem;
        }

        
        .form-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.82rem;
            color: var(--muted);
        }

        
        @media (max-width: 900px) {
            .page { grid-template-columns: 1fr; }
            .left-panel { padding: 2.5rem 2rem; min-height: 280px; }
            .brand-card { flex-direction: row; flex-wrap: wrap; justify-content: center; padding: 1.5rem; gap: 1rem; }
            .badge-row { flex-direction: row; flex-wrap: wrap; }
        }
    </style>
</head>
<body>

<div class="page">

    {{-- ── Left branding panel ── --}}
    <div class="left-panel">
        <div class="brand-card">

            <div class="logo-wrap">
                {{-- Replace src with your actual asset path --}}
                <img src="{{ asset('images/medsyst-logo.png') }}" alt="MedSyst Logo">
                {{-- Fallback inline SVG (same teal heart+cross) if image not found --}}
            </div>

            <div class="brand-name">MedSyst</div>

            <p class="brand-tagline">
                Because Every Patient Matters.
            </p>

        </div>
    </div>

    {{-- ── Right login form ── --}}
    <div class="right-panel">
        <div class="form-card">

            <div class="form-header">
                <h1>Welcome</h1>
                <p>Please enter your details to continue.</p>
            </div>

            {{-- Session Status (e.g. password reset email sent) --}}
            @if (session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="session-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="field">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5H4.5a2.25 2.25 0 00-2.25 2.25m19.5 0L12 13.5 2.25 6.75" />
                        </svg>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="user@medsyst.com"
                            required
                            autofocus
                            autocomplete="username"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        >
                    </div>
                    @error('email')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.5a4.5 4.5 0 10-9 0v3m-1.5 0h12a1.5 1.5 0 011.5 1.5v7.5a1.5 1.5 0 01-1.5 1.5H6a1.5 1.5 0 01-1.5-1.5V12a1.5 1.5 0 011.5-1.5z" />
                        </svg>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        >
                    </div>
                    @error('password')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember me + Forgot password --}}
                <div class="form-row">
                    <label class="remember">
                        <input type="checkbox" name="remember" id="remember_me">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login">Log In</button>

                <div class="register-wrap">
                    @if (Route::has('register'))
                        <span class="register-text">Don’t have an account?</span>
                        <a href="{{ route('register') }}" class="register-link">
                            Register
                        </a>
                    @endif
                </div>

            </form>

            <p class="form-footer">
                MedSyst &copy; {{ date('Y') }} &mdash; Hospital Queue Management System
            </p>

        </div>
    </div>

</div>

</body>
</html>