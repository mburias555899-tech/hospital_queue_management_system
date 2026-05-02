<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Priority Queue</title>
    @include('partials._styles')
    <style>
        .queue-header-band { background: var(--amber); padding: 10px 2rem; display: flex; align-items: center; gap: 10px; }
        .queue-header-band p { font-size: 0.82rem; font-weight: 600; color: #fff; }
        .queue-header-band span { font-size: 0.75rem; color: rgba(255,255,255,.8); }
        .q-num-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 52px; height: 36px; border-radius: 8px; background: var(--amber-bg); color: var(--amber-dark); font-family: 'DM Serif Display', serif; font-size: 1.1rem; font-weight: 700; }
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 50; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .modal { background: var(--white); border-radius: 18px; width: 100%; max-width: 460px; box-shadow: 0 20px 60px rgba(0,0,0,.2); overflow: hidden; animation: slideUp .2s ease; }
        @keyframes slideUp { from{transform:translateY(16px);opacity:0}to{transform:translateY(0);opacity:1} }
        .modal-header { padding: 1.2rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .modal-header h3 { font-size: 1rem; font-weight: 600; }
        .modal-close { width: 28px; height: 28px; border-radius: 7px; border: none; background: var(--surface); cursor: pointer; display: flex; align-items: center; justify-content: center; }
        .modal-close svg { width: 14px; height: 14px; color: var(--muted); }
        .modal-body { padding: 1.5rem; }
        .modal-field { margin-bottom: 1rem; }
        .modal-field label { display: block; font-size: 0.75rem; font-weight: 600; color: var(--mid); text-transform: uppercase; letter-spacing: .05em; margin-bottom: 5px; }
        .modal-field select { width: 100%; padding: 10px 32px 10px 12px; border: 1.5px solid var(--border); border-radius: 10px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; color: var(--dark); outline: none; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%238a8a8a' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 10px center; background-size: 13px; }
        .modal-field select:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(46,157,145,.1); }
        .modal-footer { display: flex; justify-content: flex-end; gap: 8px; padding: 1rem 1.5rem; border-top: 1px solid var(--border); background: var(--surface); }
    </style>
</head>
<body>
<div class="shell">
    @include('partials._staff_sidebar', ['active' => 'queue.priority'])

    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <a href="{{ route('staff.dashboard') }}" class="back-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
                <div class="breadcrumb">
                    <a href="{{ route('staff.dashboard') }}">Dashboard</a>
                    <span>/</span>
                    <span>Priority Queue</span>
                </div>
            </div>
            <div class="topbar-right">
                <span class="live-label"><span class="live-dot"></span> Live</span>
            </div>
        </header>

        <div class="queue-header-band">
            <svg fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2" style="width:14px;height:14px;flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            <p>PRIORITY QUEUE <span>— Senior citizens, pregnant patients, and urgent cases.</span></p>
        </div>

        <div class="content">
            <div class="page-header">
                <div class="page-header-left">
                    <h1>Priority Queue</h1>
                    <p>{{ $queues->total() ?? 0 }} patient(s) — senior, pregnant, or urgent condition</p>
                </div>
                <a href="{{ route('staff.queue.manage') }}" class="btn btn-ghost btn-sm">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    Full Queue Manager
                </a>
            </div>

            @if(session('success'))
            <div style="background:var(--green-bg);border:1px solid #c0dd97;border-radius:10px;padding:10px 16px;margin-bottom:1.25rem;font-size:0.82rem;color:#2a5a11;">{{ session('success') }}</div>
            @endif

            <div class="table-card">
                <div class="table-toolbar">
                    <div class="search-wrap">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" id="searchInput" placeholder="Search patient name...">
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="filterStatus" onchange="applyFilters()">
                            <option value="">All statuses</option>
                            <option value="waiting">Waiting</option>
                            <option value="called">Called</option>
                            <option value="serving">Serving</option>
                            <option value="done">Done</option>
                        </select>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table class="data-table" id="queueTable">
                        <thead>
                            <tr>
                                <th>Queue #</th>
                                <th>Patient</th>
                                <th>Condition</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th>Waiting</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($queues ?? [] as $queue)
                        @php
                            $patient = $queue->patient;
                            $initials = strtoupper(substr($patient->first_name ?? 'U', 0, 1) . substr($patient->last_name ?? 'K', 0, 1));
                            $fullName = ($patient->first_name ?? 'Unknown') . ' ' . ($patient->last_name ?? 'Walk-in');
                            $waitMins = $queue->created_at ? now()->diffInMinutes($queue->created_at) : 0;
                        @endphp
                        <tr class="row-urgent" data-status="{{ $queue->status }}" data-name="{{ strtolower($fullName) }}">
                            <td><span class="q-num-badge">{{ $queue->queue_number }}</span></td>
                            <td>
                                <div class="patient-cell">
                                    <div class="pt-avatar amber">{{ $initials }}</div>
                                    <div>
                                        <div class="pt-name">{{ $fullName }}</div>
                                        <div class="pt-sub">{{ $patient->age ?? '—' }} yrs · {{ $patient->gender ?? 'Unknown' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $patient->condition ?? '' }}">{{ Str::limit($patient->condition ?? 'N/A', 40) }}</td>
                            <td>
                                @if($queue->doctor)
                                    <span style="font-size:0.82rem;font-weight:500;">{{ $queue->doctor->name }}</span>
                                @else
                                    <button class="btn btn-ghost btn-sm" onclick="openAssign({{ $queue->id }})">Assign</button>
                                @endif
                            </td>
                            <td><span class="badge badge-{{ $queue->status }}">{{ ucfirst($queue->status) }}</span></td>
                            <td>
                                <div style="font-size:0.8rem;color:var(--dark);font-weight:500;">{{ $waitMins }}m</div>
                                <div style="font-size:0.7rem;color:var(--muted);">{{ $queue->created_at?->format('h:i A') }}</div>
                            </td>
                            <td>
                                <div class="action-group" style="justify-content:flex-end;">
                                    @if($queue->status === 'waiting')
                                    <form method="POST" action="{{ route('staff.queue.call', $queue->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-teal btn-sm">Call</button>
                                    </form>
                                    @endif
                                    @if($queue->status === 'called')
                                    <form method="POST" action="{{ route('staff.queue.serve', $queue->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-primary btn-sm">Serving</button>
                                    </form>
                                    @endif
                                    @if(in_array($queue->status, ['called','serving']))
                                    <form method="POST" action="{{ route('staff.queue.done', $queue->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-ghost btn-sm">Done</button>
                                    </form>
                                    @endif
                                    @if($queue->status !== 'done')
                                    <button class="btn btn-ghost btn-sm" onclick="openAssign({{ $queue->id }}, {{ $queue->doctor_id ?? 'null' }})">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7">
                            <div class="empty-state">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p>No priority patients in queue right now.</p>
                            </div>
                        </td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @if(isset($queues) && method_exists($queues, 'links'))
                <div class="pagination-bar">
                    <div class="pagination-info">Showing {{ $queues->firstItem() }}–{{ $queues->lastItem() }} of {{ $queues->total() }}</div>
                    <div>{{ $queues->links() }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="assignModal">
    <div class="modal">
        <div class="modal-header">
            <h3>Assign Doctor</h3>
            <button class="modal-close" onclick="document.getElementById('assignModal').classList.remove('open')">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" id="assignForm">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="modal-field">
                    <label>Select Doctor</label>
                    <select name="doctor_id" id="assignDoctorSelect">
                        <option value="">— Unassigned —</option>
                        @foreach ($doctors ?? [] as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost btn-sm" onclick="document.getElementById('assignModal').classList.remove('open')">Cancel</button>
                <button type="submit" class="btn btn-teal btn-sm">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('searchInput').addEventListener('input', applyFilters);
    function applyFilters() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        const s = document.getElementById('filterStatus').value;
        document.querySelectorAll('#queueTable tbody tr[data-name]').forEach(row => {
            row.style.display = (row.dataset.name.includes(q) && (!s || row.dataset.status === s)) ? '' : 'none';
        });
    }
    function openAssign(queueId, doctorId = null) {
        document.getElementById('assignForm').action = `/staff/queue/${queueId}/assign`;
        document.getElementById('assignDoctorSelect').value = doctorId ?? '';
        document.getElementById('assignModal').classList.add('open');
    }
    document.getElementById('assignModal').addEventListener('click', e => { if(e.target===document.getElementById('assignModal')) e.target.classList.remove('open'); });
</script>
</body>
</html>