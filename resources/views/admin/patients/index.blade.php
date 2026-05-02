<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MedSyst — Patient Records</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>


        :root{
            --teal:#2e9d91;
            --teal-dark:#1f7a70;
            --teal-deep:#155c55;
            --teal-bg:#e8f5f3;

            --red:#e24b4a;
            --red-bg:#fcebeb;

            --amber:#ef9f27;
            --amber-bg:#faeeda;

            --green:#3b9e3b;
            --green-bg:#eaf3de;

            --dark:#1a1a1a;
            --mid:#4a4a4a;
            --muted:#8a8a8a;

            --border:#e2e8e6;
            --surface:#f4f7f6;
            --white:#ffffff;
        }

        
        *,*::before,*::after{
            box-sizing:border-box;
            margin:0;
            padding:0;
        }

        html,body{
            height:100%;
            font-family:'DM Sans',sans-serif;
            background:var(--surface);
            color:var(--dark);
            font-size:14px;
        }

        
        .shell{
            display:flex;
            min-height:100vh;
        }

        .main{
            flex:1;
            display:flex;
            flex-direction:column;
            min-width:0;
        }

        
        .sidebar{
            width:220px;
            height:100vh;
            position:sticky;
            top:0;

            display:flex;
            flex-direction:column;
            flex-shrink:0;

            background:var(--dark);
        }

       
        .sidebar-logo{
            display:flex;
            align-items:center;
            gap:10px;

            padding:1.4rem;
            border-bottom:1px solid rgba(255,255,255,0.08);
        }

        .logo-box{
            width:32px;
            height:32px;

            display:flex;
            align-items:center;
            justify-content:center;

            background:var(--teal);
            border-radius:8px;
        }

        .logo-box svg{
            width:18px;
            height:18px;
        }

        .brand{
            font-family:'DM Serif Display',serif;
            font-size:1.15rem;
            color:#fff;
            letter-spacing:-0.3px;
        }

       
        .nav{
            flex:1;
            padding:1rem 0.75rem;

            display:flex;
            flex-direction:column;
            gap:2px;
        }

        .nav-group{
            margin-bottom:1.25rem;
        }

        .nav-group-label{
            font-size:0.65rem;
            font-weight:700;
            color:rgba(255,255,255,0.28);
            letter-spacing:.12em;
            text-transform:uppercase;

            padding:0 0.65rem;
            margin-bottom:5px;
        }

        .nav-link{
            display:flex;
            align-items:center;
            gap:9px;

            padding:9px 12px;
            border-radius:9px;

            font-size:0.84rem;
            font-weight:500;

            color:rgba(255,255,255,0.52);
            text-decoration:none;

            transition:background .15s,color .15s;
        }

        .nav-link svg{
            width:15px;
            height:15px;
            flex-shrink:0;
        }

        .nav-link:hover{
            background:rgba(255,255,255,0.07);
            color:rgba(255,255,255,0.88);
        }

        .nav-link.active{
            background:var(--teal);
            color:#fff;
        }

       
        .sidebar-footer{
            padding:1rem 0.75rem;
            border-top:1px solid rgba(255,255,255,0.08);
        }

        .user-row{
            display:flex;
            align-items:center;
            gap:9px;

            padding:8px 10px;
            margin-bottom:8px;
        }

        .user-av{
            width:30px;
            height:30px;

            display:flex;
            align-items:center;
            justify-content:center;

            border-radius:50%;
            background:var(--teal);
            color:#fff;

            font-size:0.7rem;
            font-weight:700;
            flex-shrink:0;
        }

        .uname{
            font-size:0.8rem;
            font-weight:600;
            color:#fff;
        }

        .urole{
            font-size:0.68rem;
            color:rgba(255,255,255,0.38);
            text-transform:capitalize;
        }

       
        .logout-btn{
            display:flex;
            align-items:center;
            gap:9px;

            width:100%;
            padding:9px 12px;

            background:transparent;
            border:none;
            border-radius:9px;

            color:rgba(255,255,255,0.45);

            font-family:'DM Sans',sans-serif;
            font-size:0.84rem;
            font-weight:500;

            cursor:pointer;
            text-align:left;

            transition:background .15s,color .15s;
        }

        .logout-btn svg{
            width:15px;
            height:15px;
            flex-shrink:0;
        }

        .logout-btn:hover{
            background:rgba(226,75,74,0.15);
            color:#ff8a89;
        }

       
        .topbar{
            height:58px;
            padding:0 2rem;

            display:flex;
            align-items:center;
            justify-content:space-between;

            background:var(--white);
            border-bottom:1px solid var(--border);

            position:sticky;
            top:0;
            z-index:10;
        }

        .topbar-left{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .back-btn{
            display:flex;
            align-items:center;
            gap:6px;

            padding:6px 10px;
            border-radius:8px;

            font-size:0.82rem;
            color:var(--muted);
            text-decoration:none;

            transition:background .15s,color .15s;
        }

        .back-btn:hover{
            background:var(--surface);
            color:var(--dark);
        }

        .breadcrumb{
            display:flex;
            align-items:center;
            gap:6px;

            font-size:0.82rem;
            color:var(--muted);
        }

        .breadcrumb a{
            color:var(--teal-dark);
            text-decoration:none;
        }

       
        .content{
            padding:1.75rem 2rem;
        }

        .page-head{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;

            margin-bottom:1.5rem;
            flex-wrap:wrap;
            gap:10px;
        }

        .page-head h1{
            font-family:'DM Serif Display',serif;
            font-size:1.7rem;
            color:var(--dark);
            letter-spacing:-0.4px;
        }

        .page-head p{
            font-size:0.85rem;
            color:var(--muted);
            margin-top:3px;
        }

       
        .table-card{
            background:var(--white);
            border:1px solid var(--border);
            border-radius:16px;
            overflow:hidden;
        }

      
        .table-toolbar{
            display:flex;
            align-items:center;
            justify-content:space-between;

            padding:12px 16px;
            border-bottom:1px solid var(--border);

            gap:10px;
            flex-wrap:wrap;
        }

       
        .search-wrap{
            position:relative;
            max-width:280px;
            flex:1;
        }

        .search-wrap svg{
            position:absolute;
            left:10px;
            top:50%;
            transform:translateY(-50%);

            width:13px;
            height:13px;
            color:var(--muted);
        }

        .search-wrap input{
            width:100%;
            padding:7px 10px 7px 30px;

            border:1.5px solid var(--border);
            border-radius:8px;

            font-family:'DM Sans',sans-serif;
            font-size:0.83rem;

            color:var(--dark);
            background:var(--surface);

            outline:none;
        }

        .search-wrap input:focus{
            border-color:var(--teal);
            background:var(--white);
        }

     
        .filter-sel{
            padding:7px 28px 7px 10px;

            border:1.5px solid var(--border);
            border-radius:8px;

            font-size:0.8rem;
            color:var(--mid);
            background:var(--surface);

            outline:none;
            cursor:pointer;
        }

        .filter-sel:focus{
            border-color:var(--teal);
        }

        
        .data-table{
            width:100%;
            border-collapse:collapse;
        }

        .data-table thead tr{
            background:var(--surface);
            border-bottom:1px solid var(--border);
        }

        .data-table th{
            padding:9px 15px;
            font-size:0.7rem;
            font-weight:700;

            color:var(--muted);
            text-transform:uppercase;
            letter-spacing:.07em;
        }

        .data-table td{
            padding:11px 15px;
            font-size:0.83rem;
            color:var(--dark);

            border-bottom:1px solid var(--border);
        }

        .data-table tbody tr:hover{
            background:#fafcfc;
        }

      
        .pt-cell{
            display:flex;
            align-items:center;
            gap:9px;
        }

        .pt-av{
            width:30px;
            height:30px;

            display:flex;
            align-items:center;
            justify-content:center;

            border-radius:50%;
            background:var(--teal-bg);
            color:var(--teal-deep);

            font-size:0.68rem;
            font-weight:700;
        }

        .pt-name{
            font-size:0.83rem;
            font-weight:600;
        }

        .pt-sub{
            font-size:0.7rem;
            color:var(--muted);
        }

       
        .badge{
            display:inline-block;
            padding:2px 9px;
            border-radius:20px;

            font-size:0.68rem;
            font-weight:600;
        }

        .b-male{background:#e8f0fe;color:#3b5bdb;}
        .b-female{background:#fce4ec;color:#c2185b;}
        .b-other,.b-unknown{background:#f1f0ea;color:#5a5745;}

      
        .empty-cell{
            text-align:center;
            padding:3rem;
            color:var(--muted);
        }

       
        .pag-bar{
            display:flex;
            align-items:center;
            justify-content:space-between;

            padding:10px 15px;
            border-top:1px solid var(--border);
        }

        .pag-info{
            font-size:0.75rem;
            color:var(--muted);
        }

       
        @media(max-width:900px){
            .sidebar{display:none;}
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
                <div><div class="uname">{{ Auth::user()->name ?? 'Admin' }}</div><div class="urole">{{ Auth::user()->role ?? 'admin' }}</div></div>
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
                <a href="{{ route('admin.dashboard') }}" class="back-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
                <div class="breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span>/</span>
                    <span>Patient Records</span>
                </div>
            </div>
        </header>

        <div class="content">
            <div class="page-head">
                <div>
                    <h1>Patient Records</h1>
                    <p>All registered patients — view only</p>
                </div>
            </div>

            <div class="table-card">
                <div class="table-toolbar">
                    <div class="search-wrap">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" id="ptSearch" placeholder="Search name, condition...">
                    </div>
                    <div style="display:flex;gap:8px;">
                        <select class="filter-sel" id="filterGender" onchange="applyFilters()">
                            <option value="">All genders</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="data-table" id="ptTable">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Condition</th>
                                <th>Date of Birth</th>
                                <th>Registered</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($patients as $patient)
                        <tr data-name="{{ strtolower($patient->first_name . ' ' . $patient->last_name . ' ' . $patient->condition) }}"
                            data-gender="{{ strtolower($patient->gender ?? '') }}">
                            <td>
                                <div class="pt-cell">
                                    <div class="pt-av">{{ strtoupper(substr($patient->first_name ?? 'U', 0, 1) . substr($patient->last_name ?? 'K', 0, 1)) }}</div>
                                    <div>
                                        <div class="pt-name">{{ $patient->first_name }} {{ $patient->last_name }}</div>
                                        <div class="pt-sub">#{{ $patient->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $patient->age ?? '—' }}</td>
                            <td>
                                <span class="badge b-{{ strtolower($patient->gender ?? 'unknown') }}">
                                    {{ $patient->gender ?? 'Unknown' }}
                                </span>
                            </td>
                            <td>{{ $patient->contact ?? '—' }}</td>
                            <td style="max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $patient->address }}">
                                {{ $patient->address ?? '—' }}
                            </td>
                            <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $patient->condition }}">
                                {{ \Illuminate\Support\Str::limit($patient->condition ?? 'N/A', 40) }}
                            </td>
                            <td style="color:var(--muted);font-size:0.75rem;white-space:nowrap;">
                                {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') : '—' }}
                            </td>
                            <td style="color:var(--muted);font-size:0.75rem;white-space:nowrap;">
                                {{ $patient->created_at->format('M d, Y') }}
                            </td>
                            <td style="text-align:right;">
                                <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-ghost btn-sm">View</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="9" class="empty-cell">No patients found.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pag-bar">
                    <div class="pag-info">
                        Showing {{ $patients->firstItem() }}–{{ $patients->lastItem() }} of {{ $patients->total() }} patients
                    </div>
                    <div>{{ $patients->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('ptSearch').addEventListener('input', applyFilters);

    function applyFilters() {
        const q = document.getElementById('ptSearch').value.toLowerCase();
        const g = document.getElementById('filterGender').value;
        document.querySelectorAll('#ptTable tbody tr[data-name]').forEach(row => {
            const matchQ = row.dataset.name.includes(q);
            const matchG = !g || row.dataset.gender === g;
            row.style.display = (matchQ && matchG) ? '' : 'none';
        });
    }
</script>
</body>
</html>