<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Create User</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --teal:#2e9d91;--teal-dark:#1f7a70;--teal-deep:#155c55;--teal-bg:#e8f5f3;
            --red:#e24b4a;--red-bg:#fcebeb;--red-dark:#a32d2d;
            --amber:#ef9f27;--amber-bg:#faeeda;--amber-dark:#b36a10;
            --green:#3b9e3b;--green-bg:#eaf3de;
            --dark:#1a1a1a;--mid:#4a4a4a;--muted:#8a8a8a;
            --border:#e2e8e6;--surface:#f4f7f6;--white:#ffffff;
            --sidebar-w:240px;
        }
        html,body{height:100%;font-family:'DM Sans',sans-serif;background:var(--surface);color:var(--dark);font-size:14px;}
        .shell{display:flex;min-height:100vh;}

      
        .sidebar{width:var(--sidebar-w);background:var(--dark);display:flex;flex-direction:column;flex-shrink:0;padding:0 0 1.5rem;position:sticky;top:0;height:100vh;overflow-y:auto;}
        .sidebar-logo{display:flex;align-items:center;gap:10px;padding:1.4rem 1.4rem 1rem;border-bottom:1px solid rgba(255,255,255,0.08);margin-bottom:1rem;}
        .logo-icon{width:34px;height:34px;background:var(--teal);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .logo-icon svg{width:20px;height:20px;}
        .sidebar-logo span{font-family:'DM Serif Display',serif;font-size:1.2rem;color:#fff;letter-spacing:-0.3px;}
        .nav-section{padding:0 0.75rem;margin-bottom:0.5rem;}
        .nav-label{font-size:0.68rem;font-weight:600;color:rgba(255,255,255,0.3);letter-spacing:.1em;text-transform:uppercase;padding:0 0.65rem;margin-bottom:4px;}
        .nav-item{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:9px;color:rgba(255,255,255,0.55);font-size:0.85rem;font-weight:500;text-decoration:none;transition:background .15s,color .15s;margin-bottom:2px;}
        .nav-item svg{width:16px;height:16px;flex-shrink:0;}
        .nav-item:hover{background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.85);}
        .nav-item.active{background:var(--teal);color:#fff;}
        .sidebar-spacer{flex:1;}
        .sidebar-user{display:flex;align-items:center;gap:10px;padding:12px 1.4rem;border-top:1px solid rgba(255,255,255,0.08);}
        .avatar{width:32px;height:32px;border-radius:50%;background:var(--teal);display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:600;color:#fff;flex-shrink:0;}
        .user-name{font-size:0.82rem;font-weight:600;color:#fff;}
        .user-role{font-size:0.72rem;color:rgba(255,255,255,0.4);}

        .main{flex:1;display:flex;flex-direction:column;min-width:0;}
        .topbar{background:var(--white);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 2rem;height:60px;flex-shrink:0;position:sticky;top:0;z-index:10;}
        .topbar h1{font-family:'DM Serif Display',serif;font-size:1.35rem;color:var(--dark);letter-spacing:-0.3px;}
        .topbar span{font-size:0.75rem;color:var(--muted);display:block;margin-top:1px;}
        .topbar-right{display:flex;align-items:center;gap:10px;}
        .btn{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:50px;font-family:'DM Sans',sans-serif;font-size:0.82rem;font-weight:600;cursor:pointer;border:1.5px solid transparent;text-decoration:none;transition:all .15s;}
        .btn svg{width:13px;height:13px;}
        .btn-ghost{background:transparent;color:var(--mid);border-color:var(--border);}
        .btn-ghost:hover{background:var(--surface);border-color:var(--teal);color:var(--teal);}
        .btn-teal{background:var(--teal);color:#fff;border-color:var(--teal);}
        .btn-teal:hover{background:var(--teal-dark);border-color:var(--teal-dark);}
        .btn-sm{padding:6px 14px;font-size:0.78rem;}

     
        .content{
            flex:1;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:2rem;
        }

        .form-card{background:var(--white);border:1px solid var(--border);border-radius:16px;overflow:hidden;width:100%;max-width:560px;}
        .form-card-header{padding:1.1rem 1.5rem;border-bottom:1px solid var(--border);}
        .form-card-header h2{font-size:0.9rem;font-weight:600;color:var(--dark);}
        .form-card-header p{font-size:0.75rem;color:var(--muted);margin-top:2px;}
        .form-body{padding:1.5rem;}

      
        .form-group{margin-bottom:1.1rem;}
        .form-group label{display:block;font-size:0.78rem;font-weight:600;color:var(--mid);margin-bottom:6px;text-transform:uppercase;letter-spacing:.04em;}
        .form-group input,
        .form-group select{width:100%;padding:9px 12px;border:1.5px solid var(--border);border-radius:9px;font-family:'DM Sans',sans-serif;font-size:0.85rem;color:var(--dark);background:var(--white);outline:none;transition:border-color .15s;}
        .form-group input:focus,
        .form-group select:focus{border-color:var(--teal);}
        .form-group input.is-invalid,
        .form-group select.is-invalid{border-color:var(--red);}
        .form-error{font-size:0.72rem;color:var(--red);margin-top:4px;}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
        .form-divider{border:none;border-top:1px solid var(--border);margin:1.25rem 0;}
        .form-section-title{font-size:0.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:0.75rem;}
        .form-footer{display:flex;align-items:center;justify-content:flex-end;gap:10px;padding:1rem 1.5rem;border-top:1px solid var(--border);background:var(--surface);}

        .flash-error{background:var(--red-bg);border:1px solid #f7c1c1;border-radius:10px;padding:10px 16px;margin-bottom:1rem;font-size:0.82rem;color:var(--red-dark);}

        @media(max-width:960px){.sidebar{display:none;}.form-row{grid-template-columns:1fr;}}
    </style>
</head>
<body>
<div class="shell">

    {{-- Sidebar --}}
    <nav class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <svg viewBox="0 0 100 100" fill="none"><path d="M50 85C50 85 10 60 10 35C10 20 22 10 35 10C42 10 48 14 50 18C52 14 58 10 65 10C78 10 90 20 90 35C90 60 50 85 50 85Z" stroke="#fff" stroke-width="6" fill="none" stroke-linejoin="round"/><rect x="42" y="32" width="16" height="36" rx="6" fill="#fff"/><rect x="32" y="42" width="36" height="16" rx="6" fill="#fff"/></svg>
            </div>
            <span>MedSyst</span>
        </div>

        <div class="nav-section">
            <p class="nav-label">Overview</p>
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Dashboard
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-label">Records</p>
            <a href="{{ route('admin.patients.index') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Patient Records
            </a>
            <a href="{{ route('admin.reports.index') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Reports
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-label">Administration</p>
            <a href="{{ route('admin.users.index') }}" class="nav-item active">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 014-4h0a4 4 0 014 4v2M9 7a3 3 0 116 0 3 3 0 01-6 0z"/></svg>
                User Accounts
            </a>
        </div>

        <div class="sidebar-spacer"></div>
        <div class="sidebar-user">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
    </nav>

    {{-- Main --}}
    <div class="main">
        <header class="topbar">
            <div>
                <h1>Create User</h1>
                <span>Add a new system user account</span>
            </div>
            <div class="topbar-right">
                {{-- Back button only, logout removed --}}
                <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back
                </a>
            </div>
        </header>

        {{-- Centered content --}}
        <div class="content">
            <div class="form-card">

                @if($errors->any())
                    <div style="padding:1rem 1.5rem 0;">
                        <div class="flash-error">Please fix the errors below before submitting.</div>
                    </div>
                @endif

                <div class="form-card-header">
                    <h2>New User Details</h2>
                    <p>Fill in the information to create a new account</p>
                </div>

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="form-body">

                        <p class="form-section-title">Basic Information</p>
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="e.g. Juan Dela Cruz"
                                class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                            @error('name')<p class="form-error">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="e.g. juan@hospital.com"
                                class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                            @error('email')<p class="form-error">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" name="role" class="{{ $errors->has('role') ? 'is-invalid' : '' }}">
                                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select a role</option>
                                <option value="admin"        {{ old('role') === 'admin'        ? 'selected' : '' }}>Admin</option>
                                <option value="nurse"        {{ old('role') === 'nurse'        ? 'selected' : '' }}>Nurse</option>
                                <option value="receptionist" {{ old('role') === 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                                <option value="doctor"       {{ old('role') === 'doctor'       ? 'selected' : '' }}>Doctor</option>
                            </select>
                            @error('role')<p class="form-error">{{ $message }}</p>@enderror
                        </div>

                        <hr class="form-divider">
                        <p class="form-section-title">Password</p>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password"
                                    placeholder="Min. 8 characters"
                                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                                @error('password')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    placeholder="Repeat password">
                            </div>
                        </div>

                    </div>

                    <div class="form-footer">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-teal btn-sm">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>