<x-medsyst title="Users" subtitle="Manage Accounts">

@if(session('success'))
<div id="toast" style="
    position:fixed; top:1.5rem; right:1.5rem; z-index:9999;
    background:#0f6e56; color:#fff;
    padding:0.75rem 1.25rem; border-radius:12px;
    font-size:0.875rem; font-weight:600;
    box-shadow:0 8px 24px rgba(0,0,0,0.15);
    display:flex; align-items:center; gap:8px;
    animation: fadeUp 0.3s ease both;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    {{ session('success') }}
</div>
<script>setTimeout(() => { const t = document.getElementById('toast'); if(t) t.style.opacity='0'; }, 3000);</script>
@endif

<div class="page-header">
    <div>
        <h1>Users</h1>
        <p>Manage system accounts and roles.</p>
    </div>
    <div class="header-actions">
        <button class="btn-primary" onclick="openModal('create-modal')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Add User
        </button>
    </div>
</div>

{{-- Users Table --}}
<div class="panel">
    <div class="panel-header">
        <span class="panel-title">All Users</span>
        <span style="font-size:0.8rem;color:var(--text-3);">{{ $users->count() }} total</span>
    </div>
    <div style="overflow-x:auto;">
        @if($users->count())
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td style="color:var(--text-3);">{{ $index + 1 }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:32px;height:32px;border-radius:50%;background:var(--teal);display:flex;align-items:center;justify-content:center;font-size:0.72rem;font-weight:700;color:#fff;flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <span style="font-weight:600;">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td style="color:var(--text-2);">{{ $user->email }}</td>
                    <td><span class="badge badge-{{ $user->role }}">{{ ucfirst($user->role) }}</span></td>
                    <td style="color:var(--text-3);">{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <button onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', '{{ $user->role }}')"
                                style="background:none;border:none;cursor:pointer;color:var(--teal);font-size:0.8rem;font-weight:600;font-family:inherit;display:flex;align-items:center;gap:4px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </button>
                            <button onclick="openDeleteModal({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                style="background:none;border:none;cursor:pointer;color:var(--c-red);font-size:0.8rem;font-weight:600;font-family:inherit;display:flex;align-items:center;gap:4px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
            </svg>
            <p>No users found. Add your first user.</p>
        </div>
        @endif
    </div>
</div>


{{-- ─── CREATE MODAL ─── --}}
<div id="create-modal" class="modal-overlay" onclick="closeOnOverlay(event,'create-modal')">
    <div class="modal-box">
        <div class="modal-header">
            <div>
                <div class="modal-title">Add New User</div>
                <div class="modal-sub">Fill in the details to create an account.</div>
            </div>
            <button class="modal-close" onclick="closeModal('create-modal')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" placeholder="e.g. Julia Burias" required value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="e.g. julia@medsyst.com" required value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="create-pw" class="form-input" placeholder="Min. 8 characters" required style="padding-right:2.5rem;">
                        <button type="button" onclick="togglePw('create-pw','create-eye')" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-3);">
                            <svg id="create-eye" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-input" required>
                        <option value="" disabled selected>Select a role</option>
                        <option value="admin">Admin</option>
                        <option value="nurse">Nurse</option>
                        <option value="receptionist">Receptionist</option>
                        <option value="doctor">Doctor</option>
                    </select>
                </div>
                @if($errors->any())
                <div style="background:var(--c-red-bg);border:1px solid #fecaca;border-radius:10px;padding:0.75rem 1rem;font-size:0.8rem;color:var(--c-red);">
                    <ul style="margin:0;padding-left:1rem;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline" onclick="closeModal('create-modal')">Cancel</button>
                <button type="submit" class="btn-primary">Create User</button>
            </div>
        </form>
    </div>
</div>


{{-- ─── EDIT MODAL ─── --}}
<div id="edit-modal" class="modal-overlay" onclick="closeOnOverlay(event,'edit-modal')">
    <div class="modal-box">
        <div class="modal-header">
            <div>
                <div class="modal-title">Edit User</div>
                <div class="modal-sub">Update the user's information.</div>
            </div>
            <button class="modal-close" onclick="closeModal('edit-modal')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <form method="POST" id="edit-form" action="">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" id="edit-name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" id="edit-email" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">New Password <span style="color:var(--text-3);font-weight:400;">(leave blank to keep current)</span></label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="edit-pw" class="form-input" placeholder="Leave blank to keep current" style="padding-right:2.5rem;">
                        <button type="button" onclick="togglePw('edit-pw','edit-eye')" style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-3);">
                            <svg id="edit-eye" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select name="role" id="edit-role" class="form-input" required>
                        <option value="admin">Admin</option>
                        <option value="nurse">Nurse</option>
                        <option value="receptionist">Receptionist</option>
                        <option value="doctor">Doctor</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline" onclick="closeModal('edit-modal')">Cancel</button>
                <button type="submit" class="btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>


