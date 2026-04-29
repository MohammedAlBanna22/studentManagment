@extends('app.layout')
@section('head')
    <title>Subjects</title>
@endsection

@section('styles')
<style>
    .page-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        animation: fadeUp 0.4s ease both;
    }
    .page-header h1 {
        font-family: 'Syne', sans-serif;
        font-size: 1.8rem;
        font-weight: 800;
        letter-spacing: -0.02em;
    }
    .page-header p { color: var(--muted); font-size: 0.88rem; margin-top: 0.25rem; }

    .add-btn {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.6rem 1.2rem;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        border: none; border-radius: 10px; color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem; font-weight: 600;
        text-decoration: none; cursor: pointer;
        transition: opacity 0.2s, transform 0.2s;
    }
    .add-btn:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }

    .search-bar {
        display: flex; gap: 0.75rem;
        margin-bottom: 1.5rem;
        animation: fadeUp 0.4s ease 0.05s both;
    }
    .search-bar input {
        flex: 1; padding: 0.75rem 1rem;
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 12px; color: var(--text);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.9rem; outline: none; transition: border-color 0.2s;
    }
    .search-bar input::placeholder { color: var(--muted); }
    .search-bar input:focus { border-color: var(--accent); }
    .search-btn {
        padding: 0.75rem 1.2rem;
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 12px; color: var(--text);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem; cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        display: inline-flex; align-items: center; gap: 0.4rem;
    }
    .search-btn:hover { border-color: rgba(108,99,255,0.4); background: var(--surface2); }

    .alert-success {
        padding: 0.6rem 1rem;
        background: rgba(67,233,123,0.08);
        border: 1px solid rgba(67,233,123,0.2);
        border-radius: 10px; color: var(--accent3);
        font-size: 0.85rem; margin-bottom: 1.25rem;
        display: flex; align-items: center; gap: 0.5rem;
        animation: fadeUp 0.4s ease both;
    }
    .alert-info-box {
        padding: 0.6rem 1rem;
        background: rgba(108,99,255,0.08);
        border: 1px solid rgba(108,99,255,0.2);
        border-radius: 10px; color: var(--accent);
        font-size: 0.85rem; margin-bottom: 1.25rem;
        display: flex; align-items: center; gap: 0.5rem;
        animation: fadeUp 0.4s ease both;
    }

    .table-card {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 8px 40px rgba(0,0,0,0.5);
        animation: fadeUp 0.4s ease 0.1s both;
    }

    table { width: 100%; border-collapse: collapse; }
    thead tr { border-bottom: 1px solid var(--border); }
    th {
        padding: 1rem 1.25rem; text-align: left;
        font-size: 0.75rem; font-weight: 600;
        color: var(--muted); text-transform: uppercase;
        letter-spacing: 0.07em; background: var(--surface);
    }
    td {
        padding: 1rem 1.25rem; font-size: 0.9rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr { transition: background 0.15s; }
    tbody tr:hover { background: var(--surface2); }

    .subject-cell { display: flex; align-items: center; gap: 0.75rem; }
    .subject-avatar {
        width: 42px; height: 42px; border-radius: 10px;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne', sans-serif; font-weight: 800;
        font-size: 0.85rem; color: #fff; flex-shrink: 0;
    }
    .subject-cell .s-name { font-weight: 500; }

    .actions {
        display: flex; align-items: center; gap: 0.5rem;
        flex-wrap: wrap; justify-content: flex-end;
    }

    .edit-btn {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.35rem 0.75rem;
        background: rgba(108,99,255,0.1);
        border: 1px solid rgba(108,99,255,0.2);
        border-radius: 8px; color: var(--accent);
        font-size: 0.78rem; font-weight: 600;
        cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif;
        transition: background 0.2s;
    }
    .edit-btn:hover { background: rgba(108,99,255,0.2); color: var(--accent); }

    .delete-btn {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.35rem 0.75rem;
        background: rgba(255,101,132,0.1);
        border: 1px solid rgba(255,101,132,0.2);
        border-radius: 8px; color: var(--accent2);
        font-size: 0.78rem; font-weight: 600;
        cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif;
        transition: background 0.2s;
    }
    .delete-btn:hover { background: rgba(255,101,132,0.2); }

    .empty-state {
        text-align: center; padding: 3rem; color: var(--muted);
    }
    .empty-state svg { margin-bottom: 0.75rem; opacity: 0.3; }

    .pagination-wrapper {
        margin-top: 1.5rem;
        display: flex; justify-content: center;
        animation: fadeUp 0.4s ease 0.2s both;
    }
    .pagination { gap: 0.3rem; }
    .page-link {
        background: var(--surface) !important;
        border: 1px solid var(--border) !important;
        color: var(--muted) !important;
        border-radius: 8px !important;
        padding: 0.4rem 0.75rem !important;
        font-size: 0.85rem !important;
        transition: all 0.2s !important;
    }
    .page-link:hover { border-color: var(--accent) !important; color: var(--accent) !important; }
    .page-item.active .page-link { background: var(--accent) !important; border-color: var(--accent) !important; color: #fff !important; }
    .page-item.disabled .page-link { opacity: 0.4 !important; }

    /* Modal */
    .modal-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(4px);
        z-index: 500;
        align-items: center; justify-content: center;
    }
    .modal-overlay.active { display: flex; }
    .modal-box {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px; padding: 2rem;
        width: 100%; max-width: 440px;
        animation: fadeUp 0.3s ease both;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }
    .modal-box h2 {
        font-family: 'Syne', sans-serif;
        font-size: 1.3rem; font-weight: 800; margin-bottom: 0.25rem;
    }
    .modal-box p { color: var(--muted); font-size: 0.85rem; margin-bottom: 1.5rem; }

    .form-group { margin-bottom: 1.25rem; }
    .form-group label {
        display: block; font-size: 0.82rem; font-weight: 600;
        color: var(--muted); margin-bottom: 0.5rem;
        text-transform: uppercase; letter-spacing: 0.05em;
    }
    .form-group input {
        width: 100%; padding: 0.75rem 1rem;
        background: var(--surface2); border: 1px solid var(--border);
        border-radius: 12px; color: var(--text);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.9rem; outline: none; transition: border-color 0.2s;
    }
    .form-group input::placeholder { color: var(--muted); }
    .form-group input:focus { border-color: var(--accent); }
    .error-msg { color: var(--accent2); font-size: 0.78rem; margin-top: 0.4rem; }

    .modal-actions {
        display: flex; gap: 0.75rem; justify-content: flex-end; margin-top: 1.5rem;
    }
    .cancel-btn {
        padding: 0.6rem 1.2rem;
        background: var(--surface2); border: 1px solid var(--border);
        border-radius: 10px; color: var(--muted);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem; font-weight: 600;
        cursor: pointer; transition: background 0.2s;
    }
    .cancel-btn:hover { background: var(--border); }
    .submit-btn {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.6rem 1.2rem;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        border: none; border-radius: 10px; color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem; font-weight: 600;
        cursor: pointer; transition: opacity 0.2s, transform 0.2s;
    }
    .submit-btn:hover { opacity: 0.9; transform: translateY(-1px); }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }


    .alert-error {
    padding: 0.6rem 1rem;
    background: rgba(239,68,68,0.08);
    border: 1px solid rgba(239,68,68,0.3);
    border-radius: 10px;
    color: #ef4444;
    font-size: 0.85rem;
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    animation: fadeUp 0.4s ease both;
}
</style>
@endsection

