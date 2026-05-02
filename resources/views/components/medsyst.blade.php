<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MedSyst' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --teal:        #1d9e75;
            --teal-dark:   #0f6e56;
            --teal-light:  #e1f5ee;
            --teal-mid:    #9fe1cb;
            --sidebar-bg:  #0d1f1a;
            --sidebar-w:   240px;
            --top-h:       64px;
            --page-bg:     #f4f6f5;
            --white:       #ffffff;
            --text-1:      #111c18;
            --text-2:      #4a5c55;
            --text-3:      #8fa89f;
            --border:      #e2ebe7;
            --c-blue:      #2563eb; --c-blue-bg:   #eff6ff;
            --c-amber:     #d97706; --c-amber-bg:  #fffbeb;
            --c-red:       #dc2626; --c-red-bg:    #fef2f2;
            --c-green:     #16a34a; --c-green-bg:  #f0fdf4;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--page-bg);
            color: var(--text-1);
            min-height: 100vh;
            display: flex;
        }

        /* ─── Sidebar ─── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1.4rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .brand-icon {
            width: 36px; height: 36px;
            background: var(--teal);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .brand-icon svg { width: 20px; height: 20px; }

        .brand-text {
            font-family: 'DM Serif Display', serif;
            font-size: 1.2rem;
            color: #fff;
        }

        .brand-sub {
            font-size: 0.62rem;
            color: rgba(255,255,255,0.35);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 1px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1.25rem 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-section-label {
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            padding: 0.75rem 0.75rem 0.4rem;
            font-weight: 600;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 0.85rem;
            border-radius: 10px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
        }

        .nav-item:hover { background: rgba(255,255,255,0.07); color: rgba(255,255,255,0.9); }
        .nav-item.active { background: var(--teal); color: #fff; }
        .nav-item svg { width: 17px; height: 17px; flex-shrink: 0; opacity: 0.85; }
        .nav-item.active svg { opacity: 1; }

        .sidebar-footer {
            padding: 1rem 0.75rem;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 0.6rem 0.85rem;
            border-radius: 10px;
            background: none;
            border: none;
            color: rgba(255,255,255,0.4);
            font-size: 0.875rem;
            font-weight: 500;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }

        .logout-btn:hover { background: rgba(220,38,38,0.12); color: #fca5a5; }
        .logout-btn svg { width: 17px; height: 17px; }

        /* ─── Main ─── */
        .main-wrap {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ─── Topbar ─── */
        .topbar {
            height: var(--top-h);
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-left { display: flex; align-items: center; gap: 6px; }
        .page-title-bar { font-size: 0.95rem; font-weight: 600; color: var(--text-1); }
        .breadcrumb { font-size: 0.8rem; color: var(--text-3); }
        .topbar-right { display: flex; align-items: center; gap: 1rem; }
        .topbar-date { font-size: 0.8rem; color: var(--text-3); }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px 5px 5px;
            border-radius: 50px;
            border: 1px solid var(--border);
            background: var(--white);
            cursor: pointer;
            transition: border-color 0.15s;
        }

        .user-pill:hover { border-color: var(--teal-mid); }

        .user-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--teal);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            color: #fff;
        }

        .user-name { font-size: 0.82rem; font-weight: 600; color: var(--text-1); }

        .user-role-badge {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--teal-dark);
            background: var(--teal-light);
            padding: 2px 7px;
            border-radius: 20px;
        }

        /* ─── Page Content ─── */
        .page-content { flex: 1; padding: 2rem; }

        .page-header {
            margin-bottom: 1.75rem;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .page-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.75rem;
            color: var(--text-1);
            line-height: 1.2;
        }

        .page-header p { font-size: 0.875rem; color: var(--text-2); margin-top: 3px; }
        .header-actions { display: flex; gap: 0.75rem; }

        /* ─── Buttons ─── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.7rem 1.4rem;
            background: var(--teal);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            text-decoration: none;
        }

        .btn-primary:hover { background: var(--teal-dark); }
        .btn-primary:active { transform: scale(0.97); }
        .btn-primary svg { width: 16px; height: 16px; }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.65rem 1.2rem;
            background: transparent;
            color: var(--text-2);
            border: 1px solid var(--border);
            border-radius: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: border-color 0.15s, color 0.15s;
            text-decoration: none;
        }

        .btn-outline:hover { border-color: var(--teal-mid); color: var(--teal-dark); }

        /* ─── Panel ─── */
        .panel {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--border);
            overflow: hidden;
            animation: fadeUp 0.4s ease both;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .panel-title { font-weight: 700; font-size: 0.9rem; color: var(--text-1); }
        .panel-body { padding: 1.5rem; }

        /* ─── Table ─── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        .data-table th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: var(--text-3);
            border-bottom: 1px solid var(--border);
            background: #fafcfb;
        }

        .data-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border);
            color: var(--text-1);
            vertical-align: middle;
        }

        .data-table tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover { background: #f9fdfb; }

        /* ─── Badges ─── */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge-admin    { background: #f5f3ff; color: #7c3aed; }
        .badge-nurse    { background: var(--teal-light); color: var(--teal-dark); }
        .badge-receptionist { background: #eff6ff; color: #1d4ed8; }
        .badge-doctor   { background: #fffbeb; color: #92400e; }
        .badge-waiting  { background: var(--c-amber-bg); color: var(--c-amber); }
        .badge-critical { background: var(--c-red-bg); color: var(--c-red); }
        .badge-done     { background: var(--c-green-bg); color: var(--c-green); }

        /* ─── Empty State ─── */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 1rem;
            color: var(--text-3);
            gap: 0.75rem;
        }

        .empty-state svg { width: 40px; height: 40px; opacity: 0.35; }
        .empty-state p { font-size: 0.85rem; }

        /* ─── Animation ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrap { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

@include('partials._sidebar')

<div class="main-wrap">
    <header class="topbar">
        <div class="topbar-left">
            <span class="page-title-bar">{{ $title ?? 'Dashboard' }}</span>
            <span class="breadcrumb">/ {{ $subtitle ?? 'Overview' }}</span>
        </div>
        <div class="topbar-right">
            <span class="topbar-date" id="live-date"></span>
            <div class="user-pill">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                <span class="user-name">{{ auth()->user()->name }}</span>
                <span class="user-role-badge">{{ ucfirst(auth()->user()->role) }}</span>
            </div>
        </div>
    </header>

    <main class="page-content">
        {{ $slot }}
    </main>
</div>

<script>
    const dateEl = document.getElementById('live-date');
    function updateDate() {
        const now = new Date();
        dateEl.textContent = now.toLocaleDateString('en-US', { weekday:'short', month:'short', day:'numeric', year:'numeric' });
    }
    updateDate();
</script>
@stack('scripts')
</body>
</html>