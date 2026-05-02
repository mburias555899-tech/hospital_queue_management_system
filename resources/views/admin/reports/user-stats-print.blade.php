<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — User Statistics Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --teal:#2e9d91;--teal-dark:#1f7a70;--teal-deep:#155c55;--teal-bg:#e8f5f3;
            --red:#e24b4a;--red-bg:#fcebeb;--red-dark:#a32d2d;
            --amber:#ef9f27;--amber-bg:#faeeda;--amber-dark:#b36a10;
            --green:#3b9e3b;--green-bg:#eaf3de;--green-dark:#2a5a11;
            --blue-bg:#e8f0fe;--blue:#3b5bdb;
            --purple-bg:#f3f0ff;--purple:#6741d9;
            --dark:#1a1a1a;--mid:#4a4a4a;--muted:#8a8a8a;
            --border:#e2e8e6;--surface:#f4f7f6;--white:#ffffff;
        }

        html, body {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--dark);
            background: #fff;
        }

       
        .screen-bar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: var(--dark); padding: 10px 24px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .screen-bar span { color: rgba(255,255,255,.55); font-size: 0.8rem; }
        .print-btn {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--teal); color: #fff;
            border: none; border-radius: 50px;
            padding: 9px 22px; font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem; font-weight: 600; cursor: pointer;
            transition: background .15s;
        }
        .print-btn:hover { background: var(--teal-dark); }
        .print-btn svg { width: 14px; height: 14px; }
        .back-btn {
            display: inline-flex; align-items: center; gap: 6px;
            color: rgba(255,255,255,.6); text-decoration: none;
            font-size: 0.8rem; transition: color .15s;
        }
        .back-btn:hover { color: #fff; }
        .back-btn svg { width: 13px; height: 13px; }

        .page {
            max-width: 800px;
            margin: 70px auto 40px;
            padding: 0 24px;
        }


        .report-header {
            display: flex; align-items: stretch;
            border: 1px solid var(--border); border-radius: 14px;
            overflow: hidden; margin-bottom: 20px;
        }
        .report-header-brand {
            background: var(--dark); padding: 20px 24px;
            display: flex; flex-direction: column; justify-content: center;
            min-width: 130px;
        }
        .brand-logo {
            display: flex; align-items: center; gap: 8px; margin-bottom: 6px;
        }
        .brand-logo-icon {
            width: 28px; height: 28px; background: var(--teal);
            border-radius: 7px; display: flex; align-items: center; justify-content: center;
        }
        .brand-logo-icon svg { width: 16px; height: 16px; }
        .brand-name {
            font-family: 'DM Serif Display', serif;
            font-size: 1.1rem; color: #fff;
        }
        .brand-tag { font-size: 0.65rem; color: rgba(255,255,255,.4); margin-top: 2px; }
        .report-header-info {
            flex: 1; padding: 18px 22px;
            border-left: 1px solid var(--border);
        }
        .report-header-info h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.35rem; color: var(--dark); margin-bottom: 4px;
        }
        .report-header-info p { font-size: 0.78rem; color: var(--muted); }
        .report-header-meta {
            padding: 18px 22px; text-align: right;
            border-left: 1px solid var(--border);
            min-width: 160px;
        }
        .meta-item { margin-bottom: 8px; }
        .meta-label { font-size: 0.65rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; }
        .meta-value { font-size: 0.82rem; font-weight: 600; color: var(--dark); margin-top: 1px; }

     
        .confidential-banner {
            background: var(--red-bg); border: 1px solid #f7c1c1;
            border-radius: 10px; padding: 10px 14px;
            display: flex; align-items: flex-start; gap: 8px;
            margin-bottom: 20px;
        }
        .confidential-banner svg { width: 14px; height: 14px; color: var(--red); flex-shrink: 0; margin-top: 1px; }
        .confidential-banner span { font-size: 0.76rem; color: var(--red-dark); line-height: 1.5; }

      
        .section { margin-bottom: 20px; }
        .section-header {
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 10px;
        }
        .section-header h2 { font-size: 0.88rem; font-weight: 700; color: var(--dark); }
        .section-header p { font-size: 0.72rem; color: var(--muted); margin-top: 1px; }
        .section-icon {
            width: 28px; height: 28px; background: var(--teal-bg);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .section-icon svg { width: 13px; height: 13px; color: var(--teal-dark); }

        .summary-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;
            margin-bottom: 20px;
        }
        .summary-card {
            border: 1px solid var(--border); border-radius: 12px;
            padding: 14px 16px;
        }
        .summary-card.teal   { border-left: 4px solid var(--teal); }
        .summary-card.blue   { border-left: 4px solid var(--blue); }
        .summary-card.amber  { border-left: 4px solid var(--amber); }
        .summary-card.purple { border-left: 4px solid var(--purple); }
        .sc-label { font-size: 0.65rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .07em; margin-bottom: 5px; }
        .sc-num { font-family: 'DM Serif Display', serif; font-size: 2rem; color: var(--dark); line-height: 1; }
        .sc-sub { font-size: 0.68rem; color: var(--muted); margin-top: 3px; }

   
        .breakdown-table { width: 100%; border-collapse: collapse; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
        .breakdown-table thead tr { background: var(--surface); }
        .breakdown-table th { padding: 9px 14px; text-align: left; font-size: 0.67rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .07em; }
        .breakdown-table td { padding: 12px 14px; border-top: 1px solid var(--border); vertical-align: middle; }
        .breakdown-table tbody tr:hover { background: #fafcfc; }

        .role-badge { display: inline-block; padding: 3px 11px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
        .role-admin        { background: var(--purple-bg); color: var(--purple); }
        .role-doctor       { background: var(--blue-bg);   color: var(--blue); }
        .role-nurse        { background: var(--teal-bg);   color: var(--teal-deep); }
        .role-receptionist { background: var(--amber-bg);  color: var(--amber-dark); }

        .bar-wrap { width: 120px; height: 7px; background: var(--border); border-radius: 4px; overflow: hidden; display: inline-block; vertical-align: middle; }
        .bar-fill { height: 100%; border-radius: 4px; }
        .bar-purple { background: var(--purple); }
        .bar-blue   { background: var(--blue); }
        .bar-teal   { background: var(--teal); }
        .bar-amber  { background: var(--amber); }

        .count-cell { font-family: 'DM Serif Display', serif; font-size: 1.4rem; color: var(--dark); }
        .pct-cell   { font-size: 0.78rem; font-weight: 700; color: var(--mid); }
        .access-cell { font-size: 0.74rem; color: var(--muted); }

    
        .observations {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 12px; padding: 16px 18px;
        }
        .obs-title { font-size: 0.78rem; font-weight: 700; color: var(--dark); margin-bottom: 10px; }
        .obs-item { display: flex; align-items: flex-start; gap: 8px; margin-bottom: 7px; font-size: 0.78rem; color: var(--mid); line-height: 1.5; }
        .obs-item svg { width: 12px; height: 12px; color: var(--teal); flex-shrink: 0; margin-top: 2px; }
        .obs-warn svg { color: var(--red); }
        .obs-item:last-child { margin-bottom: 0; }

   
        .report-footer {
            margin-top: 24px; padding-top: 14px;
            border-top: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            font-size: 0.7rem; color: var(--muted);
        }

   
        @media print {
            @page { size: A4; margin: 14mm 16mm; }
            .screen-bar { display: none !important; }
            .page { margin: 0; padding: 0; max-width: 100%; }
            body { font-size: 11px; }
            .summary-grid { gap: 7px; }
            .summary-card { padding: 10px 12px; }
            .sc-num { font-size: 1.6rem; }
            .breakdown-table td, .breakdown-table th { padding: 8px 11px; }
            .bar-wrap { width: 90px; }
            .report-footer { margin-top: 16px; }
        }
    </style>
</head>
<body>

    {{-- Screen-only top bar --}}
    <div class="screen-bar">
        <a href="{{ route('admin.reports.index') }}" class="back-btn">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back to Reports
        </a>
        <span>Preview — click Print / Save as PDF when ready</span>
        <button class="print-btn" onclick="window.print()">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a1 1 0 001-1v-4a1 1 0 00-1-1H9a1 1 0 00-1 1v4a1 1 0 001 1zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Print / Save as PDF
        </button>
    </div>

    <div class="page">

        {{-- Report header --}}
        <div class="report-header">
            <div class="report-header-brand">
                <div class="brand-logo">
                    <div class="brand-logo-icon">
                        <svg viewBox="0 0 100 100" fill="none"><path d="M50 85C50 85 10 60 10 35C10 20 22 10 35 10C42 10 48 14 50 18C52 14 58 10 65 10C78 10 90 20 90 35C90 60 50 85 50 85Z" stroke="#fff" stroke-width="6" fill="none" stroke-linejoin="round"/><rect x="42" y="32" width="16" height="36" rx="6" fill="#fff"/><rect x="32" y="42" width="36" height="16" rx="6" fill="#fff"/></svg>
                    </div>
                    <span class="brand-name">MedSyst</span>
                </div>
                <div class="brand-tag">Hospital Management System</div>
            </div>
            <div class="report-header-info">
                <h1>User Statistics Report</h1>
                <p>System-level breakdown of all registered user accounts by role</p>
            </div>
            <div class="report-header-meta">
                <div class="meta-item">
                    <div class="meta-label">Report Date</div>
                    <div class="meta-value">{{ now()->format('F j, Y') }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">Generated By</div>
                    <div class="meta-value">{{ Auth::user()->name }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">Generated At</div>
                    <div class="meta-value">{{ now()->format('g:i A') }}</div>
                </div>
            </div>
        </div>

        {{-- Confidential banner --}}
        <div class="confidential-banner">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
            <span><strong>Confidential — For Administrative Use Only.</strong> This report contains sensitive staff information. Distribution should be restricted to authorised administrators only.</span>
        </div>

        {{-- Summary cards --}}
        <div class="section">
            <div class="section-header">
                <div class="section-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4.13a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h2>User Overview</h2>
                    <p>Total registered accounts across all roles</p>
                </div>
            </div>

            <div class="summary-grid">
                <div class="summary-card teal">
                    <div class="sc-label">Total Users</div>
                    <div class="sc-num">{{ $totalUsers }}</div>
                    <div class="sc-sub">All registered accounts</div>
                </div>
                <div class="summary-card blue">
                    <div class="sc-label">Doctors</div>
                    <div class="sc-num">{{ $totalDoctors }}</div>
                    <div class="sc-sub">{{ $totalUsers > 0 ? round($totalDoctors / $totalUsers * 100) : 0 }}% of total</div>
                </div>
                <div class="summary-card teal">
                    <div class="sc-label">Nurses</div>
                    <div class="sc-num">{{ $totalNurses }}</div>
                    <div class="sc-sub">{{ $totalUsers > 0 ? round($totalNurses / $totalUsers * 100) : 0 }}% of total</div>
                </div>
                <div class="summary-card amber">
                    <div class="sc-label">Receptionists</div>
                    <div class="sc-num">{{ $totalReceptionists }}</div>
                    <div class="sc-sub">{{ $totalUsers > 0 ? round($totalReceptionists / $totalUsers * 100) : 0 }}% of total</div>
                </div>
            </div>
        </div>

        {{-- Role breakdown table --}}
        <div class="section">
            <div class="section-header">
                <div class="section-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <h2>Role Breakdown</h2>
                    <p>Count, share, and system access level per role</p>
                </div>
            </div>

            @php
                $roles = [
                    ['name' => 'Administrator', 'count' => $totalAdmins,        'badge' => 'role-admin',        'bar' => 'bar-purple', 'access' => 'Full system access — users, reports, all records'],
                    ['name' => 'Doctor',        'count' => $totalDoctors,       'badge' => 'role-doctor',       'bar' => 'bar-blue',   'access' => 'Patient records & queue views'],
                    ['name' => 'Nurse',         'count' => $totalNurses,        'badge' => 'role-nurse',        'bar' => 'bar-teal',   'access' => 'Patient registration & queue management'],
                    ['name' => 'Receptionist',  'count' => $totalReceptionists, 'badge' => 'role-receptionist', 'bar' => 'bar-amber',  'access' => 'Patient registration & queue management'],
                ];
            @endphp

            <table class="breakdown-table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Count</th>
                        <th>Share</th>
                        <th>Distribution</th>
                        <th>System Access</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    @php $pct = $totalUsers > 0 ? round($role['count'] / $totalUsers * 100) : 0; @endphp
                    <tr>
                        <td><span class="role-badge {{ $role['badge'] }}">{{ $role['name'] }}</span></td>
                        <td class="count-cell">{{ $role['count'] }}</td>
                        <td class="pct-cell">{{ $pct }}%</td>
                        <td>
                            <div class="bar-wrap">
                                <div class="bar-fill {{ $role['bar'] }}" style="width:{{ $pct }}%"></div>
                            </div>
                        </td>
                        <td class="access-cell">{{ $role['access'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Observations --}}
        <div class="section">
            <div class="observations">
                <div class="obs-title">Observations</div>

                @php
                    $dominant = collect([
                        ['name' => 'Administrator', 'count' => $totalAdmins],
                        ['name' => 'Doctor',        'count' => $totalDoctors],
                        ['name' => 'Nurse',         'count' => $totalNurses],
                        ['name' => 'Receptionist',  'count' => $totalReceptionists],
                    ])->sortByDesc('count')->first();
                @endphp

                <div class="obs-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Total of <strong>{{ $totalUsers }}</strong> user account(s) are currently registered in the system.</span>
                </div>

                @if($totalUsers > 0)
                <div class="obs-item">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>The largest user group is <strong>{{ $dominant['name'] }}</strong> with <strong>{{ $dominant['count'] }}</strong> account(s) ({{ round($dominant['count'] / $totalUsers * 100) }}% of all users).</span>
                </div>
                @endif

                @if($totalAdmins === 0)
                <div class="obs-item obs-warn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    <span><strong>Warning:</strong> No Administrator accounts are registered. At least one administrator is recommended.</span>
                </div>
                @endif

                @if($totalDoctors === 0)
                <div class="obs-item obs-warn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    <span><strong>Note:</strong> No Doctor accounts are registered in the system.</span>
                </div>
                @endif

                @if($totalUsers === 0)
                <div class="obs-item obs-warn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    <span>No users are currently registered in the system.</span>
                </div>
                @endif
            </div>
        </div>

        {{-- Footer --}}
        <div class="report-footer">
            <span>MedSyst Hospital Management System</span>
            <span>User Statistics Report · {{ now()->format('F j, Y \a\t g:i A') }}</span>
            <span>Generated by {{ Auth::user()->name }}</span>
        </div>

    </div>

    <script>
        
        window.addEventListener('load', () => window.print());
    </script>

</body>
</html>