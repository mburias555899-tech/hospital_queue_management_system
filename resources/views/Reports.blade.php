<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Reports</title>
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
        .btn-teal{background:var(--teal);color:#fff;border-color:var(--teal);}
        .btn-teal:hover{background:var(--teal-dark);border-color:var(--teal-dark);}
        .btn-sm{padding:6px 14px;font-size:0.78rem;}

   
        .content{padding:1.75rem 2rem;flex:1;}

      
        .stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:1.75rem;}
        .stat-card{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:1.1rem 1.25rem;}
        .stat-card.teal{border-left:4px solid var(--teal);}
        .stat-card.amber{border-left:4px solid var(--amber);}
        .stat-card.red{border-left:4px solid var(--red);}
        .stat-card.green{border-left:4px solid var(--green);}
        .stat-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;}
        .stat-label{font-size:0.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;}
        .stat-icon{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;}
        .stat-icon svg{width:14px;height:14px;}
        .stat-icon.teal{background:var(--teal-bg);color:var(--teal-dark);}
        .stat-icon.amber{background:var(--amber-bg);color:var(--amber-dark);}
        .stat-icon.red{background:var(--red-bg);color:var(--red-dark);}
        .stat-icon.green{background:var(--green-bg);color:#2a5a11;}
        .stat-number{font-family:'DM Serif Display',serif;font-size:2rem;color:var(--dark);line-height:1;}
        .stat-sub{font-size:0.72rem;color:var(--muted);margin-top:4px;}

     
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

     
        .badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:20px;font-size:0.72rem;font-weight:600;text-transform:capitalize;}
        .badge-critical{background:var(--red-bg);color:var(--red-dark);}
        .badge-urgent{background:var(--amber-bg);color:var(--amber-dark);}
        .badge-normal{background:var(--teal-bg);color:var(--teal-deep);}
        .badge-done{background:var(--green-bg);color:var(--green);}
        .badge-waiting{background:var(--amber-bg);color:var(--amber-dark);}
        .badge-serving{background:var(--teal-bg);color:var(--teal-deep);}

        .filter-bar{display:flex;align-items:center;gap:10px;}
        .filter-bar input[type="date"]{padding:6px 12px;border:1.5px solid var(--border);border-radius:9px;font-family:'DM Sans',sans-serif;font-size:0.82rem;color:var(--dark);background:var(--white);outline:none;}
        .filter-bar input[type="date"]:focus{border-color:var(--teal);}

      
        .empty-state{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:3rem 1rem;color:var(--muted);gap:8px;}
        .empty-state svg{width:36px;height:36px;opacity:0.3;}
        .empty-state p{font-size:0.85rem;}

        @media(max-width:960px){.sidebar{display:none;}.stat-grid{grid-template-columns:1fr 1fr;}}
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
            <a href="{{ route('admin.reports.index') }}" class="nav-item active">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Reports
            </a>
        </div>

        <div class="nav-section">
            <p class="nav-label">Administration</p>
            <a href="{{ route('admin.users.index') }}" class="nav-item">
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
                <h1>Reports</h1>
                <span>{{ now()->format('l, F j, Y') }}</span>
            </div>
            <div class="topbar-right">
                <div class="filter-bar">
                    <form method="GET" action="{{ route('admin.reports.index') }}">
                        <input type="date" name="date" value="{{ isset($date) ? \Carbon\Carbon::parse($date)->format('Y-m-d') : today()->format('Y-m-d') }}"
                               onchange="this.form.submit()">
                    </form>
                </div>
                <a href="{{ route('admin.reports.export') }}?date={{ isset($date) ? \Carbon\Carbon::parse($date)->format('Y-m-d') : today()->format('Y-m-d') }}"
                   class="btn btn-primary btn-sm">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Export
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <div class="content">

            {{-- Stat cards --}}
            <div class="stat-grid">
                <div class="stat-card teal">
                    <div class="stat-header">
                        <span class="stat-label">Total Patients</span>
                        <div class="stat-icon teal">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                    </div>
                    <div class="stat-number">{{ $total }}</div>
                    <div class="stat-sub">For selected date</div>
                </div>
                <div class="stat-card red">
                    <div class="stat-header">
                        <span class="stat-label">Critical</span>
                        <div class="stat-icon red">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                        </div>
                    </div>
                    <div class="stat-number">{{ $critical }}</div>
                    <div class="stat-sub">Critical priority</div>
                </div>
                <div class="stat-card amber">
                    <div class="stat-header">
                        <span class="stat-label">Urgent</span>
                        <div class="stat-icon amber">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                    </div>
                    <div class="stat-number">{{ $urgent }}</div>
                    <div class="stat-sub">Urgent priority</div>
                </div>
                <div class="stat-card green">
                    <div class="stat-header">
                        <span class="stat-label">Served</span>
                        <div class="stat-icon green">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <div class="stat-number">{{ $done }}</div>
                    <div class="stat-sub">Consultations done</div>
                </div>
            </div>

            {{-- Queue table --}}
            <div class="table-card">
                <div class="table-card-header">
                    <div>
                        <h2>Patient Queue Report</h2>
                        <p>{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</p>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    @if(isset($queues) && $queues->count())
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($queues as $index => $queue)
                            <tr>
                                <td style="color:var(--muted);">{{ $index + 1 }}</td>
                                <td style="font-weight:600;">{{ $queue->patient->name ?? 'N/A' }}</td>
                                <td><span class="badge badge-{{ $queue->priority }}">{{ ucfirst($queue->priority) }}</span></td>
                                <td><span class="badge badge-{{ $queue->status }}">{{ ucfirst($queue->status) }}</span></td>
                                <td style="color:var(--muted);font-size:0.78rem;">{{ $queue->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="empty-state">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        <p>No report data available for this date.</p>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>