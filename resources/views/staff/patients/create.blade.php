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
            --teal:#2e9d91;--teal-dark:#1f7a70;--teal-deep:#155c55;--teal-bg:#e8f5f3;
            --red:#e24b4a;--red-bg:#fcebeb;--red-dark:#a32d2d;
            --amber:#ef9f27;--amber-bg:#faeeda;--amber-dark:#b36a10;
            --green:#3b9e3b;--green-bg:#eaf3de;--green-dark:#2a5a11;
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
        .btn-primary{background:var(--teal);color:#fff;border-color:var(--teal);}
        .btn-primary:hover{background:var(--teal-dark);border-color:var(--teal-dark);}
        .btn-ghost{background:transparent;color:var(--mid);border-color:var(--border);}
        .btn-ghost:hover{background:var(--surface);border-color:var(--teal);color:var(--teal);}
        .btn-sm{padding:6px 14px;font-size:0.78rem;}
        .btn-lg{padding:11px 28px;font-size:0.88rem;}

        .content{padding:1.75rem 2rem;flex:1;display:flex;flex-direction:column;align-items:center;}
        .breadcrumb{display:flex;align-items:center;gap:6px;font-size:0.78rem;color:var(--muted);margin-bottom:1.25rem;width:100%;max-width:800px;}
        .breadcrumb a{color:var(--muted);text-decoration:none;}
        .breadcrumb a:hover{color:var(--teal);}
        .breadcrumb svg{width:12px;height:12px;}

        
        .form-card{background:var(--white);border:1px solid var(--border);border-radius:16px;overflow:hidden;max-width:800px;width:100%;}
        .form-card-header{padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px;}
        .form-card-icon{width:38px;height:38px;background:var(--teal-bg);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .form-card-icon svg{width:18px;height:18px;color:var(--teal-dark);}
        .form-card-header h2{font-size:0.95rem;font-weight:600;color:var(--dark);}
        .form-card-header p{font-size:0.75rem;color:var(--muted);margin-top:2px;}
        .form-body{padding:1.5rem;}

    
        .form-section{margin-bottom:1.5rem;}
        .form-section-title{font-size:0.72rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;margin-bottom:0.85rem;padding-bottom:0.5rem;border-bottom:1px solid var(--border);}
        .form-row{display:grid;gap:14px;margin-bottom:14px;}
        .form-row.cols-2{grid-template-columns:1fr 1fr;}
        .form-row.cols-3{grid-template-columns:1fr 1fr 1fr;}
        .form-group{display:flex;flex-direction:column;gap:5px;}
        .form-label{font-size:0.78rem;font-weight:600;color:var(--dark);}
        .form-label .req{color:var(--red);margin-left:2px;}
        .form-input,.form-select,.form-textarea{width:100%;padding:9px 12px;border:1.5px solid var(--border);border-radius:9px;font-family:'DM Sans',sans-serif;font-size:0.85rem;color:var(--dark);background:var(--white);outline:none;transition:border-color .15s,box-shadow .15s;}
        .form-input:focus,.form-select:focus,.form-textarea:focus{border-color:var(--teal);box-shadow:0 0 0 3px rgba(46,157,145,.1);}
        .form-input.is-invalid,.form-select.is-invalid,.form-textarea.is-invalid{border-color:var(--red);}
        .form-textarea{resize:vertical;min-height:80px;}
        .form-select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238a8a8a' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:32px;}
        .field-error{font-size:0.73rem;color:var(--red);margin-top:2px;}

        
        .priority-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;}
        .priority-option{position:relative;}
        .priority-option input[type="radio"]{position:absolute;opacity:0;width:0;height:0;}
        .priority-card{
            display:flex;flex-direction:column;align-items:center;gap:8px;
            padding:14px 12px;border-radius:12px;border:2px solid var(--border);
            cursor:pointer;transition:all .15s;text-align:center;background:var(--white);
        }
        .priority-card:hover{border-color:var(--muted);}
        .priority-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;}
        .priority-icon svg{width:20px;height:20px;}
        .priority-name{font-size:0.85rem;font-weight:700;color:var(--dark);}
        .priority-desc{font-size:0.72rem;color:var(--muted);line-height:1.4;}
        .priority-badge{font-size:0.68rem;font-weight:700;padding:2px 8px;border-radius:20px;letter-spacing:.05em;text-transform:uppercase;}

        
        .priority-option input[value="critical"]:checked ~ .priority-card{
            border-color:var(--red);background:var(--red-bg);box-shadow:0 0 0 3px rgba(226,75,74,.12);
        }
        .priority-option input[value="critical"]:checked ~ .priority-card .priority-name{color:var(--red-dark);}
        .priority-option input[value="critical"]:checked ~ .priority-card .priority-desc{color:var(--red);}
        .icon-critical{background:var(--red-bg);color:var(--red);}
        .badge-critical{background:var(--red-bg);color:var(--red-dark);}

     
        .priority-option input[value="urgent"]:checked ~ .priority-card{
            border-color:var(--amber);background:var(--amber-bg);box-shadow:0 0 0 3px rgba(239,159,39,.12);
        }
        .priority-option input[value="urgent"]:checked ~ .priority-card .priority-name{color:var(--amber-dark);}
        .priority-option input[value="urgent"]:checked ~ .priority-card .priority-desc{color:var(--amber-dark);}
        .icon-urgent{background:var(--amber-bg);color:var(--amber);}
        .badge-urgent{background:var(--amber-bg);color:var(--amber-dark);}

       
        .priority-option input[value="normal"]:checked ~ .priority-card{
            border-color:var(--green);background:var(--green-bg);box-shadow:0 0 0 3px rgba(59,158,59,.12);
        }
        .priority-option input[value="normal"]:checked ~ .priority-card .priority-name{color:var(--green-dark);}
        .priority-option input[value="normal"]:checked ~ .priority-card .priority-desc{color:var(--green);}
        .icon-normal{background:var(--green-bg);color:var(--green);}
        .badge-normal{background:var(--green-bg);color:var(--green-dark);}

        
        .priority-error{font-size:0.73rem;color:var(--red);margin-top:6px;}

        
        .form-footer{display:flex;align-items:center;justify-content:flex-end;gap:10px;padding:1.1rem 1.5rem;border-top:1px solid var(--border);background:var(--surface);}

       
        .flash-error{background:var(--red-bg);border:1px solid #f7c1c1;border-radius:10px;padding:10px 16px;margin-bottom:1.25rem;font-size:0.82rem;color:var(--red-dark);width:100%;max-width:800px;}

        @media(max-width:960px){
            .sidebar{display:none;}
            .form-row.cols-2,.form-row.cols-3{grid-template-columns:1fr;}
            .priority-grid{grid-template-columns:1fr;}
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
            <a href="{{ route('staff.dashboard') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Dashboard
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-label">Patients</p>
            <a href="{{ route('staff.patients.create') }}" class="nav-item active">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Register Patient
            </a>
            <a href="{{ route('staff.emergency.create') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                Emergency
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-label">Queue</p>
            <a href="{{ route('staff.queue.manage') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Manage Queue
            </a>
            <a href="{{ route('staff.queue.emergency') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                Emergency Queue
            </a>
            <a href="{{ route('staff.queue.priority') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M5 11l7-7 7 7M5 19l7-7 7 7"/></svg>
                Priority Queue
            </a>
            <a href="{{ route('staff.queue.regular') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Regular Queue
            </a>
        </div>

        <div class="sidebar-spacer"></div>
        <div style="padding:0 0.75rem 0.5rem;">
            <div style="display:flex;align-items:center;gap:9px;padding:10px 12px;border-radius:9px;margin-bottom:4px;">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 2)) }}</div>
                <div>
                    <div class="user-name">{{ Auth::user()->name ?? 'Staff' }}</div>
                    <div class="user-role">{{ ucfirst(Auth::user()->role ?? 'Staff') }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="display:flex;align-items:center;gap:9px;width:100%;padding:9px 12px;background:transparent;border:none;border-radius:9px;color:rgba(255,255,255,0.45);font-family:'DM Sans',sans-serif;font-size:0.84rem;font-weight:500;cursor:pointer;transition:background .15s,color .15s;text-align:left;"
                    onmouseover="this.style.background='rgba(226,75,74,0.15)';this.style.color='#ff8a89';"
                    onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.45)';">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" style="width:15px;height:15px;flex-shrink:0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- Main --}}
    <div class="main">
        <header class="topbar">
            <div>
                <h1>Register Patient</h1>
                <span>{{ now()->format('l, F j, Y') }}</span>
            </div>
            <div class="topbar-right">
            </div>
        </header>

        <div class="content">

            <div class="breadcrumb">
                <a href="{{ route('staff.dashboard') }}">Dashboard</a>
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span>Register Patient</span>
            </div>

            @if($errors->any())
                <div class="flash-error">Please fix the errors below before submitting.</div>
            @endif

            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </div>
                    <div>
                        <h2>New Patient Registration</h2>
                        <p>Patient will be registered and immediately queued based on priority. Fields marked <span style="color:var(--red);">*</span> are required.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('staff.patients.store') }}">
                    @csrf
                    <div class="form-body">

                        {{-- ① Emergency Priority (first — most critical decision) --}}
                        <div class="form-section">
                            <p class="form-section-title">Emergency Priority <span style="color:var(--red);">*</span></p>

                            <div class="priority-grid">

                                {{-- Critical --}}
                                <label class="priority-option">
                                    <input type="radio" name="priority" value="critical"
                                        {{ old('priority') === 'critical' ? 'checked' : '' }}>
                                    <div class="priority-card">
                                        <div class="priority-icon icon-critical">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                                        </div>
                                        <span class="priority-badge badge-critical">Critical</span>
                                        <span class="priority-name">Life-Threatening</span>
                                        <span class="priority-desc">Immediate danger to life. Goes straight to the top of the queue.</span>
                                    </div>
                                </label>

                                {{-- Urgent --}}
                                <label class="priority-option">
                                    <input type="radio" name="priority" value="urgent"
                                        {{ old('priority') === 'urgent' ? 'checked' : '' }}>
                                    <div class="priority-card">
                                        <div class="priority-icon icon-urgent">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <span class="priority-badge badge-urgent">Urgent</span>
                                        <span class="priority-name">Needs Prompt Care</span>
                                        <span class="priority-desc">Serious condition. Queued ahead of normal patients.</span>
                                    </div>
                                </label>

                                {{-- Normal --}}
                                <label class="priority-option">
                                    <input type="radio" name="priority" value="normal"
                                        {{ old('priority', 'normal') === 'normal' ? 'checked' : '' }}>
                                    <div class="priority-card">
                                        <div class="priority-icon icon-normal">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <span class="priority-badge badge-normal">Normal</span>
                                        <span class="priority-name">Routine Visit</span>
                                        <span class="priority-desc">Non-urgent. Added to the regular queue in order.</span>
                                    </div>
                                </label>

                            </div>

                            @error('priority')
                                <p class="priority-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ② Personal Information --}}
                        <div class="form-section">
                            <p class="form-section-title">Personal Information</p>

                            <div class="form-row cols-2">
                                <div class="form-group">
                                    <label class="form-label" for="first_name">First Name <span class="req">*</span></label>
                                    <input id="first_name" name="first_name" type="text"
                                        class="form-input {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                        value="{{ old('first_name') }}" placeholder="e.g. Juan" autocomplete="off">
                                    @error('first_name')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="last_name">Last Name <span class="req">*</span></label>
                                    <input id="last_name" name="last_name" type="text"
                                        class="form-input {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                        value="{{ old('last_name') }}" placeholder="e.g. dela Cruz" autocomplete="off">
                                    @error('last_name')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="form-row cols-3">
                                <div class="form-group">
                                    <label class="form-label" for="age">Age <span class="req">*</span></label>
                                    <input id="age" name="age" type="text"
                                        class="form-input {{ $errors->has('age') ? 'is-invalid' : '' }}"
                                        value="{{ old('age') }}" placeholder="e.g. 32" autocomplete="off">
                                    @error('age')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="date_of_birth">Date of Birth</label>
                                    <input id="date_of_birth" name="date_of_birth" type="date"
                                        class="form-input {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                        value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="gender">Gender <span class="req">*</span></label>
                                    <select id="gender" name="gender"
                                        class="form-select {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
                                        <option value="Male"   {{ old('gender') === 'Male'   ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other"  {{ old('gender') === 'Other'  ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- ③ Contact & Address --}}
                        <div class="form-section">
                            <p class="form-section-title">Contact & Address</p>
                            <div class="form-row cols-2">
                                <div class="form-group">
                                    <label class="form-label" for="contact">Contact Number</label>
                                    <input id="contact" name="contact" type="text"
                                        class="form-input {{ $errors->has('contact') ? 'is-invalid' : '' }}"
                                        value="{{ old('contact') }}" placeholder="e.g. 09171234567" autocomplete="off">
                                    @error('contact')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="address">Address</label>
                                    <input id="address" name="address" type="text"
                                        class="form-input {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                        value="{{ old('address') }}" placeholder="e.g. Brgy. Poblacion, Davao City" autocomplete="off">
                                    @error('address')<span class="field-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- ④ Medical --}}
                        <div class="form-section" style="margin-bottom:0;">
                            <p class="form-section-title">Chief Complaint</p>
                            <div class="form-group">
                                <label class="form-label" for="condition">Condition / Complaint</label>
                                <textarea id="condition" name="condition"
                                    class="form-textarea {{ $errors->has('condition') ? 'is-invalid' : '' }}"
                                    placeholder="Briefly describe the patient's chief complaint or presenting condition...">{{ old('condition') }}</textarea>
                                @error('condition')<span class="field-error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-footer">
                        <a href="{{ route('staff.dashboard') }}" class="btn btn-ghost">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Register &amp; Queue Patient
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</body>
</html>