<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Doctor</title>
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
        .topbar{background:var(--white);border-bottom:1px solid var(--border);padding:0 2rem;height:58px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:10;flex-shrink:0;}
        .topbar-title{font-family:'DM Serif Display',serif;font-size:1.25rem;color:var(--dark);}
        .topbar-date{font-size:0.75rem;color:var(--muted);}
        .content{padding:1.75rem 2rem;}

      
        .flash{padding:10px 16px;border-radius:10px;margin-bottom:1.25rem;font-size:0.82rem;}
        .flash-success{background:var(--green-bg);border:1px solid #c0dd97;color:#2a5a11;}

     
        .stat-strip{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:1.75rem;}
        .stat-tile{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:1.1rem 1.2rem;display:flex;align-items:center;gap:14px;}
        .tile-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .tile-icon svg{width:16px;height:16px;}
        .tile-val{font-family:'DM Serif Display',serif;font-size:1.9rem;color:var(--dark);line-height:1;}
        .tile-lbl{font-size:0.7rem;color:var(--muted);margin-top:3px;}

   
        .section-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;}
        .section-head h2{font-size:0.95rem;font-weight:600;color:var(--dark);}
        .section-head p{font-size:0.75rem;color:var(--muted);margin-top:2px;}

       
        .table-card{background:var(--white);border:1px solid var(--border);border-radius:16px;overflow:hidden;}
        .data-table{width:100%;border-collapse:collapse;}
        .data-table thead tr{background:var(--surface);border-bottom:1px solid var(--border);}
        .data-table th{padding:9px 15px;text-align:left;font-size:0.7rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;white-space:nowrap;}
        .data-table td{padding:11px 15px;font-size:0.83rem;color:var(--dark);border-bottom:1px solid var(--border);vertical-align:middle;}
        .data-table tbody tr:last-child td{border-bottom:none;}
        .data-table tbody tr:hover{background:#fafcfc;}
        .data-table tbody tr.row-critical td:first-child{border-left:3px solid var(--red);}
        .data-table tbody tr.row-urgent td:first-child{border-left:3px solid var(--amber);}
        .data-table tbody tr.row-normal td:first-child{border-left:3px solid var(--teal);}

        .pt-cell{display:flex;align-items:center;gap:9px;}
        .pt-av{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.68rem;font-weight:700;flex-shrink:0;}
        .pt-av.red{background:var(--red-bg);color:var(--red-dark);}
        .pt-av.amber{background:var(--amber-bg);color:var(--amber-dark);}
        .pt-av.teal{background:var(--teal-bg);color:var(--teal-deep);}
        .pt-name{font-size:0.83rem;font-weight:600;color:var(--dark);}
        .pt-sub{font-size:0.7rem;color:var(--muted);}

        
        .badge{display:inline-block;padding:2px 9px;border-radius:20px;font-size:0.68rem;font-weight:600;}
        .b-critical{background:var(--red-bg);color:var(--red-dark);}
        .b-urgent{background:var(--amber-bg);color:var(--amber-dark);}
        .b-normal{background:var(--teal-bg);color:var(--teal-deep);}
        .b-waiting{background:#f1f0ea;color:#5a5745;}
        .b-called{background:var(--amber-bg);color:var(--amber-dark);}
        .b-serving{background:var(--teal-bg);color:var(--teal-deep);}
        .b-done{background:var(--green-bg);color:#2a5a11;}

        
        .btn{display:inline-flex;align-items:center;gap:6px;padding:6px 13px;border-radius:50px;font-family:'DM Sans',sans-serif;font-size:0.75rem;font-weight:600;cursor:pointer;border:1.5px solid transparent;text-decoration:none;transition:all .15s;}
        .btn svg{width:11px;height:11px;}
        .btn-ghost{background:transparent;color:var(--mid);border-color:var(--border);}
        .btn-ghost:hover{background:var(--surface);border-color:var(--teal);color:var(--teal);}
        .btn-green{background:var(--green-bg);color:#2a5a11;border-color:#c0dd97;}
        .btn-green:hover{background:#d5edbe;border-color:#a8cc7a;}
        .btn-teal{background:var(--teal);color:#fff;border-color:var(--teal);}
        .btn-teal:hover{background:var(--teal-dark);border-color:var(--teal-dark);}

      
        .action-group{display:flex;gap:6px;justify-content:flex-end;align-items:center;}

   
        .empty-cell{text-align:center;padding:3rem;color:var(--muted);font-size:0.85rem;}

       
        .done-row{opacity:0.5;}

        @media(max-width:900px){.sidebar{display:none;}.stat-strip{grid-template-columns:1fr 1fr;}}
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
            <a href="{{ route('doctor.dashboard') }}" class="nav-link active">
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
            <div>
                <div class="topbar-title">My Queue</div>
                <div class="topbar-date" id="live-clock">{{ now()->format('l, F j, Y') }}</div>
            </div>
        </header>

        <div class="content">

            @if(session('success'))
                <div class="flash flash-success">{{ session('success') }}</div>
            @endif

            {{-- Stats --}}
            <div class="stat-strip">
                <div class="stat-tile" style="border-left:3px solid var(--teal);">
                    <div class="tile-icon" style="background:var(--teal-bg);color:var(--teal-deep);">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="tile-val">{{ $assignedQueues->whereIn('status', ['waiting','called','serving'])->count() }}</div>
                        <div class="tile-lbl">Waiting / Active</div>
                    </div>
                </div>
                <div class="stat-tile" style="border-left:3px solid var(--amber);">
                    <div class="tile-icon" style="background:var(--amber-bg);color:var(--amber-dark);">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </div>
                    <div>
                        <div class="tile-val">{{ $assignedQueues->where('status','serving')->count() }}</div>
                        <div class="tile-lbl">In Consultation</div>
                    </div>
                </div>
                <div class="stat-tile" style="border-left:3px solid var(--green);">
                    <div class="tile-icon" style="background:var(--green-bg);color:#2a5a11;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="tile-val">{{ $servedToday }}</div>
                        <div class="tile-lbl">Served Today</div>
                    </div>
                </div>
            </div>

            {{-- Queue table --}}
            <div class="section-head">
                <div>
                    <h2>My Assigned Patients</h2>
                    <p>Patients assigned to you — ordered by priority</p>
                </div>
            </div>

            <div class="table-card">
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Queue #</th>
                                <th>Patient</th>
                                <th>Priority</th>
                                <th>Chief Complaint</th>
                                <th>Status</th>
                                <th>Waiting</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($assignedQueues as $queue)
                        @php
                            $pt       = $queue->patient;
                            $initials = strtoupper(substr($pt->first_name ?? 'U', 0, 1) . substr($pt->last_name ?? 'K', 0, 1));
                            $avColor  = $queue->priority === 'critical' ? 'red' : ($queue->priority === 'urgent' ? 'amber' : 'teal');
                            $rowClass = 'row-' . $queue->priority;
                            $isDone   = $queue->status === 'done';
                            $waitMins = $queue->created_at ? now()->diffInMinutes($queue->created_at) : 0;
                        @endphp
                        <tr class="{{ $rowClass }} {{ $isDone ? 'done-row' : '' }}">
                            <td style="font-family:'DM Serif Display',serif;font-size:1rem;">{{ $queue->queue_number }}</td>
                            <td>
                                <div class="pt-cell">
                                    <div class="pt-av {{ $avColor }}">{{ $initials }}</div>
                                    <div>
                                        <div class="pt-name">{{ ($pt->first_name ?? 'Unknown') . ' ' . ($pt->last_name ?? 'Walk-in') }}</div>
                                        <div class="pt-sub">{{ $pt->age ?? '—' }} yrs · {{ $pt->gender ?? '—' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge b-{{ $queue->priority }}">{{ ucfirst($queue->priority) }}</span></td>
                            <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $pt->condition ?? '' }}">
                                {{ \Illuminate\Support\Str::limit($pt->condition ?? 'N/A', 40) }}
                            </td>
                            <td><span class="badge b-{{ $queue->status }}">{{ ucfirst($queue->status) }}</span></td>
                            <td style="color:var(--muted);font-size:0.78rem;">
                                {{ $isDone ? '—' : $waitMins . 'm' }}
                            </td>
                            <td>
                                <div class="action-group">
                                    {{-- View patient details --}}
                                    <a href="{{ route('doctor.patient', $queue->id) }}" class="btn btn-ghost">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        View
                                    </a>

                                    {{-- Mark as done --}}
                                    @if(!$isDone)
                                    <form method="POST" action="{{ route('doctor.done', $queue->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-green"
                                            onclick="return confirm('Mark {{ ($pt->first_name ?? 'Patient') }} as done?')">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            Done
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="empty-cell">No patients assigned to you yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function tick() {
        const el = document.getElementById('live-clock');
        if (el) el.textContent = new Date().toLocaleString('en-PH', {
            weekday:'long', year:'numeric', month:'long', day:'numeric',
            hour:'2-digit', minute:'2-digit', second:'2-digit'
        });
    }
    tick(); setInterval(tick, 1000);
</script>
</body>
</html>