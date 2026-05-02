<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Staff Dashboard</title>
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
        .btn-primary{background:var(--dark);color:#fff;border-color:var(--dark);}
        .btn-primary:hover{background:var(--teal-deep);border-color:var(--teal-deep);}
        .btn-ghost{background:transparent;color:var(--mid);border-color:var(--border);}
        .btn-ghost:hover{background:var(--surface);border-color:var(--teal);color:var(--teal);}
        .btn-danger{background:transparent;color:var(--red);border-color:#f7c1c1;}
        .btn-danger:hover{background:var(--red-bg);}
        .btn-sm{padding:6px 14px;font-size:0.78rem;}

        .content{padding:1.75rem 2rem;flex:1;}

        
        .stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:1.75rem;}
        .stat-card{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:1.1rem 1.25rem;}
        .stat-card.teal{border-left:4px solid var(--teal);}
        .stat-card.amber{border-left:4px solid var(--amber);}
        .stat-card.green{border-left:4px solid var(--green);}
        .stat-card.red{border-left:4px solid var(--red);}
        .stat-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;}
        .stat-label{font-size:0.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;}
        .stat-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;}
        .stat-icon svg{width:14px;height:14px;}
        .stat-icon.teal{background:var(--teal-bg);color:var(--teal-dark);}
        .stat-icon.amber{background:var(--amber-bg);color:var(--amber-dark);}
        .stat-icon.green{background:var(--green-bg);color:#2a5a11;}
        .stat-icon.red{background:var(--red-bg);color:var(--red-dark);}
        .stat-number{font-family:'DM Serif Display',serif;font-size:2rem;color:var(--dark);line-height:1;}
        .stat-sub{font-size:0.72rem;color:var(--muted);margin-top:4px;}

    
        .section-title{font-size:0.9rem;font-weight:600;color:var(--dark);margin-bottom:0.75rem;}
        .action-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:1.75rem;}
        .action-card{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:1.1rem 1.25rem;text-decoration:none;display:flex;align-items:center;gap:12px;transition:border-color .15s,box-shadow .15s;}
        .action-card:hover{border-color:var(--teal);box-shadow:0 2px 12px rgba(46,157,145,.08);}
        .action-card-icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .action-card-icon svg{width:18px;height:18px;}
        .action-card-icon.teal{background:var(--teal-bg);color:var(--teal-dark);}
        .action-card-icon.amber{background:var(--amber-bg);color:var(--amber-dark);}
        .action-card-icon.red{background:var(--red-bg);color:var(--red-dark);}
        .action-card-label{font-size:0.84rem;font-weight:600;color:var(--dark);}
        .action-card-sub{font-size:0.72rem;color:var(--muted);margin-top:2px;}

        .table-card{background:var(--white);border:1px solid var(--border);border-radius:16px;overflow:hidden;}
        .table-card-header{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid var(--border);}
        .table-card-header h2{font-size:0.9rem;font-weight:600;color:var(--dark);}
        .table-card-header p{font-size:0.75rem;color:var(--muted);margin-top:2px;}
        .data-table{width:100%;border-collapse:collapse;}
        .data-table thead tr{background:var(--surface);border-bottom:1px solid var(--border);}
        .data-table th{padding:10px 16px;text-align:left;font-size:0.72rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;white-space:nowrap;}
        .data-table td{padding:12px 16px;font-size:0.84rem;color:var(--dark);border-bottom:1px solid var(--border);vertical-align:middle;}
        .data-table tbody tr:last-child td{border-bottom:none;}
        .data-table tbody tr:hover{background:#fafcfc;}
        .pt-cell{display:flex;align-items:center;gap:10px;}
        .pt-avatar{width:32px;height:32px;border-radius:50%;background:var(--teal-bg);color:var(--teal-deep);display:flex;align-items:center;justify-content:center;font-size:0.72rem;font-weight:700;flex-shrink:0;}
        .pt-name{font-size:0.84rem;font-weight:600;color:var(--dark);}
        .pt-sub{font-size:0.72rem;color:var(--muted);}
        .badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:20px;font-size:0.72rem;font-weight:600;}
        .badge-male{background:#e8f0fe;color:#3b5bdb;}
        .badge-female{background:#fce4ec;color:#c2185b;}
        .badge-other{background:#f3f0ff;color:#6741d9;}

   
        .badge-waiting{background:var(--amber-bg);color:var(--amber-dark);}
        .badge-serving{background:var(--teal-bg);color:var(--teal-dark);}
        .badge-done{background:var(--green-bg);color:#2a5a11;}
        .badge-emergency{background:var(--red-bg);color:var(--red-dark);}

       
        .flash-success{background:var(--green-bg);border:1px solid #c0dd97;border-radius:10px;padding:10px 16px;margin-bottom:1.25rem;font-size:0.82rem;color:#2a5a11;}
        .flash-error{background:var(--red-bg);border:1px solid #f7c1c1;border-radius:10px;padding:10px 16px;margin-bottom:1.25rem;font-size:0.82rem;color:var(--red-dark);}

        @media(max-width:960px){.sidebar{display:none;}.stat-grid{grid-template-columns:1fr 1fr;}.action-grid{grid-template-columns:1fr 1fr;}}
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
            <a href="{{ route('staff.dashboard') }}" class="nav-item active">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
                Dashboard
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-label">Patients</p>
            <a href="{{ route('staff.patients.create') }}" class="nav-item">
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
                <h1>Staff Dashboard</h1>
                <span>{{ now()->format('l, F j, Y') }}</span>
            </div>
        </header>

        <div class="content">

            @if(session('success'))
                <div class="flash-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash-error">{{ session('error') }}</div>
            @endif

            {{-- Stat cards --}}
            <div class="stat-grid">
                <div class="stat-card teal">
                    <div class="stat-header">
                        <span class="stat-label">Total Patients</span>
                        <div class="stat-icon teal">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                    </div>
                    <div class="stat-number">{{ $totalPatients }}</div>
                    <div class="stat-sub">All-time registered</div>
                </div>
                <div class="stat-card amber">
                    <div class="stat-header">
                        <span class="stat-label">Today's Patients</span>
                        <div class="stat-icon amber">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <div class="stat-number">{{ $patientsToday }}</div>
                    <div class="stat-sub">Registered today</div>
                </div>
                <div class="stat-card green">
                    <div class="stat-header">
                        <span class="stat-label">Served Today</span>
                        <div class="stat-icon green">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="stat-number">{{ $servedToday }}</div>
                    <div class="stat-sub">Consultations done</div>
                </div>
                <div class="stat-card red">
                    <div class="stat-header">
                        <span class="stat-label">In Queue</span>
                        <div class="stat-icon red">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="stat-number">{{ $waitingCount }}</div>
                    <div class="stat-sub">Currently waiting · {{ $emergencyCount }} emergency</div>
                </div>
            </div>

            {{-- Recent patients table --}}
            <div class="table-card">
                <div class="table-card-header">
                    <div>
                        <h2>Recent Patient Records</h2>
                        <p>Last 10 registered patients</p>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Contact</th>
                                <th>Condition</th>
                                <th>Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($recentPatients as $patient)
                        <tr>
                            <td>
                                <div class="pt-cell">
                                    <div class="pt-avatar">{{ strtoupper(substr($patient->first_name ?? 'U', 0, 1) . substr($patient->last_name ?? 'K', 0, 1)) }}</div>
                                    <div>
                                        <div class="pt-name">{{ $patient->first_name }} {{ $patient->last_name }}</div>
                                        <div class="pt-sub">{{ $patient->address ?? 'No address' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $patient->age ?? '—' }}</td>
                            <td>
                                <span class="badge badge-{{ strtolower($patient->gender ?? 'other') }}">
                                    {{ $patient->gender ?? 'Unknown' }}
                                </span>
                            </td>
                            <td>{{ $patient->contact ?? '—' }}</td>
                            <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $patient->condition }}">
                                {{ \Illuminate\Support\Str::limit($patient->condition ?? 'N/A', 35) }}
                            </td>
                            <td style="color:var(--muted);font-size:0.78rem;">{{ $patient->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" style="text-align:center;padding:2.5rem;color:var(--muted);font-size:0.85rem;">No patients registered yet.</td></tr>
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