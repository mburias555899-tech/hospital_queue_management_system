<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — {{ $patient->full_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{
            --teal:#2e9d91;--teal-dark:#1f7a70;--teal-deep:#155c55;--teal-bg:#e8f5f3;
            --red:#e24b4a;--red-bg:#fcebeb;--red-dark:#a32d2d;
            --amber:#ef9f27;--amber-bg:#faeeda;--amber-dark:#b36a10;
            --green:#3b9e3b;--green-bg:#eaf3de;
            --dark:#1a1a1a;--mid:#4a4a4a;--muted:#8a8a8a;
            --border:#e2e8e6;--surface:#f4f7f6;--white:#ffffff;
        }
        html,body{height:100%;font-family:'DM Sans',sans-serif;background:var(--surface);color:var(--dark);font-size:14px;}
        .shell{display:flex;min-height:100vh;}

        /* Sidebar */
        .sidebar{width:220px;background:var(--dark);display:flex;flex-direction:column;flex-shrink:0;position:sticky;top:0;height:100vh;}
        .sidebar-logo{display:flex;align-items:center;gap:10px;padding:1.4rem;border-bottom:1px solid rgba(255,255,255,0.08);}
        .logo-box{width:32px;height:32px;background:var(--teal);border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .logo-box svg{width:18px;height:18px;}
        .brand{font-family:'DM Serif Display',serif;font-size:1.15rem;color:#fff;letter-spacing:-0.3px;}
        .nav{flex:1;padding:1rem 0.75rem;display:flex;flex-direction:column;gap:2px;}
        .nav-group{margin-bottom:1.25rem;}
        .nav-group-label{font-size:0.65rem;font-weight:700;color:rgba(255,255,255,0.28);letter-spacing:.12em;text-transform:uppercase;padding:0 0.65rem;margin-bottom:5px;}
        .nav-link{display:flex;align-items:center;gap:9px;padding:9px 12px;border-radius:9px;color:rgba(255,255,255,0.52);font-size:0.84rem;font-weight:500;text-decoration:none;transition:background .15s,color .15s;}
        .nav-link svg{width:15px;height:15px;flex-shrink:0;}
        .nav-link:hover{background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.88);}
        .nav-link.active{background:var(--teal);color:#fff;}
        .sidebar-footer{padding:1rem 0.75rem;border-top:1px solid rgba(255,255,255,0.08);}
        .user-row{display:flex;align-items:center;gap:9px;padding:8px 10px;margin-bottom:8px;}
        .user-av{width:30px;height:30px;border-radius:50%;background:var(--teal);display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:#fff;flex-shrink:0;}
        .uname{font-size:0.8rem;font-weight:600;color:#fff;}
        .urole{font-size:0.68rem;color:rgba(255,255,255,0.38);text-transform:capitalize;}
        .logout-btn{display:flex;align-items:center;gap:9px;width:100%;padding:9px 12px;background:transparent;border:none;border-radius:9px;color:rgba(255,255,255,0.45);font-family:'DM Sans',sans-serif;font-size:0.84rem;font-weight:500;cursor:pointer;transition:background .15s,color .15s;text-align:left;}
        .logout-btn svg{width:15px;height:15px;}
        .logout-btn:hover{background:rgba(226,75,74,0.15);color:#ff8a89;}

        /* Main */
        .main{flex:1;display:flex;flex-direction:column;min-width:0;}
        .topbar{background:var(--white);border-bottom:1px solid var(--border);padding:0 2rem;height:58px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:10;flex-shrink:0;}
        .topbar-left{display:flex;align-items:center;gap:12px;}
        .back-btn{display:flex;align-items:center;gap:6px;color:var(--muted);font-size:0.82rem;text-decoration:none;padding:6px 10px;border-radius:8px;transition:background .15s,color .15s;}
        .back-btn:hover{background:var(--surface);color:var(--dark);}
        .back-btn svg{width:14px;height:14px;}
        .breadcrumb{display:flex;align-items:center;gap:6px;font-size:0.82rem;color:var(--muted);}
        .breadcrumb a{color:var(--teal-dark);text-decoration:none;}
        .breadcrumb svg{width:11px;height:11px;}

        /* Buttons */
        .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:50px;font-family:'DM Sans',sans-serif;font-size:0.8rem;font-weight:600;cursor:pointer;border:1.5px solid transparent;text-decoration:none;transition:all .15s;}
        .btn svg{width:12px;height:12px;}
        .btn-ghost{background:transparent;color:var(--mid);border-color:var(--border);}
        .btn-ghost:hover{background:var(--surface);border-color:var(--teal);color:var(--teal);}
        .btn-sm{padding:6px 13px;font-size:0.75rem;}

        /* Content */
        .content{padding:1.75rem 2rem;display:flex;flex-direction:column;gap:16px;}

        /* Patient hero card */
        .hero-card{background:var(--white);border:1px solid var(--border);border-radius:16px;padding:1.5rem;display:flex;align-items:center;gap:20px;}
        .hero-avatar{width:64px;height:64px;border-radius:50%;background:var(--teal-bg);color:var(--teal-deep);display:flex;align-items:center;justify-content:center;font-family:'DM Serif Display',serif;font-size:1.5rem;font-weight:700;flex-shrink:0;}
        .hero-name{font-family:'DM Serif Display',serif;font-size:1.5rem;color:var(--dark);letter-spacing:-0.3px;}
        .hero-sub{font-size:0.8rem;color:var(--muted);margin-top:3px;display:flex;align-items:center;gap:8px;}
        .hero-sub span{display:flex;align-items:center;gap:4px;}
        .hero-meta{margin-left:auto;display:flex;flex-direction:column;align-items:flex-end;gap:6px;}
        .badge{display:inline-block;padding:3px 11px;border-radius:20px;font-size:0.72rem;font-weight:600;}
        .b-male{background:#e8f0fe;color:#3b5bdb;}
        .b-female{background:#fce4ec;color:#c2185b;}
        .b-other,.b-unknown{background:#f1f0ea;color:#5a5745;}
        .registered-tag{font-size:0.72rem;color:var(--muted);}

        /* Info grid */
        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
        .info-card{background:var(--white);border:1px solid var(--border);border-radius:14px;overflow:hidden;}
        .info-card-header{display:flex;align-items:center;gap:8px;padding:12px 16px;border-bottom:1px solid var(--border);background:var(--surface);}
        .info-card-header svg{width:14px;height:14px;color:var(--teal);}
        .info-card-header h3{font-size:0.82rem;font-weight:700;color:var(--dark);}
        .info-card-body{padding:14px 16px;display:flex;flex-direction:column;gap:12px;}
        .info-row{display:flex;flex-direction:column;gap:2px;}
        .info-label{font-size:0.68rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;}
        .info-value{font-size:0.85rem;color:var(--dark);font-weight:500;}
        .info-value.empty{color:var(--muted);font-weight:400;}

        /* Condition card (full width) */
        .condition-card{background:var(--white);border:1px solid var(--border);border-radius:14px;overflow:hidden;}
        .condition-body{padding:14px 16px;font-size:0.85rem;color:var(--mid);line-height:1.6;}

        /* Queue history */
        .queue-card{background:var(--white);border:1px solid var(--border);border-radius:14px;overflow:hidden;}
        .queue-card-header{display:flex;align-items:center;justify-content:space-between;padding:12px 16px;border-bottom:1px solid var(--border);background:var(--surface);}
        .queue-card-header h3{font-size:0.82rem;font-weight:700;color:var(--dark);display:flex;align-items:center;gap:7px;}
        .queue-card-header h3 svg{width:14px;height:14px;color:var(--teal);}
        .data-table{width:100%;border-collapse:collapse;}
        .data-table thead tr{background:var(--surface);border-bottom:1px solid var(--border);}
        .data-table th{padding:8px 14px;text-align:left;font-size:0.68rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;white-space:nowrap;}
        .data-table td{padding:10px 14px;font-size:0.82rem;color:var(--dark);border-bottom:1px solid var(--border);vertical-align:middle;}
        .data-table tbody tr:last-child td{border-bottom:none;}
        .data-table tbody tr:hover{background:#fafcfc;}
        .empty-cell{text-align:center;padding:2rem;color:var(--muted);font-size:0.83rem;}

        /* Queue status/priority badges */
        .badge-critical{background:var(--red-bg);color:var(--red-dark);}
        .badge-urgent{background:var(--amber-bg);color:var(--amber-dark);}
        .badge-normal{background:var(--teal-bg);color:var(--teal-deep);}
        .badge-waiting{background:#f1f0ea;color:#5a5745;}
        .badge-serving{background:var(--teal-bg);color:var(--teal-deep);}
        .badge-completed{background:var(--green-bg);color:#2a5a11;}

        @media(max-width:960px){
            .sidebar{display:none;}
            .info-grid{grid-template-columns:1fr;}
        }
    </style>
</head>
<body>
<div class="shell">

    {{-- Sidebar --}}
    <nav class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-box">
                <svg viewBox="0 0 100 100" fill="none"><path d="M50 85C50 85 10 60 10 35C10 20 22 10 35 10C42 10 48 14 50 18C52 14 58 10 65 10C78 10 90 20 90 35C90 60 50 85 50 85Z" stroke="#fff" stroke-width="6" fill="none" stroke-linejoin="round"/><rect x="42" y="32" width="16" height="36" rx="6" fill="#fff"/><rect x="32" y="42" width="36" height="16" rx="6" fill="#fff"/></svg>
            </div>
            <span class="brand">MedSyst</span>
        </div>
        <div class="nav">
            <div class="nav-group">
                <div class="nav-group-label">Overview</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                    Dashboard
                </a>
            </div>
            <div class="nav-group">
                <div class="nav-group-label">Records</div>
                <a href="{{ route('admin.patients.index') }}" class="nav-link active">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Patient Records
                </a>
                <a href="{{ route('admin.reports.index') }}" class="nav-link">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Reports
                </a>
            </div>
            <div class="nav-group">
                <div class="nav-group-label">Administration</div>
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 014-4h0a4 4 0 014 4v2M9 7a3 3 0 116 0 3 3 0 01-6 0z"/></svg>
                    User Accounts
                </a>
            </div>
        </div>
        <div class="sidebar-footer">
            <div class="user-row">
                <div class="user-av">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}</div>
                <div>
                    <div class="uname">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="urole">{{ Auth::user()->role ?? 'admin' }}</div>
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
            <div class="topbar-left">
                <a href="{{ route('admin.patients.index') }}" class="back-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    <a href="{{ route('admin.patients.index') }}">Patient Records</a>
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    <span>{{ $patient->full_name }}</span>
                </div>
            </div>
        </header>

        <div class="content">

            {{-- Hero card --}}
            <div class="hero-card">
                <div class="hero-avatar">{{ $patient->initials }}</div>
                <div>
                    <div class="hero-name">{{ $patient->full_name }}</div>
                    <div class="hero-sub">
                        <span>Patient #{{ $patient->id }}</span>
                        <span style="color:var(--border);">·</span>
                        <span>{{ $patient->age ?? '—' }} yrs old</span>
                        @if($patient->date_of_birth)
                        <span style="color:var(--border);">·</span>
                        <span>Born {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('F j, Y') }}</span>
                        @endif
                    </div>
                </div>
                <div class="hero-meta">
                    <span class="badge b-{{ strtolower($patient->gender ?? 'unknown') }}">
                        {{ $patient->gender ?? 'Unknown' }}
                    </span>
                    <span class="registered-tag">Registered {{ $patient->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            {{-- Info grid --}}
            <div class="info-grid">

                {{-- Contact info --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <h3>Contact Information</h3>
                    </div>
                    <div class="info-card-body">
                        <div class="info-row">
                            <span class="info-label">Contact Number</span>
                            <span class="info-value {{ $patient->contact ? '' : 'empty' }}">
                                {{ $patient->contact ?? 'Not provided' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Address</span>
                            <span class="info-value {{ $patient->address ? '' : 'empty' }}">
                                {{ $patient->address ?? 'Not provided' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Personal info --}}
                <div class="info-card">
                    <div class="info-card-header">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <h3>Personal Details</h3>
                    </div>
                    <div class="info-card-body">
                        <div class="info-row">
                            <span class="info-label">Full Name</span>
                            <span class="info-value">{{ $patient->full_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Age</span>
                            <span class="info-value {{ $patient->age ? '' : 'empty' }}">
                                {{ $patient->age ? $patient->age . ' years old' : 'Not provided' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Date of Birth</span>
                            <span class="info-value {{ $patient->date_of_birth ? '' : 'empty' }}">
                                {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('F j, Y') : 'Not provided' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Gender</span>
                            <span class="info-value">{{ $patient->gender ?? 'Unknown' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Condition --}}
            <div class="condition-card">
                <div class="info-card-header" style="padding:12px 16px;border-bottom:1px solid var(--border);background:var(--surface);display:flex;align-items:center;gap:8px;">
                    <svg style="width:14px;height:14px;color:var(--teal);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <h3 style="font-size:0.82rem;font-weight:700;color:var(--dark);">Chief Complaint / Condition</h3>
                </div>
                <div class="condition-body">
                    {{ $patient->condition ?? 'No condition recorded.' }}
                </div>
            </div>

            {{-- Queue history --}}
            <div class="queue-card">
                <div class="queue-card-header">
                    <h3>
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        Queue History
                    </h3>
                    <span style="font-size:0.75rem;color:var(--muted);">{{ $queues->count() }} visit(s)</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Queue #</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Wait Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($queues as $queue)
                        <tr>
                            <td><strong style="font-family:'DM Serif Display',serif;font-size:1rem;">{{ $queue->queue_number }}</strong></td>
                            <td><span class="badge badge-{{ $queue->priority }}">{{ ucfirst($queue->priority) }}</span></td>
                            <td><span class="badge badge-{{ $queue->status }}">{{ ucfirst($queue->status) }}</span></td>
                            <td style="font-size:0.8rem;color:var(--mid);">{{ $queue->doctor->name ?? '—' }}</td>
                            <td style="font-size:0.78rem;color:var(--muted);white-space:nowrap;">{{ $queue->created_at->format('M d, Y · g:i A') }}</td>
                            <td style="font-size:0.78rem;color:var(--muted);">{{ $queue->wait_label }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="empty-cell">No queue history for this patient.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>