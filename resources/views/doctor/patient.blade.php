<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Patient Detail</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{
            --teal:#2e9d91;--teal-dark:#1f7a70;--teal-deep:#155c55;--teal-bg:#e8f5f3;
            --red:#e24b4a;--red-bg:#fcebeb;--red-dark:#a32d2d;
            --amber:#ef9f27;--amber-bg:#faeeda;--amber-dark:#b36a10;
            --green:#3b9e3b;--green-bg:#eaf3de;
            --dark:#1a1a1a;--mid:#4a4a4a;--muted:#8a8a8a;
            --border:#e2e8e6;--surface:#f4f7f6;--white:#fff;
        }
        html,body{height:100%;font-family:'DM Sans',sans-serif;background:var(--surface);font-size:14px;color:var(--dark);}
        .shell{display:flex;min-height:100vh;}

    
        .sidebar{width:220px;background:var(--dark);display:flex;flex-direction:column;flex-shrink:0;position:sticky;top:0;height:100vh;}
        .sidebar-logo{display:flex;align-items:center;gap:10px;padding:1.4rem;border-bottom:1px solid rgba(255,255,255,0.08);}
        .logo-box{width:32px;height:32px;background:var(--teal);border-radius:8px;display:flex;align-items:center;justify-content:center;}
        .logo-box svg{width:18px;height:18px;}
        .brand{font-family:'DM Serif Display',serif;font-size:1.15rem;color:#fff;}
        .nav{flex:1;padding:1rem 0.75rem;}
        .nav-label{font-size:0.65rem;font-weight:700;color:rgba(255,255,255,0.28);letter-spacing:.12em;text-transform:uppercase;padding:0 0.65rem;margin-bottom:5px;}
        .nav-link{display:flex;align-items:center;gap:9px;padding:9px 12px;border-radius:9px;color:rgba(255,255,255,0.55);font-size:0.84rem;font-weight:500;text-decoration:none;transition:background .15s,color .15s;margin-bottom:2px;}
        .nav-link svg{width:15px;height:15px;flex-shrink:0;}
        .nav-link.active{background:var(--teal);color:#fff;}
        .nav-link:hover{background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.88);}
        .sidebar-footer{padding:0 0.75rem 0.75rem;border-top:1px solid rgba(255,255,255,0.08);}
        .user-row{display:flex;align-items:center;gap:9px;padding:12px 12px 8px;}
        .avatar{width:32px;height:32px;border-radius:50%;background:var(--teal);display:flex;align-items:center;justify-content:center;font-size:0.72rem;font-weight:700;color:#fff;flex-shrink:0;}
        .uname{font-size:0.8rem;font-weight:600;color:#fff;}
        .urole{font-size:0.68rem;color:rgba(255,255,255,0.38);text-transform:capitalize;}
        .logout-btn{display:flex;align-items:center;gap:9px;width:100%;padding:9px 12px;background:transparent;border:none;border-radius:9px;color:rgba(255,255,255,0.45);font-family:'DM Sans',sans-serif;font-size:0.84rem;font-weight:500;cursor:pointer;transition:background .15s,color .15s;text-align:left;}
        .logout-btn svg{width:15px;height:15px;}
        .logout-btn:hover{background:rgba(226,75,74,0.15);color:#ff8a89;}

   
        .main{flex:1;display:flex;flex-direction:column;min-width:0;}
        .topbar{background:var(--white);border-bottom:1px solid var(--border);padding:0 2rem;height:58px;display:flex;align-items:center;gap:12px;position:sticky;top:0;z-index:10;flex-shrink:0;}
        .back-btn{display:flex;align-items:center;gap:6px;color:var(--muted);font-size:0.82rem;text-decoration:none;padding:6px 10px;border-radius:8px;transition:background .15s,color .15s;}
        .back-btn:hover{background:var(--surface);color:var(--dark);}
        .back-btn svg{width:14px;height:14px;}
        .breadcrumb{display:flex;align-items:center;gap:6px;font-size:0.82rem;color:var(--muted);}
        .breadcrumb a{color:var(--teal-dark);text-decoration:none;}

      
        .content{padding:1.75rem 2rem;max-width:820px;}

  
        .flash{padding:10px 16px;border-radius:10px;margin-bottom:1.25rem;font-size:0.82rem;}
        .flash-success{background:var(--green-bg);border:1px solid #c0dd97;color:#2a5a11;}

   
        .page-head{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:12px;}
        .page-head h1{font-family:'DM Serif Display',serif;font-size:1.7rem;color:var(--dark);letter-spacing:-0.4px;}
        .page-head p{font-size:0.85rem;color:var(--muted);margin-top:3px;}

        .info-card{background:var(--white);border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:14px;}
        .info-card-header{padding:1rem 1.25rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;}
        .info-card-icon{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .info-card-icon svg{width:14px;height:14px;}
        .info-card-header h2{font-size:0.88rem;font-weight:600;color:var(--dark);}
        .info-card-body{padding:1.25rem;}
        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
        .info-item label{font-size:0.7rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:3px;}
        .info-item p{font-size:0.88rem;color:var(--dark);font-weight:500;}
        .info-item p.empty{color:var(--muted);font-weight:400;font-style:italic;}

    
        .condition-box{background:var(--surface);border:1px solid var(--border);border-radius:10px;padding:12px 14px;font-size:0.88rem;color:var(--dark);line-height:1.6;}

        .history-row{display:flex;align-items:center;justify-content:space-between;padding:10px 1.25rem;border-bottom:1px solid var(--border);}
        .history-row:last-child{border-bottom:none;}

      
        .badge{display:inline-block;padding:2px 9px;border-radius:20px;font-size:0.68rem;font-weight:600;}
        .b-critical{background:var(--red-bg);color:var(--red-dark);}
        .b-urgent{background:var(--amber-bg);color:var(--amber-dark);}
        .b-normal{background:var(--teal-bg);color:var(--teal-deep);}
        .b-waiting{background:#f1f0ea;color:#5a5745;}
        .b-called{background:var(--amber-bg);color:var(--amber-dark);}
        .b-serving{background:var(--teal-bg);color:var(--teal-deep);}
        .b-done{background:var(--green-bg);color:#2a5a11;}
        .b-male{background:#e8f0fe;color:#3b5bdb;}
        .b-female{background:#fce4ec;color:#c2185b;}
        .b-other,.b-unknown{background:#f1f0ea;color:#5a5745;}

        .btn{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:50px;font-family:'DM Sans',sans-serif;font-size:0.82rem;font-weight:600;cursor:pointer;border:1.5px solid transparent;text-decoration:none;transition:all .15s;}
        .btn svg{width:13px;height:13px;}
        .btn-ghost{background:transparent;color:var(--mid);border-color:var(--border);}
        .btn-ghost:hover{background:var(--surface);border-color:var(--teal);color:var(--teal);}
        .btn-green{background:var(--green-bg);color:#2a5a11;border-color:#c0dd97;}
        .btn-green:hover{background:#d5edbe;border-color:#a8cc7a;}
        .btn-sm{padding:6px 13px;font-size:0.75rem;}

        @media(max-width:900px){.sidebar{display:none;}.info-grid{grid-template-columns:1fr;}}
    </style>
</head>
<body>
<div class="shell">

    {{-- Sidebar --}}
    <nav class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-box">
                <svg viewBox="0 0 100 100" fill="none">
                    <path d="M50 85C50 85 10 60 10 35C10 20 22 10 35 10C42 10 48 14 50 18C52 14 58 10 65 10C78 10 90 20 90 35C90 60 50 85 50 85Z" stroke="#fff" stroke-width="6" fill="none" stroke-linejoin="round"/>
                    <rect x="42" y="32" width="16" height="36" rx="6" fill="#fff"/>
                    <rect x="32" y="42" width="36" height="16" rx="6" fill="#fff"/>
                </svg>
            </div>
            <span class="brand">MedSyst</span>
        </div>
        <div class="nav">
            <p class="nav-label" style="margin-bottom:8px;">My Queue</p>
            <a href="{{ route('doctor.dashboard') }}" class="nav-link">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Dashboard
            </a>
        </div>
        <div class="sidebar-footer">
            <div class="user-row">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'D', 0, 2)) }}</div>
                <div>
                    <div class="uname">{{ Auth::user()->name ?? 'Doctor' }}</div>
                    <div class="urole">{{ ucfirst(Auth::user()->role ?? 'doctor') }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- Main --}}
    <div class="main">
        <header class="topbar">
            <a href="{{ route('doctor.dashboard') }}" class="back-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Back
            </a>
            <div class="breadcrumb">
                <a href="{{ route('doctor.dashboard') }}">Dashboard</a>
                <span>/</span>
                <span>Patient Detail</span>
            </div>
        </header>

        <div class="content">

            @if(session('success'))
                <div class="flash flash-success">{{ session('success') }}</div>
            @endif

            {{-- Page header --}}
            <div class="page-head">
                <div>
                    <h1>{{ $patient->first_name ?? 'Unknown' }} {{ $patient->last_name ?? 'Walk-in' }}</h1>
                    <p>Queue #{{ $queue->queue_number }} · Registered {{ $patient->created_at->format('M d, Y h:i A') }}</p>
                </div>
                @if($queue->status !== 'done')
                <form method="POST" action="{{ route('doctor.done', $queue->id) }}">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn btn-green"
                        onclick="return confirm('Mark this patient as done?')">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Mark as Done
                    </button>
                </form>
                @else
                <span class="badge b-done" style="font-size:0.78rem;padding:5px 14px;">✓ Consultation Done</span>
                @endif
            </div>

            {{-- Personal info --}}
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon" style="background:var(--teal-bg);color:var(--teal-dark);">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h2>Personal Information</h2>
                </div>
                <div class="info-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Full Name</label>
                            <p>{{ ($patient->first_name ?? 'Unknown') . ' ' . ($patient->last_name ?? 'Walk-in') }}</p>
                        </div>
                        <div class="info-item">
                            <label>Age</label>
                            <p>{{ $patient->age ? $patient->age . ' years old' : '' }}<span class="{{ $patient->age ? '' : 'empty' }}">{{ $patient->age ? '' : 'Not provided' }}</span></p>
                        </div>
                        <div class="info-item">
                            <label>Gender</label>
                            <p>
                                @if($patient->gender)
                                    <span class="badge b-{{ strtolower($patient->gender) }}">{{ $patient->gender }}</span>
                                @else
                                    <span class="empty">Not provided</span>
                                @endif
                            </p>
                        </div>
                        <div class="info-item">
                            <label>Date of Birth</label>
                            <p>{{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('F d, Y') : '' }}<span class="{{ $patient->date_of_birth ? '' : 'empty' }}">{{ $patient->date_of_birth ? '' : 'Not provided' }}</span></p>
                        </div>
                        <div class="info-item">
                            <label>Contact Number</label>
                            <p>{{ $patient->contact ?? '' }}<span class="{{ $patient->contact ? '' : 'empty' }}">{{ $patient->contact ? '' : 'Not provided' }}</span></p>
                        </div>
                        <div class="info-item">
                            <label>Address</label>
                            <p>{{ $patient->address ?? '' }}<span class="{{ $patient->address ? '' : 'empty' }}">{{ $patient->address ? '' : 'Not provided' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chief complaint --}}
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon" style="background:var(--red-bg);color:var(--red);">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h2>Chief Complaint / Condition</h2>
                </div>
                <div class="info-card-body">
                    <div class="condition-box">
                        {{ $patient->condition ?? 'No condition recorded.' }}
                    </div>
                </div>
            </div>

            {{-- Queue info --}}
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon" style="background:var(--amber-bg);color:var(--amber-dark);">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h2>Queue Information</h2>
                </div>
                <div class="info-card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Queue Number</label>
                            <p style="font-family:'DM Serif Display',serif;font-size:1.2rem;">{{ $queue->queue_number }}</p>
                        </div>
                        <div class="info-item">
                            <label>Priority</label>
                            <p><span class="badge b-{{ $queue->priority }}">{{ ucfirst($queue->priority) }}</span></p>
                        </div>
                        <div class="info-item">
                            <label>Current Status</label>
                            <p><span class="badge b-{{ $queue->status }}">{{ ucfirst($queue->status) }}</span></p>
                        </div>
                        <div class="info-item">
                            <label>Called At</label>
                            <p>{{ $queue->called_at ? $queue->called_at->format('h:i A') : '' }}<span class="{{ $queue->called_at ? '' : 'empty' }}">{{ $queue->called_at ? '' : 'Not yet called' }}</span></p>
                        </div>
                        <div class="info-item">
                            <label>Arrived</label>
                            <p>{{ $queue->created_at->format('h:i A') }}</p>
                        </div>
                        <div class="info-item">
                            <label>Wait Time</label>
                            <p>{{ $queue->created_at ? now()->diffInMinutes($queue->created_at) . ' minutes' : '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visit history --}}
            @if($history->count() > 1)
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon" style="background:var(--surface);color:var(--muted);">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2>Visit History</h2>
                </div>
                @foreach($history as $h)
                <div class="history-row">
                    <div>
                        <div style="font-size:0.83rem;font-weight:600;color:var(--dark);">#{{ $h->queue_number }}</div>
                        <div style="font-size:0.72rem;color:var(--muted);">{{ $h->created_at->format('M d, Y · h:i A') }}</div>
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <span class="badge b-{{ $h->priority }}">{{ ucfirst($h->priority) }}</span>
                        <span class="badge b-{{ $h->status }}">{{ ucfirst($h->status) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            {{-- Consultation Notes --}}
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon" style="background:#f0f4ff;color:#3b5bdb;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h2>Consultation Notes</h2>
                </div>
                <div class="info-card-body">
                    <form method="POST" action="{{ route('doctor.notes', $queue->id) }}">
                        @csrf @method('PATCH')
                        <textarea
                            name="notes"
                            rows="5"
                            style="width:100%;padding:10px 13px;border:1.5px solid var(--border);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:0.88rem;color:var(--dark);resize:vertical;outline:none;transition:border-color .15s;"
                            onfocus="this.style.borderColor='var(--teal)';this.style.boxShadow='0 0 0 3px rgba(46,157,145,.1)';"
                            onblur="this.style.borderColor='var(--border)';this.style.boxShadow='none';"
                            placeholder="Write your consultation notes, diagnosis, prescription, follow-up instructions...">{{ old('notes', $queue->notes ?? '') }}</textarea>

                        <div style="display:flex;justify-content:flex-end;margin-top:10px;">
                            <button type="submit" class="btn btn-teal"
                                style="background:var(--teal);color:#fff;border-color:var(--teal);">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width:13px;height:13px;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                Save Notes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>