<x-medsyst title="Patient Records" subtitle="Manage Patients">

    <div class="page-header">
        <div>
            <h1>Patient Records</h1>
            <p>Register and manage patient information.</p>
        </div>
        <div class="header-actions">
            <button class="btn-primary" onclick="document.getElementById('add-patient-modal').style.display='flex'">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Register Patient
            </button>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">All Patients</span>
            <span style="font-size:0.8rem;color:var(--text-3);">{{ $patients->count() }} total</span>
        </div>
        <div style="overflow-x:auto;">
            @if($patients->count())
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Contact</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $index => $patient)
                    <tr>
                        <td style="color:var(--text-3);">{{ $index + 1 }}</td>
                        <td style="font-weight:600;">{{ $patient->name }}</td>
                        <td>{{ $patient->age ?? '—' }}</td>
                        <td style="color:var(--text-2);">{{ $patient->contact ?? '—' }}</td>
                        <td style="color:var(--text-3);">{{ $patient->created_at->format('M d, Y') }}</td>
                        <td style="display:flex;gap:8px;align-items:center;">
                            <a href="{{ route('patients.edit', $patient->id) }}" style="color:var(--teal);font-size:0.8rem;font-weight:600;text-decoration:none;">Edit</a>
                            <form method="POST" action="{{ route('patients.destroy', $patient->id) }}" onsubmit="return confirm('Delete this patient?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:none;border:none;cursor:pointer;color:var(--c-red);font-size:0.8rem;font-weight:600;font-family:inherit;">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <p>No patients registered yet.</p>
            </div>
            @endif
        </div>
    </div>

</x-medsyst>