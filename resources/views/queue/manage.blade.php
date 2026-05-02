<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MedSyst — Queue Management</title>
    @include('partials._styles')
    <style>
       
        .stat-strip { display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; margin-bottom: 1.5rem; }
        .stat-tile { background: var(--white); border: 1px solid var(--border); border-radius: 14px; padding: 1rem 1.25rem; display: flex; align-items: center; gap: 12px; }
        .stat-tile .tile-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .tile-icon svg { width: 16px; height: 16px; }
        .tile-icon.gray  { background: #f1f0ea; color: #5a5745; }
        .tile-icon.amber { background: var(--amber-bg); color: var(--amber-dark); }
        .tile-icon.teal  { background: var(--teal-bg);  color: var(--teal-dark); }
        .tile-icon.green { background: var(--green-bg); color: #2a5a11; }
        .stat-tile .tile-val { font-family: 'DM Serif Display', serif; font-size: 1.8rem; color: var(--dark); line-height: 1; }
        .stat-tile .tile-lbl { font-size: 0.72rem; color: var(--muted); margin-top: 2px; }

        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.45); z-index: 50; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .modal { background: var(--white); border-radius: 18px; width: 100%; max-width: 480px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); overflow: hidden; animation: slideUp .2s ease; }
        @keyframes slideUp { from{transform:translateY(16px);opacity:0} to{transform:translateY(0);opacity:1} }
        .modal-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .modal-header h3 { font-size: 1rem; font-weight: 600; color: var(--dark); }
        .modal-close { width: 28px; height: 28px; border-radius: 7px; border: none; background: var(--surface); cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--muted); }
        .modal-close:hover { background: var(--border); }
        .modal-close svg { width: 14px; height: 14px; }
        .modal-body { padding: 1.5rem; }
        .modal-field { margin-bottom: 1rem; }
        .modal-field label { display: block; font-size: 0.75rem; font-weight: 600; color: var(--mid); text-transform: uppercase; letter-spacing: .05em; margin-bottom: 5px; }
        .modal-field select, .modal-field input { width: 100%; padding: 10px 12px; border: 1.5px solid var(--border); border-radius: 10px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; color: var(--dark); background: var(--white); outline: none; }
        .modal-field select:focus, .modal-field input:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(46,157,145,.1); }
        .modal-field select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%238a8a8a' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 10px center; background-size: 13px; padding-right: 32px; }
        .modal-footer { display: flex; justify-content: flex-end; gap: 8px; padding: 1rem 1.5rem; border-top: 1px solid var(--border); background: var(--surface); }

        
        tr.row-critical td:first-child { border-left: 3px solid var(--red); }
        tr.row-urgent   td:first-child { border-left: 3px solid var(--amber); }
        tr.row-normal   td:first-child { border-left: 3px solid var(--teal); }
    </style>
