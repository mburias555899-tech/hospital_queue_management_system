<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Reports</title>
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
        .user-row{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:9px;margin-bottom:8px;}
        .user-av{width:30px;height:30px;border-radius:50%;background:var(--teal);display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:700;color:#fff;flex-shrink:0;}
        .uname{font-size:0.8rem;font-weight:600;color:#fff;}
        .urole{font-size:0.68rem;color:rgba(255,255,255,0.38);text-transform:capitalize;}
        .logout-btn{display:flex;align-items:center;gap:9px;width:100%;padding:9px 12px;background:transparent;border:none;border-radius:9px;color:rgba(255,255,255,0.45);font-family:'DM Sans',sans-serif;font-size:0.84rem;font-weight:500;cursor:pointer;transition:background .15s,color .15s;text-align:left;}
        .logout-btn svg{width:15px;height:15px;flex-shrink:0;}
        .logout-btn:hover{background:rgba(226,75,74,0.15);color:#ff8a89;}

        .main{flex:1;display:flex;flex-direction:column;min-width:0;}
        .topbar{background:var(--white);border-bottom:1px solid var(--border);padding:0 2rem;height:58px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:10;flex-shrink:0;}
        .topbar-title{font-family:'DM Serif Display',serif;font-size:1.25rem;color:var(--dark);}
        .topbar-sub{font-size:0.75rem;color:var(--muted);}
        .topbar-right{display:flex;align-items:center;gap:8px;}
        .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:50px;font-family:'DM Sans',sans-serif;font-size:0.8rem;font-weight:600;cursor:pointer;border:1.5px solid transparent;text-decoration:none;transition:all .15s;}
        .btn svg{width:12px;height:12px;}
        .btn-ghost{background:transparent;color:var(--mid);border-color:var(--border);}
        .btn-ghost:hover{background:var(--surface);border-color:var(--teal);color:var(--teal);}
        .btn-teal{background:var(--teal);color:#fff;border-color:var(--teal);}
        .btn-teal:hover{background:var(--teal-dark);}
        .btn-sm{padding:6px 13px;font-size:0.75rem;}


        .content{padding:1.75rem 2rem;}

     
        .filter-bar{display:flex;align-items:center;gap:12px;margin-bottom:1.75rem;background:var(--white);border:1px solid var(--border);border-radius:12px;padding:0.85rem 1.25rem;}
        .filter-bar label{font-size:0.78rem;font-weight:600;color:var(--mid);white-space:nowrap;}
        .filter-bar input[type=date]{padding:6px 10px;border:1.5px solid var(--border);border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.83rem;color:var(--dark);outline:none;background:var(--surface);}
        .filter-bar input[type=date]:focus{border-color:var(--teal);background:var(--white);}
        .filter-spacer{flex:1;}
        .period-label{font-size:0.78rem;color:var(--muted);font-weight:500;}

        .report-section{background:var(--white);border:1px solid var(--border);border-radius:16px;margin-bottom:1.5rem;overflow:hidden;}
        .report-section-header{display:flex;align-items:center;justify-content:space-between;padding:1rem 1.4rem;border-bottom:1px solid var(--border);background:var(--surface);}
        .section-title{font-size:0.9rem;font-weight:700;color:var(--dark);display:flex;align-items:center;gap:8px;}
        .section-title svg{width:15px;height:15px;color:var(--teal);}
        .section-sub{font-size:0.72rem;color:var(--muted);margin-top:2px;}
        .report-section-body{padding:1.4rem;}

 
        .summary-row{display:grid;grid-template-columns:repeat(4,1fr);border:1px solid var(--border);border-radius:12px;overflow:hidden;}
        .summary-cell{padding:1.1rem 1.25rem;border-right:1px solid var(--border);}
        .summary-cell:last-child{border-right:none;}
        .sc-label{font-size:0.7rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px;}
        .sc-val{font-family:'DM Serif Display',serif;font-size:2rem;color:var(--dark);line-height:1;}
        .sc-sub{font-size:0.72rem;color:var(--muted);margin-top:4px;}
        .sc-bar{height:3px;border-radius:2px;margin-top:10px;}

        .priority-table{width:100%;border-collapse:collapse;}
        .priority-table td{padding:12px 0;border-bottom:1px solid var(--border);vertical-align:middle;}
        .priority-table tr:last-child td{border-bottom:none;}
        .p-label{display:flex;align-items:center;gap:8px;font-size:0.84rem;font-weight:600;}
        .p-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0;}
        .dot-critical{background:var(--red);}
        .dot-urgent{background:var(--amber);}
        .dot-normal{background:var(--teal);}
        .p-count{font-family:'DM Serif Display',serif;font-size:1.5rem;color:var(--dark);text-align:right;padding-right:1rem;white-space:nowrap;}
        .p-pct{font-size:0.75rem;color:var(--muted);text-align:right;white-space:nowrap;min-width:40px;}
        .prog-wrap{flex:1;height:8px;background:var(--border);border-radius:4px;overflow:hidden;min-width:80px;}
        .prog-fill{height:100%;border-radius:4px;}
        .fill-critical{background:var(--red);}
        .fill-urgent{background:var(--amber);}
        .fill-normal{background:var(--teal);}

  
        .wait-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:1.5rem;}
        .wait-cell{background:var(--surface);border:1px solid var(--border);border-radius:10px;padding:1rem 1.15rem;}
        .wc-label{font-size:0.7rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:5px;}
        .wc-val{font-family:'DM Serif Display',serif;font-size:1.6rem;color:var(--dark);line-height:1;}
        .wc-unit{font-size:0.75rem;color:var(--muted);margin-left:3px;}
        .wc-sub{font-size:0.72rem;color:var(--muted);margin-top:4px;}


        .perf-row{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--border);}
        .perf-row:last-child{border-bottom:none;}
        .perf-label{font-size:0.83rem;font-weight:500;color:var(--dark);}
        .perf-right{display:flex;align-items:center;gap:12px;}
        .perf-val{font-size:0.83rem;font-weight:700;color:var(--dark);min-width:55px;text-align:right;}
        .perf-bar-wrap{width:120px;height:7px;background:var(--border);border-radius:4px;overflow:hidden;}
        .perf-bar-fill{height:100%;border-radius:4px;}
        .pb-green{background:var(--green);}
        .pb-amber{background:var(--amber);}
        .pb-teal{background:var(--teal);}
        .pb-red{background:var(--red);}

        .data-table{width:100%;border-collapse:collapse;}
        .data-table thead tr{background:var(--surface);border-bottom:1px solid var(--border);}
        .data-table th{padding:9px 15px;text-align:left;font-size:0.7rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;white-space:nowrap;}
        .data-table td{padding:10px 15px;font-size:0.82rem;color:var(--dark);border-bottom:1px solid var(--border);vertical-align:middle;}
        .data-table tbody tr:last-child td{border-bottom:none;}
        .data-table tbody tr:hover{background:#fafcfc;}
        .pt-cell{display:flex;align-items:center;gap:9px;}
        .pt-av{width:28px;height:28px;border-radius:50%;background:var(--teal-bg);color:var(--teal-deep);display:flex;align-items:center;justify-content:center;font-size:0.65rem;font-weight:700;flex-shrink:0;}
        .pt-name{font-size:0.82rem;font-weight:600;}
        .pt-sub{font-size:0.7rem;color:var(--muted);}
        .badge{display:inline-block;padding:2px 9px;border-radius:20px;font-size:0.68rem;font-weight:600;}
        .badge-critical{background:var(--red-bg);color:var(--red-dark);}
        .badge-urgent{background:var(--amber-bg);color:var(--amber-dark);}
        .badge-normal{background:var(--teal-bg);color:var(--teal-deep);}
        .badge-waiting{background:#f1f0ea;color:#5a5745;}
        .badge-called{background:var(--amber-bg);color:var(--amber-dark);}
        .badge-serving{background:var(--teal-bg);color:var(--teal-deep);}
        .badge-done{background:var(--green-bg);color:#2a5a11;}
        .empty-cell{text-align:center;padding:2.5rem;color:var(--muted);font-size:0.85rem;}

        @media(max-width:900px){.sidebar{display:none;}.summary-row{grid-template-columns:1fr 1fr;}.wait-grid{grid-template-columns:1fr;}}
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
                <a href="{{ route('admin.patients.index') }}" class="nav-link">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Patient Records
                </a>
                <a href="{{ route('admin.reports.index') }}" class="nav-link active">
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
            <div>
                <div class="topbar-title">Hospital Operations Report</div>
                <div class="topbar-sub">Patient flow · Priority breakdown · Queue performance</div>
            </div>
            <div class="topbar-right">
                <a href="{{ route('admin.reports.export', ['date' => $date]) }}" class="btn btn-ghost btn-sm">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Export CSV
                </a>
                <a href="{{ route('admin.reports.user-stats') }}" target="_blank" class="btn btn-teal btn-sm">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-4a1 1 0 00-1-1H9a1 1 0 00-1 1v4a1 1 0 001 1zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    User Stats PDF
                </a>
            </div>
        </header>

        <div class="content">

            {{-- Date filter --}}
            <form method="GET" action="{{ route('admin.reports.index') }}">
                <div class="filter-bar">
                    <label for="date">Viewing report for:</label>
                    <input type="date" id="date" name="date" value="{{ $date }}" onchange="this.form.submit()">
                    <div class="filter-spacer"></div>
                    <span class="period-label">{{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}</span>
                </div>
            </form>

            @php
                $critPct       = $total > 0 ? round(($critical / $total) * 100) : 0;
                $urgPct        = $total > 0 ? round(($urgent   / $total) * 100) : 0;
                $normPct       = $total > 0 ? round(($normal   / $total) * 100) : 0;
                $completionRate= $total > 0 ? round(($done     / $total) * 100) : 0;
                $waitingRate   = $total > 0 ? round(($waiting  / $total) * 100) : 0;
                $servingRate   = $total > 0 ? round(($serving  / $total) * 100) : 0;

                // Avg wait: minutes from created_at to called_at for done entries that have called_at
                $doneWithCall = $queues->where('status','done')->filter(fn($q) => !empty($q->called_at));
                $avgWaitMins  = $doneWithCall->count() > 0
                    ? round($doneWithCall->avg(fn($q) => \Carbon\Carbon::parse($q->created_at)->diffInMinutes($q->called_at)))
                    : null;
            @endphp

            {{-- ① Patient Flow Summary --}}
            <div class="report-section">
                <div class="report-section-header">
                    <div>
                        <div class="section-title">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            Patient Flow Summary
                        </div>
                        <div class="section-sub">Overall patient registration and service performance</div>
                    </div>
                </div>
                <div class="report-section-body">
                    <div class="summary-row">
                        <div class="summary-cell">
                            <div class="sc-label">Total Registered</div>
                            <div class="sc-val">{{ $patientsToday }}</div>
                            <div class="sc-sub">New patients today</div>
                            <div class="sc-bar" style="background:var(--teal);width:100%;"></div>
                        </div>
                        <div class="summary-cell">
                            <div class="sc-label">Patients Served</div>
                            <div class="sc-val">{{ $done }}</div>
                            <div class="sc-sub">Consultations completed</div>
                            <div class="sc-bar" style="background:var(--green);width:{{ $completionRate }}%;"></div>
                        </div>
                        <div class="summary-cell">
                            <div class="sc-label">Still in Queue</div>
                            <div class="sc-val">{{ $waiting + $serving }}</div>
                            <div class="sc-sub">Waiting or being served</div>
                            <div class="sc-bar" style="background:var(--amber);width:{{ $total > 0 ? round((($waiting+$serving)/$total)*100) : 0 }}%;"></div>
                        </div>
                        <div class="summary-cell">
                            <div class="sc-label">Service Rate</div>
                            <div class="sc-val">{{ $completionRate }}%</div>
                            <div class="sc-sub">Of all queued patients</div>
                            <div class="sc-bar" style="background:var(--teal-deep);width:{{ $completionRate }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ② Priority Breakdown --}}
            <div class="report-section">
                <div class="report-section-header">
                    <div>
                        <div class="section-title">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Priority Level Breakdown
                        </div>
                        <div class="section-sub">Distribution of patients by triage priority</div>
                    </div>
                    <div style="font-size:0.78rem;color:var(--muted);">Total queue entries: <strong style="color:var(--dark);">{{ $total }}</strong></div>
                </div>
                <div class="report-section-body">
                    <table class="priority-table">
                        <tr>
                            <td style="width:160px;">
                                <div class="p-label"><span class="p-dot dot-critical"></span>Critical</div>
                                <div style="font-size:0.7rem;color:var(--muted);margin-top:2px;padding-left:18px;">Life-threatening cases</div>
                            </td>
                            <td class="p-count">{{ $critical }}</td>
                            <td style="padding:0 1rem;">
                                <div class="prog-wrap"><div class="prog-fill fill-critical" style="width:{{ $critPct }}%"></div></div>
                            </td>
                            <td class="p-pct">{{ $critPct }}%</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="p-label"><span class="p-dot dot-urgent"></span>Urgent</div>
                                <div style="font-size:0.7rem;color:var(--muted);margin-top:2px;padding-left:18px;">Senior / pregnant / priority</div>
                            </td>
                            <td class="p-count">{{ $urgent }}</td>
                            <td style="padding:0 1rem;">
                                <div class="prog-wrap"><div class="prog-fill fill-urgent" style="width:{{ $urgPct }}%"></div></div>
                            </td>
                            <td class="p-pct">{{ $urgPct }}%</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="p-label"><span class="p-dot dot-normal"></span>Normal</div>
                                <div style="font-size:0.7rem;color:var(--muted);margin-top:2px;padding-left:18px;">Stable, regular queue</div>
                            </td>
                            <td class="p-count">{{ $normal }}</td>
                            <td style="padding:0 1rem;">
                                <div class="prog-wrap"><div class="prog-fill fill-normal" style="width:{{ $normPct }}%"></div></div>
                            </td>
                            <td class="p-pct">{{ $normPct }}%</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- ③ Waiting Time & Queue Performance --}}
            <div class="report-section">
                <div class="report-section-header">
                    <div>
                        <div class="section-title">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Waiting Time &amp; Queue Performance
                        </div>
                        <div class="section-sub">Average waiting time and daily operational efficiency</div>
                    </div>
                </div>
                <div class="report-section-body">
                    <div class="wait-grid">
                        <div class="wait-cell">
                            <div class="wc-label">Avg. Wait to Be Called</div>
                            <div class="wc-val">
                                @if($avgWaitMins !== null)
                                    {{ $avgWaitMins }}<span class="wc-unit">min</span>
                                @else
                                    <span style="font-size:1rem;color:var(--muted);">No data</span>
                                @endif
                            </div>
                            <div class="wc-sub">Based on completed consultations</div>
                        </div>
                        <div class="wait-cell">
                            <div class="wc-label">Queue Completion Rate</div>
                            <div class="wc-val">{{ $completionRate }}<span class="wc-unit">%</span></div>
                            <div class="wc-sub">Patients fully served today</div>
                        </div>
                        <div class="wait-cell">
                            <div class="wc-label">Critical Patient Rate</div>
                            <div class="wc-val">{{ $critPct }}<span class="wc-unit">%</span></div>
                            <div class="wc-sub">Of total queue entries</div>
                        </div>
                    </div>

                    <div class="perf-row">
                        <span class="perf-label">Consultations Done</span>
                        <div class="perf-right">
                            <div class="perf-bar-wrap"><div class="perf-bar-fill pb-green" style="width:{{ $completionRate }}%"></div></div>
                            <span class="perf-val">{{ $done }} / {{ $total }}</span>
                        </div>
                    </div>
                    <div class="perf-row">
                        <span class="perf-label">Currently Waiting</span>
                        <div class="perf-right">
                            <div class="perf-bar-wrap"><div class="perf-bar-fill pb-amber" style="width:{{ $waitingRate }}%"></div></div>
                            <span class="perf-val">{{ $waiting }} / {{ $total }}</span>
                        </div>
                    </div>
                    <div class="perf-row">
                        <span class="perf-label">In Consultation Now</span>
                        <div class="perf-right">
                            <div class="perf-bar-wrap"><div class="perf-bar-fill pb-teal" style="width:{{ $servingRate }}%"></div></div>
                            <span class="perf-val">{{ $serving }} / {{ $total }}</span>
                        </div>
                    </div>
                    <div class="perf-row">
                        <span class="perf-label">Critical Cases</span>
                        <div class="perf-right">
                            <div class="perf-bar-wrap"><div class="perf-bar-fill pb-red" style="width:{{ $critPct }}%"></div></div>
                            <span class="perf-val">{{ $critical }} / {{ $total }}</span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="report-section" style="border:1.5px solid #e2e8e6;">
                <div class="report-section-header" style="background:var(--surface);">
                    <div>
                        <div class="section-title">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 17v-2a4 4 0 014-4h0a4 4 0 014 4v2M9 7a3 3 0 116 0 3 3 0 01-6 0z"/>
                            </svg>
                            User Statistics Report
                        </div>
                        <div class="section-sub">
                            System-level user distribution by role · Administrative use only
                        </div>
                    </div>
                   
                </div>

                <div class="report-section-body">

                    {{-- Summary strip --}}
                    <div class="summary-row" style="margin-bottom:1.25rem;">
                        <div class="summary-cell">
                            <div class="sc-label">Total Users</div>
                            <div class="sc-val">{{ $totalUsers }}</div>
                            <div class="sc-sub">All registered accounts</div>
                            <div class="sc-bar" style="background:var(--teal);width:100%;"></div>
                        </div>
                        <div class="summary-cell">
                            <div class="sc-label">Doctors</div>
                            <div class="sc-val">{{ $totalDoctors }}</div>
                            <div class="sc-sub">{{ $totalUsers > 0 ? round($totalDoctors / $totalUsers * 100) : 0 }}% of users</div>
                            <div class="sc-bar" style="background:#3b5bdb;width:{{ $totalUsers > 0 ? round($totalDoctors / $totalUsers * 100) : 0 }}%;"></div>
                        </div>
                        <div class="summary-cell">
                            <div class="sc-label">Nurses</div>
                            <div class="sc-val">{{ $totalNurses }}</div>
                            <div class="sc-sub">{{ $totalUsers > 0 ? round($totalNurses / $totalUsers * 100) : 0 }}% of users</div>
                            <div class="sc-bar" style="background:var(--teal);width:{{ $totalUsers > 0 ? round($totalNurses / $totalUsers * 100) : 0 }}%;"></div>
                        </div>
                        <div class="summary-cell">
                            <div class="sc-label">Receptionists</div>
                            <div class="sc-val">{{ $totalReceptionists }}</div>
                            <div class="sc-sub">{{ $totalUsers > 0 ? round($totalReceptionists / $totalUsers * 100) : 0 }}% of users</div>
                            <div class="sc-bar" style="background:var(--amber);width:{{ $totalUsers > 0 ? round($totalReceptionists / $totalUsers * 100) : 0 }}%;"></div>
                        </div>
                    </div>

                    {{-- Role breakdown rows --}}
                    @php
                        $roleRows = [
                            ['label' => 'Administrator', 'count' => $totalAdmins,        'color' => '#6741d9', 'bg' => '#f3f0ff', 'access' => 'Full system access'],
                            ['label' => 'Doctor',        'count' => $totalDoctors,       'color' => '#3b5bdb', 'bg' => '#e8f0fe', 'access' => 'Patient & queue views'],
                            ['label' => 'Nurse',         'count' => $totalNurses,        'color' => '#2e9d91', 'bg' => '#e8f5f3', 'access' => 'Registration & queue management'],
                            ['label' => 'Receptionist',  'count' => $totalReceptionists, 'color' => '#ef9f27', 'bg' => '#faeeda', 'access' => 'Registration & queue management'],
                        ];
                    @endphp

                    @foreach($roleRows as $row)
                    @php $pct = $totalUsers > 0 ? round($row['count'] / $totalUsers * 100) : 0; @endphp
                    <div class="perf-row">
                        <div style="display:flex;align-items:center;gap:10px;min-width:180px;">
                            <span style="display:inline-block;padding:2px 10px;border-radius:20px;font-size:0.7rem;font-weight:700;background:{{ $row['bg'] }};color:{{ $row['color'] }};">
                                {{ $row['label'] }}
                            </span>
                            <span style="font-size:0.75rem;color:var(--muted);">{{ $row['access'] }}</span>
                        </div>
                        <div class="perf-right">
                            <div class="perf-bar-wrap">
                                <div class="perf-bar-fill" style="width:{{ $pct }}%;background:{{ $row['color'] }};"></div>
                            </div>
                            <span class="perf-val">{{ $row['count'] }} <span style="font-weight:400;color:var(--muted);font-size:0.75rem;">({{ $pct }}%)</span></span>
                        </div>
                    </div>
                    @endforeach

                    {{-- Admin-only notice --}}
                    <div style="margin-top:1.25rem;background:var(--red-bg);border:1px solid #f7c1c1;border-radius:9px;padding:10px 14px;display:flex;align-items:flex-start;gap:8px;">
                        <svg style="width:14px;height:14px;color:var(--red);flex-shrink:0;margin-top:1px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                        <span style="font-size:0.76rem;color:var(--red-dark);">
                            <strong>Confidential.</strong>
                            This report contains sensitive staff information and is intended for authorised administrators only.
                            Click <strong>Download PDF</strong> to generate a formatted report for record-keeping.
                        </span>
                    </div>

                </div>
            </div>

            {{-- ④ Full Queue Detail --}}
            <div class="report-section">
                <div class="report-section-header">
                    <div>
                        <div class="section-title">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h10M4 18h6"/></svg>
                            Full Queue Detail
                        </div>
                        <div class="section-sub">All queue entries for {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</div>
                    </div>
                    <span style="font-size:0.78rem;color:var(--muted);">{{ $total }} entr{{ $total === 1 ? 'y' : 'ies' }}</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Doctor</th>
                                <th>Condition</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($queues as $queue)
                        @php $patient = $queue->patient; @endphp
                        <tr>
                            <td><strong style="font-family:'DM Serif Display',serif;font-size:1rem;">{{ $queue->queue_number }}</strong></td>
                            <td>
                                <div class="pt-cell">
                                    <div class="pt-av">{{ strtoupper(substr($patient->first_name ?? 'U', 0, 1) . substr($patient->last_name ?? 'K', 0, 1)) }}</div>
                                    <div>
                                        <div class="pt-name">{{ ($patient->first_name ?? 'Unknown') . ' ' . ($patient->last_name ?? '') }}</div>
                                        <div class="pt-sub">{{ $patient->age ?? '—' }} yrs · {{ $patient->gender ?? '—' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge badge-{{ $queue->priority }}">{{ ucfirst($queue->priority) }}</span></td>
                            <td><span class="badge badge-{{ $queue->status }}">{{ ucfirst($queue->status) }}</span></td>
                            <td style="font-size:0.8rem;color:var(--mid);">{{ $queue->doctor->name ?? '—' }}</td>
                            <td style="max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:var(--mid);" title="{{ $patient->condition ?? '' }}">
                                {{ \Illuminate\Support\Str::limit($patient->condition ?? 'N/A', 30) }}
                            </td>
                            <td style="font-size:0.75rem;color:var(--muted);white-space:nowrap;">{{ $queue->created_at->format('h:i A') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="empty-cell">No queue entries for this date.</td></tr>
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