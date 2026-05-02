
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{
            --teal:#2e9d91;--teal-dark:#1f7a70;--teal-deep:#155c55;--teal-bg:#e8f5f3;
            --red:#e24b4a;--red-bg:#fcebeb;--red-dark:#a32d2d;
            --amber:#ef9f27;--amber-bg:#faeeda;
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
        .topbar-title{font-family:'DM Serif Display',serif;font-size:1.25rem;color:var(--dark);letter-spacing:-0.3px;}
        .topbar-date{font-size:0.75rem;color:var(--muted);}
        .topbar-right{display:flex;align-items:center;gap:8px;}

      
        .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:50px;font-family:'DM Sans',sans-serif;font-size:0.8rem;font-weight:600;cursor:pointer;border:1.5px solid transparent;text-decoration:none;transition:all .15s;}
        .btn svg{width:12px;height:12px;}
        .btn-primary{background:var(--dark);color:#fff;border-color:var(--dark);}
        .btn-primary:hover{background:var(--teal-deep);border-color:var(--teal-deep);}
        .btn-ghost{background:transparent;color:var(--mid);border-color:var(--border);}
        .btn-ghost:hover{background:var(--surface);border-color:var(--teal);color:var(--teal);}
        .btn-teal{background:var(--teal);color:#fff;border-color:var(--teal);}
        .btn-teal:hover{background:var(--teal-dark);border-color:var(--teal-dark);}
        .btn-sm{padding:6px 13px;font-size:0.75rem;}

   
        .content{padding:1.75rem 2rem;}
        .flash{padding:10px 16px;border-radius:10px;margin-bottom:1.25rem;font-size:0.82rem;}
        .flash-success{background:var(--green-bg);border:1px solid #c0dd97;color:#2a5a11;}
        .flash-error{background:var(--red-bg);border:1px solid #f7c1c1;color:var(--red-dark);}

        
        .stat-strip{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:1.75rem;}
        .stat-tile{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:1.1rem 1.2rem;display:flex;align-items:center;gap:14px;}
        .stat-tile.t-teal{border-left:3px solid var(--teal);}
        .stat-tile.t-amber{border-left:3px solid var(--amber);}
        .stat-tile.t-green{border-left:3px solid var(--green);}
        .stat-tile.t-dark{border-left:3px solid #888;}
        .tile-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .tile-icon svg{width:16px;height:16px;}
        .tile-icon.teal{background:var(--teal-bg);color:var(--teal-dark);}
        .tile-icon.amber{background:var(--amber-bg);color:#b36a10;}
        .tile-icon.green{background:var(--green-bg);color:#2a5a11;}
        .tile-icon.gray{background:#f1f0ea;color:#5a5745;}
        .tile-val{font-family:'DM Serif Display',serif;font-size:1.9rem;color:var(--dark);line-height:1;}
        .tile-lbl{font-size:0.7rem;color:var(--muted);margin-top:3px;}

      
        .qa-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:1.75rem;}
        .qa-card{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:1.25rem;text-decoration:none;display:flex;align-items:center;gap:12px;transition:box-shadow .15s,border-color .15s;}
        .qa-card:hover{box-shadow:0 4px 16px rgba(0,0,0,0.08);border-color:var(--teal);}
        .qa-icon{width:40px;height:40px;border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .qa-icon svg{width:18px;height:18px;}
        .qa-title{font-size:0.88rem;font-weight:600;color:var(--dark);}
        .qa-sub{font-size:0.72rem;color:var(--muted);margin-top:2px;}

    
        .section-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;}
        .section-head h2{font-size:0.95rem;font-weight:600;color:var(--dark);}
        .section-head p{font-size:0.75rem;color:var(--muted);margin-top:2px;}

        .table-card{background:var(--white);border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:1.5rem;}
        .table-toolbar{display:flex;align-items:center;justify-content:space-between;padding:12px 16px;border-bottom:1px solid var(--border);gap:10px;}
        .search-wrap{position:relative;max-width:260px;flex:1;}
        .search-wrap svg{position:absolute;left:10px;top:50%;transform:translateY(-50%);width:13px;height:13px;color:var(--muted);}
        .search-wrap input{width:100%;padding:7px 10px 7px 30px;border:1.5px solid var(--border);border-radius:8px;font-family:'DM Sans',sans-serif;font-size:0.83rem;color:var(--dark);background:var(--surface);outline:none;transition:border-color .2s;}
        .search-wrap input:focus{border-color:var(--teal);background:var(--white);}
        .data-table{width:100%;border-collapse:collapse;}
        .data-table thead tr{background:var(--surface);border-bottom:1px solid var(--border);}
        .data-table th{padding:9px 15px;text-align:left;font-size:0.7rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;white-space:nowrap;}
        .data-table td{padding:11px 15px;font-size:0.83rem;color:var(--dark);border-bottom:1px solid var(--border);vertical-align:middle;}
        .data-table tbody tr:last-child td{border-bottom:none;}
        .data-table tbody tr:hover{background:#fafcfc;}
        .pt-cell{display:flex;align-items:center;gap:9px;}
        .pt-av{width:30px;height:30px;border-radius:50%;background:var(--teal-bg);color:var(--teal-deep);display:flex;align-items:center;justify-content:center;font-size:0.68rem;font-weight:700;flex-shrink:0;}
        .pt-name{font-size:0.83rem;font-weight:600;color:var(--dark);}
        .pt-sub{font-size:0.7rem;color:var(--muted);}
        .badge{display:inline-block;padding:2px 9px;border-radius:20px;font-size:0.68rem;font-weight:600;}
        .b-male{background:#e8f0fe;color:#3b5bdb;}
        .b-female{background:#fce4ec;color:#c2185b;}
        .b-other,.b-unknown{background:#f1f0ea;color:#5a5745;}
        .role-badge{display:inline-block;padding:2px 9px;border-radius:20px;font-size:0.68rem;font-weight:600;text-transform:capitalize;}
        .r-admin{background:#f3f0ff;color:#6741d9;}
        .r-nurse{background:var(--teal-bg);color:var(--teal-deep);}
        .r-receptionist{background:var(--amber-bg);color:#b36a10;}
        .r-doctor{background:#e8f0fe;color:#3b5bdb;}
        .pag-bar{display:flex;align-items:center;justify-content:space-between;padding:10px 15px;border-top:1px solid var(--border);}
        .pag-info{font-size:0.75rem;color:var(--muted);}
        .empty-cell{text-align:center;padding:2.5rem;color:var(--muted);font-size:0.85rem;}

        @media(max-width:900px){.sidebar{display:none;}.stat-strip,.qa-grid{grid-template-columns:1fr 1fr;}}
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
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
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
            <div>
                <div class="topbar-title">Admin Dashboard</div>
                <div class="topbar-date">{{ now()->format('l, F j, Y') }}</div>
            </div>
           
        </header>

        <div class="content">

            @if(session('success'))<div class="flash flash-success">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="flash flash-error">{{ session('error') }}</div>@endif

            {{-- Stat strip --}}
            <div class="stat-strip">
                <div class="stat-tile t-teal">
                    <div class="tile-icon teal"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
                    <div><div class="tile-val">{{ $totalPatients }}</div><div class="tile-lbl">Total Patients</div></div>
                </div>
                <div class="stat-tile t-amber">
                    <div class="tile-icon amber"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
                    <div><div class="tile-val">{{ $patientsToday }}</div><div class="tile-lbl">Registered Today</div></div>
                </div>
                <div class="stat-tile t-green">
                    <div class="tile-icon green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                    <div><div class="tile-val">{{ $servedToday }}</div><div class="tile-lbl">Served Today</div></div>
                </div>
                <div class="stat-tile t-dark">
                    <div class="tile-icon gray"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 014-4h0a4 4 0 014 4v2M9 7a3 3 0 116 0 3 3 0 01-6 0z"/></svg></div>
                    <div><div class="tile-val">{{ $totalUsers }}</div><div class="tile-lbl">System Users</div></div>
                </div>
            </div>

            

            {{-- Recent patients --}}
            <div class="section-head">
                <div><h2>Recent Patients</h2><p>Last 10 registered</p></div>
                <a href="{{ route('admin.patients.index') }}" class="btn btn-ghost btn-sm">View all</a>
            </div>
            <div class="table-card">
                <div class="table-toolbar">
                    <div class="search-wrap">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" id="ptSearch" placeholder="Search by name...">
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table class="data-table" id="ptTable">
                        <thead>
                            <tr>
                                <th>Patient</th><th>Age</th><th>Gender</th><th>Contact</th><th>Condition</th><th>Registered</th><th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($recentPatients as $patient)
                        <tr data-name="{{ strtolower($patient->first_name . ' ' . $patient->last_name) }}">
                            <td>
                                <div class="pt-cell">
                                    <div class="pt-av">{{ strtoupper(substr($patient->first_name ?? 'U', 0, 1) . substr($patient->last_name ?? 'K', 0, 1)) }}</div>
                                    <div>
                                        <div class="pt-name">{{ $patient->first_name }} {{ $patient->last_name }}</div>
                                        <div class="pt-sub">{{ $patient->address ?? 'No address on file' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $patient->age ?? '—' }}</td>
                            <td><span class="badge b-{{ strtolower($patient->gender ?? 'unknown') }}">{{ $patient->gender ?? 'Unknown' }}</span></td>
                            <td>{{ $patient->contact ?? '—' }}</td>
                            <td style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $patient->condition }}">{{ \Illuminate\Support\Str::limit($patient->condition ?? 'N/A', 35) }}</td>
                            <td style="color:var(--muted);font-size:0.75rem;white-space:nowrap;">{{ $patient->created_at->format('M d, Y') }}</td>
                            <td style="text-align:right;"><a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-ghost btn-sm">View</a></td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="empty-cell">No patients registered yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- System users --}}
            <div class="section-head" style="margin-top:0.25rem;">
                <div><h2>System Users</h2><p>All staff accounts</p></div>
               
            </div>
            <div class="table-card">
                <div style="overflow-x:auto;">
                    <table class="data-table">
                        <thead>
                            <tr><th>Name</th><th>Email</th><th>Role</th><th>Joined</th><th style="text-align:right;">Actions</th></tr>
                        </thead>
                        <tbody>
                        @forelse ($recentUsers ?? [] as $user)
                        <tr>
                            <td>
                                <div class="pt-cell">
                                    <div class="pt-av" style="background:#f3f0ff;color:#6741d9;">{{ strtoupper(substr($user->name ?? 'U', 0, 2)) }}</div>
                                    <div class="pt-name">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td style="color:var(--muted);">{{ $user->email }}</td>
                            <td><span class="role-badge r-{{ $user->role }}">{{ $user->role }}</span></td>
                            <td style="color:var(--muted);font-size:0.75rem;">{{ $user->created_at->format('M d, Y') }}</td>
                            <td style="text-align:right;">
                                <div style="display:flex;gap:6px;justify-content:flex-end;">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-ghost btn-sm">Edit</a>
                                    @if($user->id !== Auth::id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Delete {{ $user->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-ghost btn-sm" style="color:var(--red);border-color:var(--red);">Delete</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="empty-cell">No users yet. <a href="{{ route('admin.users.create') }}" style="color:var(--teal);">Create one →</a></td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="pag-bar">
                    <div class="pag-info">
                        {{ count($recentUsers ?? []) }} user(s) shown —
                        <a href="{{ route('admin.users.index') }}" style="color:var(--teal);text-decoration:none;font-weight:500;">Manage all →</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('ptSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#ptTable tbody tr[data-name]').forEach(row => {
            row.style.display = row.dataset.name.includes(q) ? '' : 'none';
        });
    });
</script>
</body>
</html>