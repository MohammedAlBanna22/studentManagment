@extends('app.layout')
@section('head')
    <title>Classes</title>
@endsection

@section('styles')
<style>
    :root {
        --bg: #0a0a0f;
        --surface: #111118;
        --surface2: #1a1a24;
        --border: rgba(255,255,255,0.07);
        --accent: #6c63ff;
        --accent2: #ff6584;
        --accent3: #43e97b;
        --text: #f0f0f8;
        --muted: #8888aa;
    }

    .page-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Page header */
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

    /* Search */
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

    /* Alert */
    .alert-success {
        padding: 0.6rem 1rem;
        background: rgba(67,233,123,0.08);
        border: 1px solid rgba(67,233,123,0.2);
        border-radius: 10px; color: var(--accent3);
        font-size: 0.85rem; margin-bottom: 1.25rem;
        display: flex; align-items: center; gap: 0.5rem;
        animation: fadeUp 0.4s ease both;
    }

    /* Table card */
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

    /* Teacher cell */
    .teacher-cell { display: flex; align-items: center; gap: 0.75rem; }
    .teacher-avatar {
        width: 42px; height: 42px; border-radius: 10px;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Syne', sans-serif; font-weight: 800;
        font-size: 0.85rem; color: #fff; overflow: hidden; flex-shrink: 0;
    }
    .teacher-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .teacher-cell .t-name { font-weight: 500; }
    .teacher-cell .t-id { font-size: 0.75rem; color: var(--muted); margin-top: 2px; }

    /* Email / phone */
    .t-email, .t-phone {
        font-size: 0.85rem; color: var(--muted);
        display: flex; align-items: center; gap: 0.4rem;
    }
    .t-email span, .t-phone span { color: var(--text); }

    /* Actions */
    .actions { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; justify-content: flex-end; /* aligns items to the right */}

    .profile-btn {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.35rem 0.75rem;
        background: rgba(67,233,123,0.08);
        border: 1px solid rgba(67,233,123,0.2);
        border-radius: 8px; color: var(--accent3);
        font-size: 0.78rem; font-weight: 600;
        text-decoration: none; transition: background 0.2s;
    }
    .profile-btn:hover { background: rgba(67,233,123,0.15); color: var(--accent3); }

    .edit-btn {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.35rem 0.75rem;
        background: rgba(108,99,255,0.1);
        border: 1px solid rgba(108,99,255,0.2);
        border-radius: 8px; color: var(--accent);
        font-size: 0.78rem; font-weight: 600;
        text-decoration: none; transition: background 0.2s;
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

    /* Empty state */
    .empty-state {
        text-align: center; padding: 3rem; color: var(--muted);
    }
    .empty-state svg { margin-bottom: 0.75rem; opacity: 0.3; }

    /* Pagination */
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
    .act{text-align: right;}

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">

    {{-- Success alert --}}
    @if(session('success'))
    <div class="alert-success">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1>Classes</h1>
            <p>{{ $classes->count() }}  Class total</p>
        </div>
        <a href="{{ route('SchoolClass.add') }}" class="add-btn">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add class
        </a>
    </div>

    {{-- Search --}}
    <form action="{{ route('SchoolClass.index') }}" method="GET">
        <div class="search-bar">
            <input type="text" name="search" placeholder="Search classes..."
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
                    <th>className</th>

                    <th class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $class)
                <tr>

                    <td>
                        <div class="teacher-cell">

                            <div>
                                <div class="t-name">{{ $class->name }}</div>

                            </div>
                        </div>
                    </td>



                    {{-- Actions --}}
                    <td>
                        <div class="actions">


                            {{-- Edit --}}
                            <a href="{{  route('SchoolClass.edit',$class->id) }}" class="edit-btn">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{  route('SchoolClass.delete', $class->id ) }}" method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this class?')">
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
                    <td colspan="4">
                        <div class="empty-state">
                            <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                            </svg>
                            <p style="font-size:0.95rem;font-weight:500;">No teachers found</p>
                            <p style="font-size:0.82rem;margin-top:0.3rem;">Try a different search or add a new class</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


       {{-- Pagination --}}
    <div class="pagination-wrapper">
        {{ $classes->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    </div>

@endsection

@section('scripts')
<script></script>
@endsection