@section('content')
<div class="page-wrapper">

    {{-- Alerts --}}
    @if(session('success'))
    <div class="alert-success">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('info'))
    <div class="alert-info-box">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
        </svg>
        {{ session('info') }}
    </div>
    @endif

@if(session('error'))
<div class="alert-error">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"/>
        <path d="M15 9l-6 6M9 9l6 6"/>
    </svg>
    {{ session('error') }}
</div>
@endif



    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1>Subjects</h1>
            <p>{{ $subjects->count() }} subjects total</p>
        </div>
        <button class="add-btn" onclick="openModal('addModal')">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Subject
        </button>
    </div>

    {{-- Search --}}
    <form action="{{ route('subjects.index') }}" method="GET">
        <div class="search-bar">
            <input type="text" name="search" placeholder="Search subjects..."
                   value="{{ request('search') }}">
            <button type="submit" class="search-btn">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                </svg>
                Search
            </button>
        </div>
    </form>

    {{-- Table --}}
    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                <tr>
                    <td>
                        <div class="subject-cell">
                            <div class="subject-avatar">
                                {{ strtoupper(substr($subject->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="s-name">{{ $subject->name }}</div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="actions">

                            {{-- Edit --}}
                            <button class="edit-btn"
                                onclick="openEditModal({{ $subject->id }}, '{{ addslashes($subject->name) }}')">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </button>

                            {{-- Delete --}}
                            <form action="{{ route('subject.delete', $subject->id) }}" method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this subject?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                                        <path d="M10 11v6M14 11v6"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">
                        <div class="empty-state">
                            <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                            <p style="font-size:0.95rem;font-weight:500;">No subjects found</p>
                            <p style="font-size:0.82rem;margin-top:0.3rem;">Try a different search or add a new subject</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper">
        {{ $subjects->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>

{{-- ─── ADD MODAL ─── --}}
<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <h2>Add Subject</h2>
        <p>Enter the name of the new subject.</p>
        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Subject Name</label>
                <input type="text" name="name" placeholder="e.g. Mathematics"
                       value="{{ old('name') }}" autofocus>
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
            <div class="modal-actions">
                <button type="button" class="cancel-btn" onclick="closeModal('addModal')">Cancel</button>
                <button type="submit" class="submit-btn">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Add Subject
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ─── EDIT MODAL ─── --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <h2>Edit Subject</h2>
        <p>Update the subject name below.</p>
        <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Subject Name</label>
                <input type="text" name="name" id="editInput" placeholder="e.g. Mathematics">
            </div>
            <div class="modal-actions">
                <button type="button" class="cancel-btn" onclick="closeModal('editModal')">Cancel</button>
                <button type="submit" class="submit-btn">
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.add('active');
    }
    function closeModal(id) {
        document.getElementById(id).classList.remove('active');
    }


function openEditModal(id, name) {
    document.getElementById('editInput').value = name;
    document.getElementById('editForm').action = '/subject/update/' + id;
    openModal('editModal');
}




    // Close on overlay click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        });
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.active').forEach(m => {
                closeModal(m.id);
            });
        }
    });

    // Re-open modal on validation error
    @if($errors->any() && old('_method') === null)
        openModal('addModal');
    @endif

   @if($errors->any() && old('_method') === 'PUT')
    openEditModal('{{ old("name") }}', '{{ route("subject.update", old("id")) }}');
@endif
</script>
@endsection