{{-- ─── DELETE MODAL ─── --}}
<div id="delete-modal" class="modal-overlay" onclick="closeOnOverlay(event,'delete-modal')">
    <div class="modal-box" style="max-width:420px;">
        <div class="modal-header">
            <div>
                <div class="modal-title" style="color:var(--c-red);">Delete User</div>
                <div class="modal-sub">This action cannot be undone.</div>
            </div>
            <button class="modal-close" onclick="closeModal('delete-modal')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div style="display:flex;align-items:flex-start;gap:1rem;padding:1rem;background:var(--c-red-bg);border-radius:12px;border:1px solid #fecaca;">
                <div style="width:40px;height:40px;background:#fee2e2;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--c-red)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <p style="font-size:0.875rem;color:var(--c-red);line-height:1.6;">
                    Are you sure you want to delete <strong id="delete-name"></strong>? This will permanently remove their account.
                </p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-outline" onclick="closeModal('delete-modal')">Cancel</button>
            <form id="delete-form" method="POST" action="">
                @csrf @method('DELETE')
                <button type="submit" style="display:inline-flex;align-items:center;gap:8px;padding:0.7rem 1.4rem;background:var(--c-red);color:#fff;border:none;border-radius:50px;font-family:inherit;font-size:0.875rem;font-weight:600;cursor:pointer;">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>


@push('styles')
<style>
    .modal-overlay {
        display:none; position:fixed; inset:0;
        background:rgba(0,0,0,0.45); z-index:1000;
        align-items:center; justify-content:center;
        padding:1rem; backdrop-filter:blur(3px);
    }
    .modal-box {
        background:var(--white); border-radius:20px;
        width:100%; max-width:500px;
        box-shadow:0 24px 60px rgba(0,0,0,0.2);
        animation:fadeUp 0.25s ease both; overflow:hidden;
    }
    .modal-header { display:flex; align-items:flex-start; justify-content:space-between; padding:1.5rem 1.5rem 0; }
    .modal-title { font-family:'DM Serif Display',serif; font-size:1.25rem; color:var(--text-1); }
    .modal-sub { font-size:0.8rem; color:var(--text-3); margin-top:2px; }
    .modal-close { background:none; border:none; cursor:pointer; color:var(--text-3); padding:4px; border-radius:6px; transition:color 0.15s,background 0.15s; }
    .modal-close:hover { background:#f3f4f6; color:var(--text-1); }
    .modal-body { padding:1.5rem; display:flex; flex-direction:column; gap:1rem; }
    .modal-footer { padding:1rem 1.5rem 1.5rem; display:flex; justify-content:flex-end; gap:0.75rem; border-top:1px solid var(--border); }
    .form-group { display:flex; flex-direction:column; gap:6px; }
    .form-label { font-size:0.8rem; font-weight:600; color:var(--text-2); }
    .form-input { padding:0.65rem 0.9rem; border:1.5px solid var(--border); border-radius:10px; font-size:0.875rem; font-family:'Plus Jakarta Sans',sans-serif; color:var(--text-1); background:var(--white); outline:none; transition:border-color 0.15s,box-shadow 0.15s; width:100%; }
    .form-input:focus { border-color:var(--teal); box-shadow:0 0 0 3px rgba(29,158,117,0.1); }
    select.form-input { appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238fa89f' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 0.9rem center; padding-right:2.5rem; }
</style>
@endpush

@push('scripts')
<script>
    function openModal(id) { document.getElementById(id).style.display='flex'; document.body.style.overflow='hidden'; }
    function closeModal(id) { document.getElementById(id).style.display='none'; document.body.style.overflow=''; }
    function closeOnOverlay(e, id) { if(e.target===document.getElementById(id)) closeModal(id); }

    function openEditModal(id, name, email, role) {
        document.getElementById('edit-name').value  = name;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-role').value  = role;
        document.getElementById('edit-pw').value    = '';
        document.getElementById('edit-form').action = '/users/' + id;
        openModal('edit-modal');
    }

    function openDeleteModal(id, name) {
        document.getElementById('delete-name').textContent = name;
        document.getElementById('delete-form').action = '/users/' + id;
        openModal('delete-modal');
    }

    function togglePw(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;
        } else {
            input.type = 'password';
            icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        }
    }

    @if($errors->any())
        openModal('create-modal');
    @endif
</script>
@endpush

</x-medsyst>