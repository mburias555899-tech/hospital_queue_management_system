<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Register Patient</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --teal:      #2e9d91;
            --teal-dark: #1f7a70;
            --teal-deep: #155c55;
            --teal-bg:   #e8f5f3;
            --red:       #e24b4a;
            --red-bg:    #fcebeb;
            --amber:     #ef9f27;
            --amber-bg:  #faeeda;
            --dark:      #1a1a1a;
            --mid:       #4a4a4a;
            --muted:     #8a8a8a;
            --border:    #e2e8e6;
            --surface:   #f4f7f6;
            --white:     #ffffff;
            --sidebar-w: 240px;
        }
        html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--surface); color: var(--dark); font-size: 14px; }

       
        .shell { display: flex; min-height: 100vh; }

       
        .sidebar { width: var(--sidebar-w); background: var(--dark); display: flex; flex-direction: column; flex-shrink: 0; padding: 0 0 1.5rem; }
        .sidebar-logo { display: flex; align-items: center; gap: 10px; padding: 1.4rem 1.4rem 1rem; border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 1rem; }
        .sidebar-logo .logo-icon { width: 34px; height: 34px; background: var(--teal); border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sidebar-logo .logo-icon svg { width: 20px; height: 20px; }
        .sidebar-logo span { font-family: 'DM Serif Display', serif; font-size: 1.2rem; color: #fff; letter-spacing: -0.3px; }
        .nav-section { padding: 0 0.75rem; margin-bottom: 0.25rem; }
        .nav-label { font-size: 0.68rem; font-weight: 600; color: rgba(255,255,255,0.3); letter-spacing: .1em; text-transform: uppercase; padding: 0 0.65rem; margin-bottom: 4px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 9px; color: rgba(255,255,255,0.55); font-size: 0.85rem; font-weight: 500; text-decoration: none; transition: background .15s, color .15s; margin-bottom: 2px; }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
        .nav-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.85); }
        .nav-item.active { background: var(--teal); color: #fff; }
        .sidebar-spacer { flex: 1; }
        .sidebar-user { display: flex; align-items: center; gap: 10px; padding: 12px 1.4rem; border-top: 1px solid rgba(255,255,255,0.08); }
        .avatar { width: 32px; height: 32px; border-radius: 50%; background: var(--teal); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 600; color: #fff; flex-shrink: 0; }
        .sidebar-user .user-info { flex: 1; min-width: 0; }
        .sidebar-user .user-name { font-size: 0.82rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user .user-role { font-size: 0.72rem; color: rgba(255,255,255,0.4); }

     
        .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .topbar { background: var(--white); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; height: 60px; flex-shrink: 0; }
        .topbar-left { display: flex; align-items: center; gap: 12px; }
        .back-btn { display: flex; align-items: center; gap: 6px; color: var(--muted); font-size: 0.82rem; text-decoration: none; padding: 6px 10px; border-radius: 8px; transition: background .15s, color .15s; }
        .back-btn:hover { background: var(--surface); color: var(--dark); }
        .back-btn svg { width: 14px; height: 14px; }
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 0.82rem; color: var(--muted); }
        .breadcrumb a { color: var(--teal-dark); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb span { color: var(--muted); }

       
        .content { padding: 2rem; flex: 1; max-width: 860px; width: 100%; margin: 0 auto; }

        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-family: 'DM Serif Display', serif; font-size: 1.8rem; color: var(--dark); letter-spacing: -0.4px; }
        .page-header p { font-size: 0.88rem; color: var(--muted); margin-top: 4px; }

        
        .form-card { background: var(--white); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; margin-bottom: 16px; }
        .form-card-header { padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
        .form-card-header .section-icon { width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .section-icon svg { width: 14px; height: 14px; }
        .section-icon.teal { background: var(--teal-bg); color: var(--teal-dark); }
        .section-icon.amber { background: var(--amber-bg); color: #b36a10; }
        .section-icon.red { background: var(--red-bg); color: var(--red); }
        .form-card-header h2 { font-size: 0.88rem; font-weight: 600; color: var(--dark); }
        .form-card-header p { font-size: 0.75rem; color: var(--muted); margin-top: 1px; }
        .form-card-body { padding: 1.5rem; }


        .field-grid { display: grid; gap: 14px; }
        .grid-2 { grid-template-columns: 1fr 1fr; }
        .grid-3 { grid-template-columns: 1fr 1fr 1fr; }
        .col-span-2 { grid-column: span 2; }
        .col-span-3 { grid-column: span 3; }


        .field { display: flex; flex-direction: column; gap: 5px; }
        .field label { font-size: 0.75rem; font-weight: 600; color: var(--mid); text-transform: uppercase; letter-spacing: .05em; }
        .field label .req { color: var(--red); margin-left: 2px; }
        .input-wrap { position: relative; }
        .input-wrap svg.ico { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: var(--muted); pointer-events: none; }
        input, select, textarea {
            width: 100%; font-family: 'DM Sans', sans-serif; font-size: 0.9rem;
            color: var(--dark); background: var(--white);
            border: 1.5px solid var(--border); border-radius: 10px;
            outline: none; transition: border-color .2s, box-shadow .2s;
        }
        input, select { padding: 10px 12px 10px 38px; height: 42px; }
        select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%238a8a8a' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 10px center; background-size: 14px; padding-right: 32px; }
        textarea { padding: 10px 12px; resize: vertical; min-height: 80px; line-height: 1.5; }
        input::placeholder, textarea::placeholder { color: #bcc5c3; }
        input:focus, select:focus, textarea:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(46,157,145,.1); }
        input.is-invalid, select.is-invalid, textarea.is-invalid { border-color: var(--red); }
        .error-msg { font-size: 0.75rem; color: var(--red); margin-top: 3px; }

    
        input.no-icon, select.no-icon, textarea.no-icon { padding-left: 12px; }

  
        .priority-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
        .priority-option { position: relative; }
        .priority-option input[type="radio"] { position: absolute; opacity: 0; width: 0; height: 0; }
        .priority-card {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 6px; padding: 14px 10px; border: 2px solid var(--border);
            border-radius: 12px; cursor: pointer; transition: all .2s; text-align: center;
        }
        .priority-card:hover { border-color: var(--teal); background: var(--teal-bg); }
        .priority-option input:checked + .priority-card { border-color: var(--teal); background: var(--teal-bg); }
        .priority-option.emergency input:checked + .priority-card { border-color: var(--red); background: var(--red-bg); }
        .priority-option.urgent input:checked + .priority-card { border-color: var(--amber); background: var(--amber-bg); }
        .priority-dot { width: 10px; height: 10px; border-radius: 50%; }
        .dot-red { background: var(--red); }
        .dot-amber { background: var(--amber); }
        .dot-teal { background: var(--teal); }
        .priority-card .p-label { font-size: 0.82rem; font-weight: 600; color: var(--dark); }
        .priority-card .p-sub { font-size: 0.68rem; color: var(--muted); line-height: 1.3; }


        .submit-bar { display: flex; align-items: center; justify-content: flex-end; gap: 10px; padding: 1.25rem 1.5rem; background: var(--white); border: 1px solid var(--border); border-radius: 16px; }
        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 10px 22px; border-radius: 50px; font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 600; cursor: pointer; border: 1.5px solid transparent; text-decoration: none; transition: all .15s; }
        .btn-ghost { background: transparent; color: var(--mid); border-color: var(--border); }
        .btn-ghost:hover { background: var(--surface); }
        .btn-primary { background: var(--dark); color: #fff; border-color: var(--dark); }
        .btn-primary:hover { background: var(--teal-deep); border-color: var(--teal-deep); }
        .btn-primary svg, .btn-ghost svg { width: 14px; height: 14px; }

       
        .alert-error { background: var(--red-bg); border: 1px solid #f7c1c1; border-radius: 10px; padding: 12px 16px; margin-bottom: 1.5rem; }
        .alert-error p { font-size: 0.82rem; color: #a32d2d; }

        @media (max-width: 900px) {
            .sidebar { display: none; }
            .grid-2, .grid-3 { grid-template-columns: 1fr; }
            .col-span-2, .col-span-3 { grid-column: span 1; }
            .priority-grid { grid-template-columns: 1fr 1fr; }
        }
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
            <a href="{{ route('dashboard') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Dashboard
            </a>
            <a href="#" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                All Patients
            </a>
        </div>
        <div class="nav-section">
            <p class="nav-label">Management</p>
            <a href="{{ route('patients.create') }}" class="nav-item active">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Register Patient
            </a>
            <a href="{{ \Illuminate\Support\Facades\Route::has('emergency.create') ? route('emergency.create') : '#' }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                Emergency Walk-in
            </a>
            <a href="#" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 014-4h0a4 4 0 014 4v2M9 7a3 3 0 116 0 3 3 0 01-6 0z"/></svg>
                Staff Accounts
            </a>
        </div>
        <div class="sidebar-spacer"></div>
        <div class="sidebar-user">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
    </nav>

    {{-- Main --}}
    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <a href="{{ route('dashboard') }}" class="back-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <span>/</span>
                    <span>Register Patient</span>
                </div>
            </div>
        </header>

        <div class="content">
            <div class="page-header">
                <h1>Register New Patient</h1>
                <p>Fill in the patient details below. All fields marked <span style="color:var(--red)">*</span> are required.</p>
            </div>

            @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('patients.store') }}">
                @csrf

                {{-- Personal Information --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="section-icon teal">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h2>Personal Information</h2>
                            <p>Basic identity details of the patient</p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="field-grid grid-2">
                            <div class="field">
                                <label>First Name <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Juan" required class="{{ $errors->has('first_name') ? 'is-invalid' : '' }}">
                                </div>
                                @error('first_name')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <label>Last Name <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="dela Cruz" required class="{{ $errors->has('last_name') ? 'is-invalid' : '' }}">
                                </div>
                                @error('last_name')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <label>Date of Birth <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="{{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}">
                                </div>
                                @error('date_of_birth')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <label>Age <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <input type="number" name="age" value="{{ old('age') }}" placeholder="25" min="0" max="150" required class="{{ $errors->has('age') ? 'is-invalid' : '' }}" id="age-field">
                                </div>
                                @error('age')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <label>Gender <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="4"/><path stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M18.66 5.34l1.41-1.41"/></svg>
                                    <select name="gender" required class="{{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
                                        <option value="Male"   {{ old('gender') == 'Male'   ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other"  {{ old('gender') == 'Other'  ? 'selected' : '' }}>Other / Prefer not to say</option>
                                    </select>
                                </div>
                                @error('gender')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                            <div class="field">
                                <label>Contact Number</label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    <input type="text" name="contact" value="{{ old('contact') }}" placeholder="09XX XXX XXXX" class="{{ $errors->has('contact') ? 'is-invalid' : '' }}">
                                </div>
                                @error('contact')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                            <div class="field col-span-2">
                                <label>Address</label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Brgy. XX, City, Province" class="{{ $errors->has('address') ? 'is-invalid' : '' }}">
                                </div>
                                @error('address')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Medical Information --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="section-icon amber">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h2>Medical Information</h2>
                            <p>Chief complaint and condition details</p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="field-grid grid-2">
                            <div class="field col-span-2">
                                <label>Chief Complaint / Condition <span class="req">*</span></label>
                                <textarea name="condition" rows="3" placeholder="e.g. Fever and cough for 3 days, chest pain, follow-up check-up..." required class="{{ $errors->has('condition') ? 'is-invalid' : '' }} no-icon">{{ old('condition') }}</textarea>
                                @error('condition')<p class="error-msg">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Queue Priority --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="section-icon red">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                        </div>
                        <div>
                            <h2>Queue Priority</h2>
                            <p>Assign the correct triage level for this patient</p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="priority-grid">
                            <label class="priority-option emergency">
                                <input type="radio" name="priority" value="critical" {{ old('priority') == 'critical' ? 'checked' : '' }}>
                                <div class="priority-card">
                                    <span class="priority-dot dot-red"></span>
                                    <span class="p-label">Critical</span>
                                    <span class="p-sub">Life-threatening, skip queue immediately</span>
                                </div>
                            </label>
                            <label class="priority-option urgent">
                                <input type="radio" name="priority" value="urgent" {{ old('priority', 'normal') == 'urgent' ? 'checked' : '' }}>
                                <div class="priority-card">
                                    <span class="priority-dot dot-amber"></span>
                                    <span class="p-label">Urgent</span>
                                    <span class="p-sub">Needs fast care, senior / pregnant</span>
                                </div>
                            </label>
                            <label class="priority-option">
                                <input type="radio" name="priority" value="normal" {{ old('priority', 'normal') == 'normal' ? 'checked' : '' }}>
                                <div class="priority-card">
                                    <span class="priority-dot dot-teal"></span>
                                    <span class="p-label">Normal</span>
                                    <span class="p-sub">Stable patient, regular queue</span>
                                </div>
                            </label>
                        </div>
                        @error('priority')<p class="error-msg" style="margin-top:8px;">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Submit bar --}}
                <div class="submit-bar">
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Register &amp; Add to Queue
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Auto-calculate age from DOB --}}
<script>
    document.querySelector('input[name="date_of_birth"]').addEventListener('change', function () {
        const dob = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) age--;
        if (age >= 0) document.getElementById('age-field').value = age;
    });
</script>
</body>
</html>