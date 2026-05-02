<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Emergency Walk-in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --teal:#2e9d91;--teal-dark:#1f7a70;--teal-deep:#155c55;--teal-bg:#e8f5f3;
            --red:#e24b4a;--red-bg:#fcebeb;--red-dark:#a32d2d;--red-mid:#c0392b;
            --amber:#ef9f27;--amber-bg:#faeeda;
            --dark:#1a1a1a;--mid:#4a4a4a;--muted:#8a8a8a;
            --border:#e2e8e6;--surface:#f4f7f6;--white:#ffffff;--sidebar-w:240px;
        }
        html,body{height:100%;font-family:'DM Sans',sans-serif;background:var(--surface);color:var(--dark);font-size:14px;}
        .shell{display:flex;min-height:100vh;}

        .sidebar{width:var(--sidebar-w);background:var(--dark);display:flex;flex-direction:column;flex-shrink:0;padding:0 0 1.5rem;}
        .sidebar-logo{display:flex;align-items:center;gap:10px;padding:1.4rem 1.4rem 1rem;border-bottom:1px solid rgba(255,255,255,0.08);margin-bottom:1rem;}
        .sidebar-logo .logo-icon{width:34px;height:34px;background:var(--teal);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .sidebar-logo .logo-icon svg{width:20px;height:20px;}
        .sidebar-logo span{font-family:'DM Serif Display',serif;font-size:1.2rem;color:#fff;letter-spacing:-0.3px;}
        .nav-section{padding:0 0.75rem;margin-bottom:0.25rem;}
        .nav-label{font-size:0.68rem;font-weight:600;color:rgba(255,255,255,0.3);letter-spacing:.1em;text-transform:uppercase;padding:0 0.65rem;margin-bottom:4px;}
        .nav-item{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:9px;color:rgba(255,255,255,0.55);font-size:0.85rem;font-weight:500;text-decoration:none;transition:background .15s,color .15s;margin-bottom:2px;}
        .nav-item svg{width:16px;height:16px;flex-shrink:0;}
        .nav-item:hover{background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.85);}
        .nav-item.active{background:var(--red);color:#fff;}
        .sidebar-spacer{flex:1;}
        .sidebar-user{display:flex;align-items:center;gap:10px;padding:12px 1.4rem;border-top:1px solid rgba(255,255,255,0.08);}
        .avatar{width:32px;height:32px;border-radius:50%;background:var(--teal);display:flex;align-items:center;justify-content:center;font-size:0.75rem;font-weight:600;color:#fff;flex-shrink:0;}
        .sidebar-user .user-name{font-size:0.82rem;font-weight:600;color:#fff;}
        .sidebar-user .user-role{font-size:0.72rem;color:rgba(255,255,255,0.4);}

   
        .main{flex:1;display:flex;flex-direction:column;min-width:0;}
        .topbar{background:var(--white);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 2rem;height:60px;flex-shrink:0;}
        .topbar-left{display:flex;align-items:center;gap:12px;}
        .back-btn{display:flex;align-items:center;gap:6px;color:var(--muted);font-size:0.82rem;text-decoration:none;padding:6px 10px;border-radius:8px;transition:background .15s,color .15s;}
        .back-btn:hover{background:var(--surface);color:var(--dark);}
        .back-btn svg{width:14px;height:14px;}
        .breadcrumb{display:flex;align-items:center;gap:6px;font-size:0.82rem;color:var(--muted);}
        .breadcrumb a{color:var(--teal-dark);text-decoration:none;}

        .emergency-banner{background:var(--red);padding:10px 2rem;display:flex;align-items:center;gap:10px;}
        @keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.6;transform:scale(1.3)}}
        .pulse-dot{width:8px;height:8px;border-radius:50%;background:#fff;animation:pulse 1.4s ease-in-out infinite;flex-shrink:0;}
        .emergency-banner p{font-size:0.82rem;font-weight:600;color:#fff;letter-spacing:.02em;}
        .emergency-banner span{font-size:0.78rem;color:rgba(255,255,255,0.75);margin-left:6px;}

      
        .content{padding:2rem;flex:1;max-width:780px;width:100%;margin:0 auto;}
        .page-header{margin-bottom:1.75rem;}
        .page-header h1{font-family:'DM Serif Display',serif;font-size:1.8rem;color:var(--dark);letter-spacing:-0.4px;}
        .page-header p{font-size:0.88rem;color:var(--muted);margin-top:4px;}

      
        .form-card{background:var(--white);border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:14px;}
        .form-card.danger{border-color:#f7c1c1;}
        .form-card-header{padding:1.1rem 1.5rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;}
        .form-card.danger .form-card-header{border-bottom-color:#f7c1c1;background:#fffafa;}
        .section-icon{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .section-icon svg{width:14px;height:14px;}
        .section-icon.red{background:var(--red-bg);color:var(--red);}
        .section-icon.teal{background:var(--teal-bg);color:var(--teal-dark);}
        .section-icon.amber{background:var(--amber-bg);color:#b36a10;}
        .form-card-header h2{font-size:0.88rem;font-weight:600;color:var(--dark);}
        .form-card-header p{font-size:0.75rem;color:var(--muted);margin-top:1px;}
        .form-card-body{padding:1.5rem;}

      
        .field-grid{display:grid;gap:14px;}
        .grid-2{grid-template-columns:1fr 1fr;}
        .col-span-2{grid-column:span 2;}
        .field{display:flex;flex-direction:column;gap:5px;}
        .field label{font-size:0.75rem;font-weight:600;color:var(--mid);text-transform:uppercase;letter-spacing:.05em;}
        .field label .req{color:var(--red);margin-left:2px;}
        .input-wrap{position:relative;}
        .input-wrap svg.ico{position:absolute;left:12px;top:50%;transform:translateY(-50%);width:14px;height:14px;color:var(--muted);pointer-events:none;}
        input,select,textarea{width:100%;font-family:'DM Sans',sans-serif;font-size:0.9rem;color:var(--dark);background:var(--white);border:1.5px solid var(--border);border-radius:10px;outline:none;transition:border-color .2s,box-shadow .2s;}
        input,select{padding:10px 12px 10px 38px;height:42px;}
        select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%238a8a8a' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 10px center;background-size:14px;padding-right:32px;}
        textarea{padding:10px 12px;resize:vertical;min-height:80px;line-height:1.5;}
        input::placeholder,textarea::placeholder{color:#bcc5c3;}
        input:focus,select:focus,textarea:focus{border-color:var(--teal);box-shadow:0 0 0 3px rgba(46,157,145,.1);}
        input.danger-focus:focus,select.danger-focus:focus{border-color:var(--red);box-shadow:0 0 0 3px rgba(226,75,74,.12);}
        input.is-invalid,select.is-invalid,textarea.is-invalid{border-color:var(--red);}
        .error-msg{font-size:0.75rem;color:var(--red);margin-top:3px;}
        input.no-icon,select.no-icon,textarea.no-icon{padding-left:12px;}

        .unknown-toggle{display:flex;align-items:center;gap:10px;padding:10px 14px;background:var(--red-bg);border:1.5px solid #f7c1c1;border-radius:10px;margin-bottom:14px;cursor:pointer;}
        .unknown-toggle input[type="checkbox"]{width:15px;height:15px;accent-color:var(--red);cursor:pointer;flex-shrink:0;}
        .unknown-toggle label{font-size:0.82rem;font-weight:600;color:var(--red-dark);cursor:pointer;}
        .unknown-toggle span{font-size:0.75rem;color:#c55;margin-left:4px;}

       
        .chip-grid{display:flex;flex-wrap:wrap;gap:8px;margin-top:4px;}
        .chip{position:relative;}
        .chip input[type="checkbox"]{position:absolute;opacity:0;width:0;height:0;}
        .chip-label{display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border:1.5px solid var(--border);border-radius:20px;font-size:0.78rem;font-weight:500;color:var(--mid);cursor:pointer;transition:all .15s;background:var(--white);}
        .chip input:checked + .chip-label{background:var(--red-bg);border-color:var(--red);color:var(--red-dark);}
        .chip-label:hover{border-color:var(--red);color:var(--red-dark);}

        .submit-bar{display:flex;align-items:center;justify-content:flex-end;gap:10px;padding:1.25rem 1.5rem;background:var(--white);border:1px solid var(--border);border-radius:16px;}
        .btn{display:inline-flex;align-items:center;gap:7px;padding:10px 22px;border-radius:50px;font-family:'DM Sans',sans-serif;font-size:0.88rem;font-weight:600;cursor:pointer;border:1.5px solid transparent;text-decoration:none;transition:all .15s;}
        .btn-ghost{background:transparent;color:var(--mid);border-color:var(--border);}
        .btn-ghost:hover{background:var(--surface);}
        .btn-danger{background:var(--red);color:#fff;border-color:var(--red);}
        .btn-danger:hover{background:var(--red-mid);border-color:var(--red-mid);}
        .btn svg{width:14px;height:14px;}

        .info-box{background:var(--red-bg);border:1px solid #f7c1c1;border-radius:12px;padding:12px 16px;margin-bottom:14px;display:flex;gap:10px;align-items:flex-start;}
        .info-box svg{width:16px;height:16px;color:var(--red);flex-shrink:0;margin-top:1px;}
        .info-box p{font-size:0.8rem;color:var(--red-dark);line-height:1.5;}

        @media(max-width:900px){.sidebar{display:none;}.grid-2{grid-template-columns:1fr;}.col-span-2{grid-column:span 1;}}
    </style>
</head>
<body>
<div class="shell">
    <nav class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon"><svg viewBox="0 0 100 100" fill="none"><path d="M50 85C50 85 10 60 10 35C10 20 22 10 35 10C42 10 48 14 50 18C52 14 58 10 65 10C78 10 90 20 90 35C90 60 50 85 50 85Z" stroke="#fff" stroke-width="6" fill="none" stroke-linejoin="round"/><rect x="42" y="32" width="16" height="36" rx="6" fill="#fff"/><rect x="32" y="42" width="36" height="16" rx="6" fill="#fff"/></svg></div>
            <span>MedSyst</span>
        </div>
        <div class="nav-section">
            <p class="nav-label">Overview</p>
            <a href="{{ route('dashboard') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Dashboard
            </a>
        </div>
        <div class="nav-section">
            <p class="nav-label">Management</p>
            <a href="{{ route('patients.create') }}" class="nav-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Register Patient
            </a>
            <a href="{{ route('emergency.create') }}" class="nav-item active">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                Emergency Walk-in
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
                    <span>Emergency Walk-in</span>
                </div>
            </div>
        </header>

        {{-- Emergency banner --}}
        <div class="emergency-banner">
            <span class="pulse-dot"></span>
            <p>EMERGENCY INTAKE <span>— This patient will be placed at the top of the queue immediately regardless of waiting order.</span></p>
        </div>

        <div class="content">
            <div class="page-header">
                <h1>Emergency Walk-in</h1>
                <p>Critical patient with no prior record. A temporary profile will be auto-created. Staff can update details later.</p>
            </div>

            <div class="info-box">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p>If the patient is unconscious or unresponsive and details are unavailable, check <strong>"Unknown / No Record"</strong> below. A temporary record will be created automatically with status set to <strong>Critical</strong>.</p>
            </div>

            @if ($errors->any())
            <div style="background:var(--red-bg);border:1px solid #f7c1c1;border-radius:10px;padding:12px 16px;margin-bottom:14px;">
                @foreach ($errors->all() as $error)
                    <p style="font-size:0.82rem;color:var(--red-dark);">{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('emergency.store') }}">
                @csrf

                {{-- Unknown patient toggle --}}
                <div class="form-card danger">
                    <div class="form-card-header">
                        <div class="section-icon red">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h2>Patient Identity</h2>
                            <p>Enter whatever information is available — even partial details help</p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <label class="unknown-toggle">
                            <input type="checkbox" name="is_unknown" id="unknownToggle" value="1" {{ old('is_unknown') ? 'checked' : '' }}>
                            <label for="unknownToggle">Unknown / No Record</label>
                            <span>— Patient is unconscious or identity cannot be confirmed</span>
                        </label>

                        <div class="field-grid grid-2" id="identityFields">
                            <div class="field">
                                <label>First Name</label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <input type="text" name="first_name" id="firstName" value="{{ old('first_name') }}" placeholder="Unknown" class="danger-focus {{ $errors->has('first_name') ? 'is-invalid' : '' }}">
                                </div>
                            </div>
                            <div class="field">
                                <label>Last Name</label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <input type="text" name="last_name" id="lastName" value="{{ old('last_name') }}" placeholder="Walk-in" class="danger-focus {{ $errors->has('last_name') ? 'is-invalid' : '' }}">
                                </div>
                            </div>
                            <div class="field">
                                <label>Approximate Age</label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <input type="number" name="age" value="{{ old('age') }}" placeholder="e.g. 45" min="0" max="150" class="danger-focus">
                                </div>
                            </div>
                            <div class="field">
                                <label>Gender</label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="4"/></svg>
                                    <select name="gender" class="danger-focus">
                                        <option value="" {{ !old('gender') ? 'selected' : '' }}>Unknown</option>
                                        <option value="Male"   {{ old('gender')=='Male'   ? 'selected':'' }}>Male</option>
                                        <option value="Female" {{ old('gender')=='Female' ? 'selected':'' }}>Female</option>
                                        <option value="Other"  {{ old('gender')=='Other'  ? 'selected':'' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <label>Contact Number (if known)</label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    <input type="text" name="contact" value="{{ old('contact') }}" placeholder="09XX XXX XXXX" class="danger-focus">
                                </div>
                            </div>
                            <div class="field">
                                <label>Address (if known)</label>
                                <div class="input-wrap">
                                    <svg class="ico" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Unknown" class="danger-focus">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Emergency condition --}}
                <div class="form-card danger">
                    <div class="form-card-header">
                        <div class="section-icon red">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        <div>
                            <h2>Emergency Condition</h2>
                            <p>Describe symptoms observed — select all that apply</p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="field" style="margin-bottom:14px;">
                            <label>Presenting Symptoms <span class="req">*</span></label>
                            <div class="chip-grid">
                                @php
                                $symptoms = ['Chest Pain','Difficulty Breathing','Loss of Consciousness','Seizures','Severe Bleeding','Head Trauma','Stroke Symptoms','High Fever','Severe Abdominal Pain','Allergic Reaction','Cardiac Arrest','Multiple Injuries','Poisoning / Overdose','Burns','Other'];
                                @endphp
                                @foreach($symptoms as $symptom)
                                <label class="chip">
                                    <input type="checkbox" name="symptoms[]" value="{{ $symptom }}" {{ in_array($symptom, old('symptoms', [])) ? 'checked' : '' }}>
                                    <span class="chip-label">{{ $symptom }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="field">
                            <label>Additional Notes / Observed Condition <span class="req">*</span></label>
                            <textarea name="condition" rows="3" required placeholder="Describe what you observed when the patient arrived..." class="no-icon {{ $errors->has('condition') ? 'is-invalid' : '' }}">{{ old('condition') }}</textarea>
                            @error('condition')<p class="error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Hidden priority — always critical for emergency --}}
                <input type="hidden" name="priority" value="critical">

                {{-- Submit --}}
                <div class="submit-bar">
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-danger">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                        Register Emergency — Skip Queue
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    const toggle = document.getElementById('unknownToggle');
    const fn = document.getElementById('firstName');
    const ln = document.getElementById('lastName');
    function applyUnknown() {
        if (toggle.checked) {
            fn.value = 'Unknown'; fn.readOnly = true;
            ln.value = 'Walk-in'; ln.readOnly = true;
            fn.style.background = '#fdf0f0'; ln.style.background = '#fdf0f0';
        } else {
            fn.readOnly = false; ln.readOnly = false;
            if (fn.value === 'Unknown') fn.value = '';
            if (ln.value === 'Walk-in') ln.value = '';
            fn.style.background = ''; ln.style.background = '';
        }
    }
    toggle.addEventListener('change', applyUnknown);
    applyUnknown();
</script>
</body>
</html>