</head>
<body>
<div class="shell">
    @include('partials._staff_sidebar', ['active' => 'queue.manage'])

    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <div class="topbar-title">
                    <h1>Queue Management</h1>
                    <span>All queues · assign doctors · update status</span>
                </div>
            </div>
            <div class="topbar-right">
                <span class="live-label"><span class="live-dot"></span> Live</span>
                <a href="{{ route('staff.emergency.create') }}" class="btn btn-danger btn-sm">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                    Emergency
                </a>
               
            </div>
        </header>

        <div class="content">

            {{-- Flash messages --}}
            @if(session('success'))
            <div style="background:var(--green-bg);border:1px solid #c0dd97;border-radius:10px;padding:10px 16px;margin-bottom:1.25rem;font-size:0.82rem;color:#2a5a11;">
                {{ session('success') }}
            </div>
            @endif

            {{-- Stat strip --}}
            <div class="stat-strip">
                <div class="stat-tile">
                    <div class="tile-icon gray"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                    <div><div class="tile-val">{{ $stats['waiting'] ?? 0 }}</div><div class="tile-lbl">Waiting</div></div>
                </div>
                <div class="stat-tile">
                    <div class="tile-icon amber"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg></div>
                    <div><div class="tile-val">{{ $stats['called'] ?? 0 }}</div><div class="tile-lbl">Called</div></div>
                </div>
                <div class="stat-tile">
                    <div class="tile-icon teal"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
                    <div><div class="tile-val">{{ $stats['serving'] ?? 0 }}</div><div class="tile-lbl">In Consultation</div></div>
                </div>
                <div class="stat-tile">
                    <div class="tile-icon green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                    <div><div class="tile-val">{{ $stats['done'] ?? 0 }}</div><div class="tile-lbl">Done Today</div></div>
                </div>
            </div>

            {{-- Main table --}}
            <div class="table-card">
                <div class="table-toolbar">
                    <div class="search-wrap">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" id="searchInput" placeholder="Search patient name or queue #...">
                    </div>
                    <div class="filter-group">
                        <select class="filter-select" id="filterPriority" onchange="applyFilters()">
                            <option value="">All priorities</option>
                            <option value="critical">Critical</option>
                            <option value="urgent">Urgent</option>
                            <option value="normal">Normal</option>
                        </select>
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
                                <th style="width:50px;">#</th>
                                <th>Patient</th>
                                <th>Priority</th>
                                <th>Condition</th>
                                <th>Doctor Assigned</th>
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
                            $avatarClass = $queue->priority === 'critical' ? 'red' : ($queue->priority === 'urgent' ? 'amber' : 'teal');
                            $rowClass = 'row-' . ($queue->priority === 'critical' ? 'critical' : ($queue->priority === 'urgent' ? 'urgent' : 'normal'));
                            $waitMins = $queue->created_at ? now()->diffInMinutes($queue->created_at) : 0;
                            $fullName = ($patient->first_name ?? 'Unknown') . ' ' . ($patient->last_name ?? 'Walk-in');
                        @endphp
                        <tr class="{{ $rowClass }}" data-priority="{{ $queue->priority }}" data-status="{{ $queue->status }}" data-name="{{ strtolower($fullName) }}">
                            <td><span class="q-num">{{ $queue->queue_number }}</span></td>
                            <td>
                                <div class="patient-cell">
                                    <div class="pt-avatar {{ $avatarClass }}">{{ $initials }}</div>
                                    <div>
                                        <div class="pt-name">{{ $fullName }}</div>
                                        <div class="pt-sub">{{ $patient->age ?? '—' }} yrs · {{ $patient->gender ?? '—' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge badge-{{ $queue->priority }}">{{ ucfirst($queue->priority) }}</span></td>
                            <td style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $patient->condition ?? '' }}">{{ Str::limit($patient->condition ?? 'N/A', 35) }}</td>
                            <td>
                                @if($queue->doctor)
                                    <span style="font-size:0.82rem;font-weight:500;">{{ $queue->doctor->name }}</span>
                                @else
                                    <span style="font-size:0.78rem;color:var(--muted);font-style:italic;">Unassigned</span>
                                @endif
                            </td>
                            <td><span class="badge badge-{{ $queue->status }}">{{ ucfirst($queue->status) }}</span></td>
                            <td style="font-size:0.8rem;color:var(--muted);">
                                {{ $queue->status === 'done' ? '—' : $waitMins . 'm' }}
                            </td>
                            <td>
                                <div class="action-group" style="justify-content:flex-end;">
                                    {{-- Call button (sets status to called) --}}
                                    @if($queue->status === 'waiting')
                                    <form method="POST" action="{{ route('staff.queue.call', $queue->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-teal btn-sm">
                                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                            Call
                                        </button>
                                    </form>
                                    @endif
                                    {{-- Serve --}}
                                    @if($queue->status === 'called')
                                    <form method="POST" action="{{ route('staff.queue.serve', $queue->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-primary btn-sm">Serving</button>
                                    </form>
                                    @endif
                                    {{-- Done --}}
                                    @if(in_array($queue->status, ['called','serving']))
                                    <form method="POST" action="{{ route('staff.queue.done', $queue->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-ghost btn-sm">Done</button>
                                    </form>
                                    @endif
                                    {{-- Assign doctor --}}
                                    @if($queue->status !== 'done')
                                    <button class="btn btn-ghost btn-sm" onclick="openAssign({{ $queue->id }}, {{ $queue->doctor_id ?? 'null' }})">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Assign
                                    </button>
                                    @endif
                                    {{-- Move priority --}}
                                    <button class="btn btn-ghost btn-sm" onclick="openMove({{ $queue->id }}, '{{ $queue->priority }}')">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <p>No patients in the queue right now.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if(isset($queues) && method_exists($queues, 'links'))
                <div class="pagination-bar">
                    <div class="pagination-info">Showing {{ $queues->firstItem() }}–{{ $queues->lastItem() }} of {{ $queues->total() }} patients</div>
                    <div>{{ $queues->links() }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ── Assign Doctor Modal ── --}}
<div class="modal-overlay" id="assignModal">
    <div class="modal">
        <div class="modal-header">
            <h3>Assign Doctor</h3>
            <button class="modal-close" onclick="closeModal('assignModal')">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" id="assignForm" action="">
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
                <button type="button" class="btn btn-ghost btn-sm" onclick="closeModal('assignModal')">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">Save Assignment</button>
            </div>
        </form>
    </div>
</div>

{{-- ── Move Priority Modal ── --}}
<div class="modal-overlay" id="moveModal">
    <div class="modal">
        <div class="modal-header">
            <h3>Change Queue Priority</h3>
            <button class="modal-close" onclick="closeModal('moveModal')">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form method="POST" id="moveForm" action="">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="modal-field">
                    <label>New Priority Level</label>
                    <select name="priority" id="movePrioritySelect">
                        <option value="critical">🔴 Critical — Life-threatening, skip queue</option>
                        <option value="urgent">🟡 Urgent — Senior / pregnant / fast care</option>
                        <option value="normal">🟢 Normal — Stable, regular queue</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost btn-sm" onclick="closeModal('moveModal')">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">Update Priority</button>
            </div>
        </form>
    </div>
</div>

<script>
   
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', applyFilters);
    function applyFilters() {
        const q  = searchInput.value.toLowerCase();
        const p  = document.getElementById('filterPriority').value;
        const s  = document.getElementById('filterStatus').value;
        document.querySelectorAll('#queueTable tbody tr[data-name]').forEach(row => {
            const matchName = row.dataset.name.includes(q);
            const matchP = !p || row.dataset.priority === p;
            const matchS = !s || row.dataset.status === s;
            row.style.display = (matchName && matchP && matchS) ? '' : 'none';
        });
    }

   
    function openAssign(queueId, currentDoctorId) {
        document.getElementById('assignForm').action = `/staff/queue/${queueId}/assign`;
        const sel = document.getElementById('assignDoctorSelect');
        sel.value = currentDoctorId ?? '';
        document.getElementById('assignModal').classList.add('open');
    }

   
    function openMove(queueId, currentPriority) {
        document.getElementById('moveForm').action = `/staff/queue/${queueId}/priority`;
        document.getElementById('movePrioritySelect').value = currentPriority;
        document.getElementById('moveModal').classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', e => { if (e.target === overlay) overlay.classList.remove('open'); });
    });
</script>
</body>
</html>