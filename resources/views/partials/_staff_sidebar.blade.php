<nav class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">
            <svg viewBox="0 0 100 100" fill="none">
                <path d="M50 85C50 85 10 60 10 35C10 20 22 10 35 10C42 10 48 14 50 18C52 14 58 10 65 10C78 10 90 20 90 35C90 60 50 85 50 85Z" stroke="#fff" stroke-width="6" fill="none" stroke-linejoin="round"/>
                <rect x="42" y="32" width="16" height="36" rx="6" fill="#fff"/>
                <rect x="32" y="42" width="36" height="16" rx="6" fill="#fff"/>
            </svg>
        </div>
        <span>MedSyst</span>
    </div>

    <div class="nav-section">
        <p class="nav-label">Overview</p>
        <a href="{{ route('staff.dashboard') }}" class="nav-item {{ ($active ?? '') === 'dashboard' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            Dashboard
        </a>
    </div>

    <div class="nav-section">
        <p class="nav-label">Patients</p>
        <a href="{{ route('staff.patients.create') }}" class="nav-item {{ ($active ?? '') === 'patients.create' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Register Patient
        </a>
        <a href="{{ route('staff.emergency.create') }}" class="nav-item {{ ($active ?? '') === 'emergency.create' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
            Emergency
        </a>
    </div>

    <div class="nav-section">
        <p class="nav-label">Queue</p>
        <a href="{{ route('staff.queue.manage') }}" class="nav-item {{ ($active ?? '') === 'queue.manage' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            Manage Queue
        </a>
        <a href="{{ route('staff.queue.emergency') }}" class="nav-item {{ ($active ?? '') === 'queue.emergency' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            Emergency Queue
        </a>
        <a href="{{ route('staff.queue.priority') }}" class="nav-item {{ ($active ?? '') === 'queue.priority' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M5 11l7-7 7 7M5 19l7-7 7 7"/></svg>
            Priority Queue
        </a>
        <a href="{{ route('staff.queue.regular') }}" class="nav-item {{ ($active ?? '') === 'queue.regular' ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Regular Queue
        </a>
    </div>

    <div class="sidebar-spacer"></div>

    <div style="padding:0 0.75rem 0.5rem;">
        <div style="display:flex;align-items:center;gap:9px;padding:10px 12px;border-radius:9px;margin-bottom:4px;border-top:1px solid rgba(255,255,255,0.08);padding-top:12px;">
            <div style="width:32px;height:32px;border-radius:50%;background:var(--teal);display:flex;align-items:center;justify-content:center;font-size:0.72rem;font-weight:700;color:#fff;flex-shrink:0;">
                {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 2)) }}
            </div>
            <div style="min-width:0;">
                <div style="font-size:0.8rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::user()->name ?? 'Staff' }}</div>
                <div style="font-size:0.68rem;color:rgba(255,255,255,0.38);text-transform:capitalize;">{{ Auth::user()->role ?? 'Staff' }}</div>
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