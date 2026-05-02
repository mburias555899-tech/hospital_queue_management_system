<x-medsyst title="Queue" subtitle="Manage Queue">

    <div class="page-header">
        <div>
            <h1>Queue</h1>
            <p>Monitor and manage the patient queue.</p>
        </div>
        <div class="header-actions">
            <form method="POST" action="{{ route('queue.callNext') }}">
                @csrf
                <button type="submit" class="btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/>
                    </svg>
                    Call Next Patient
                </button>
            </form>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Current Queue</span>
            <span style="font-size:0.8rem;color:var(--text-3);">{{ $queues->count() }} in queue</span>
        </div>
        <div style="overflow-x:auto;">
            @if($queues->count())
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Queue #</th>
                        <th>Patient</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($queues as $queue)
                    <tr>
                        <td style="font-weight:700;color:var(--teal);">{{ $queue->queue_number ?? $loop->iteration }}</td>
                        <td style="font-weight:600;">{{ $queue->patient->name ?? 'N/A' }}</td>
                        <td><span class="badge badge-{{ $queue->priority }}">{{ ucfirst($queue->priority) }}</span></td>
                        <td><span class="badge badge-{{ $queue->status }}">{{ ucfirst($queue->status) }}</span></td>
                        <td style="color:var(--text-3);">{{ $queue->created_at->format('h:i A') }}</td>
                        <td>
                            @if($queue->status !== 'done')
                            <form method="POST" action="{{ route('queue.done', $queue->id) }}">
                                @csrf
                                <button type="submit" style="background:none;border:none;cursor:pointer;color:var(--c-green);font-size:0.8rem;font-weight:600;font-family:inherit;">
                                    Mark Done
                                </button>
                            </form>
                            @else
                            <span style="font-size:0.8rem;color:var(--text-3);">Completed</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/>
                    <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
                <p>No patients in the queue right now.</p>
            </div>
            @endif
        </div>
    </div>

</x-medsyst>