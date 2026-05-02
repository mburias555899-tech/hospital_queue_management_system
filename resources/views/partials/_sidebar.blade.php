<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21C12 21 4 13.5 4 8a8 8 0 0116 0c0 5.5-8 13-8 13z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4M10 10h4"/>
            </svg>
        </div>
        <div>
            <div class="brand-text">MedSyst</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Overview</div>
        <a href="{{ route('dashboard') }}" class="nav-item {{ ($active ?? '') === 'dashboard' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            Dashboard
        </a>

        <div class="nav-section-label">Records</div>
        <a href="{{ \Illuminate\Support\Facades\Route::has('admin.patients.index') ? route('admin.patients.index') : '#' }}" class="nav-item {{ ($active ?? '') === 'patients' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Patient Records
        </a>
        <a href="{{ \Illuminate\Support\Facades\Route::has('admin.reports.index') ? route('admin.reports.index') : '#' }}" class="nav-item {{ ($active ?? '') === 'reports' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Reports
        </a>

        <div class="nav-section-label">Administration</div>
        <a href="{{ \Illuminate\Support\Facades\Route::has('admin.users.index') ? route('admin.users.index') : '#' }}" class="nav-item {{ ($active ?? '') === 'users' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            User Accounts
        </a>
        <a href="{{ \Illuminate\Support\Facades\Route::has('admin.users.create') ? route('admin.users.create') : '#' }}" class="nav-item {{ ($active ?? '') === 'users.create' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Create User
        </a>
    </nav>

    <div style="flex:1"></div>

    <div style="padding: 1rem 0.75rem; border-top: 1px solid rgba(255,255,255,0.07);">
        <div style="display:flex; align-items:center; gap:10px; padding: 0.6rem 0.85rem; margin-bottom: 4px;">
            <div class="user-avatar" style="width:34px;height:34px;font-size:0.75rem;flex-shrink:0;">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
            </div>
            <div>
                <div style="font-size:0.85rem;font-weight:600;color:#fff;">{{ Auth::user()->name ?? 'Admin' }}</div>
                <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>