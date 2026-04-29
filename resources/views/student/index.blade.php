@extends('app.layout')
@section('head')
    <title>Students</title>
@endsection

@section('styles')
 <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans..." rel="stylesheet">
<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

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
        --card-shadow: 0 8px 40px rgba(0,0,0,0.5);
    }

    body {
        background: var(--bg);
        color: var(--text);
        font-family: 'Plus Jakarta Sans', sans-serif;
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

    .page-header p {
        color: var(--muted);
        font-size: 0.88rem;
        margin-top: 0.25rem;
    }

    .add-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.6rem 1.2rem;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        border: none;
        border-radius: 10px;
        color: #fff;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.2s;
    }
    .add-btn:hover { opacity: 0.9; transform: translateY(-1px); }

    /* Search bar */
    .search-bar {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        animation: fadeUp 0.4s ease 0.05s both;
    }

    .search-bar input {
        flex: 1;
        padding: 0.75rem 1rem;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        color: var(--text);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.9rem;
        outline: none;
        transition: border-color 0.2s;
    }
    .search-bar input::placeholder { color: var(--muted); }
    .search-bar input:focus { border-color: var(--accent); }

    .search-btn {
        padding: 0.75rem 1.2rem;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        color: var(--text);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .search-btn:hover { border-color: rgba(108,99,255,0.4); background: var(--surface2); }

    /* Alert */
    .alert-success {
        padding: 0.6rem 1rem;
        background: rgba(67,233,123,0.08);
        border: 1px solid rgba(67,233,123,0.2);
        border-radius: 10px;
        color: var(--accent3);
        font-size: 0.85rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        animation: fadeUp 0.4s ease both;
    }

    /* Table card */
    .table-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        animation: fadeUp 0.4s ease 0.1s both;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead tr {
        border-bottom: 1px solid var(--border);
    }

    th {
        padding: 1rem 1.25rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.07em;
        background: var(--surface);
    }

    td {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }

    tbody tr:last-child td { border-bottom: none; }

    tbody tr {
        transition: background 0.15s;
    }
    tbody tr:hover { background: var(--surface2); }

    /* Avatar */
    .student-avatar {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 0.85rem;
        color: #fff;
        overflow: hidden;
        flex-shrink: 0;
    }
    .student-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Student name cell */
    .student-name-cell {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .student-name-cell .s-name { font-weight: 500; }
    .student-name-cell .s-email { font-size: 0.78rem; color: var(--muted); margin-top: 2px; }

    /* Gender badge */
    .gender-badge {
        display: inline-flex;
        padding: 0.2rem 0.6rem;
        border-radius: 99px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .gender-male   { background: rgba(96,165,250,0.1); color: #60a5fa; border: 1px solid rgba(96,165,250,0.2); }
    .gender-female { background: rgba(244,114,182,0.1); color: #f472b6; border: 1px solid rgba(244,114,182,0.2); }

    /* Score badge */
    .score-badge {
        display: inline-flex;
        padding: 0.2rem 0.65rem;
        border-radius: 99px;
        font-size: 0.78rem;
        font-weight: 700;
        font-family: 'Syne', sans-serif;
    }
    .score-high { background: rgba(67,233,123,0.1);  color: var(--accent3); border: 1px solid rgba(67,233,123,0.2); }
    .score-mid  { background: rgba(247,151,30,0.1);  color: #f7971e;        border: 1px solid rgba(247,151,30,0.2); }
    .score-low  { background: rgba(255,101,132,0.1); color: var(--accent2); border: 1px solid rgba(255,101,132,0.2); }
    .score-none { background: rgba(255,255,255,0.05); color: var(--muted);  border: 1px solid var(--border); }

    /* Action buttons */
    .actions { display: flex; align-items: center; gap: 0.5rem; }

    .edit-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.35rem 0.75rem;
        background: rgba(108,99,255,0.1);
        border: 1px solid rgba(108,99,255,0.2);
        border-radius: 8px;
        color: var(--accent);
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }
    .edit-btn:hover { background: rgba(108,99,255,0.2); }

    .delete-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.35rem 0.75rem;
        background: rgba(255,101,132,0.1);
        border: 1px solid rgba(255,101,132,0.2);
        border-radius: 8px;
        color: var(--accent2);
        font-size: 0.78rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .delete-btn:hover { background: rgba(255,101,132,0.2); }

    /* Profile link */
    .profile-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.35rem 0.75rem;
        background: rgba(67,233,123,0.08);
        border: 1px solid rgba(67,233,123,0.2);
        border-radius: 8px;
        color: var(--accent3);
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }
    .profile-btn:hover { background: rgba(67,233,123,0.15); }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--muted);
    }
    .empty-state svg { margin-bottom: 0.75rem; opacity: 0.3; }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
        animation: fadeUp 0.4s ease 0.2s both;
    }

    /* Override Bootstrap pagination */
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
    .page-item.active .page-link {
        background: var(--accent) !important;
        border-color: var(--accent) !important;
        color: #fff !important;
    }
    .page-item.disabled .page-link { opacity: 0.4 !important; }

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

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h1>Students</h1>
            <p>{{ $students->total() }} students total</p>
        </div>
        <a href="{{ URL('student/add') }}" class="add-btn">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Student
        </a>
    </div>

    {{-- Search --}}
    <form action="{{ URL('student') }}" method="GET">
        <div class="search-bar">
            <input type="text" name="search" placeholder="Search students..."
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
                    <th>Student</th>
                    <th>Age</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Score</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    {{-- Student name + avatar --}}
                    <td>
                        <div class="student-name-cell">
                            <div class="student-avatar">
                                @if(count($student->images) > 0)
                                    <img src="{{ asset('storage/' . $student->images->first()->path) }}"
                                         alt="{{ $student->name }}">
                                @else
                                    {{ strtoupper(substr($student->name, 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <div class="s-name">{{ $student->name }}</div>
                                <div class="s-email">{{ $student->email }}</div>
                            </div>
                        </div>
                    </td>

                    <td>{{ $student->age ?? '—' }}</td>
                    <td>{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') : '—' }}</td>

                    {{-- Gender badge --}}
                    <td>
                        @if($student->gender)
                        <span class="gender-badge {{ $student->gender === 'male' ? 'gender-male' : 'gender-female' }}">
                            {{ ucfirst($student->gender) }}
                        </span>
                        @else
                            <span style="color:var(--muted)">—</span>
                        @endif
                    </td>

                    {{-- Score badge --}}
                    <td>
                        @php
                            $score = $student->score;
                            $scoreClass = is_null($score) ? 'score-none'
                                : ($score >= 85 ? 'score-high'
                                : ($score >= 60 ? 'score-mid' : 'score-low'));
                            $scoreLabel = is_null($score) ? '—' : $score;
                        @endphp
                        <span class="score-badge {{ $scoreClass }}">{{ $scoreLabel }}</span>
                    </td>

                    {{-- Actions --}}
                    <td>
                        <div class="actions">
                            {{-- Profile --}}
                            <a href="{{ route('student.profile', $student->id) }}" class="profile-btn">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                                </svg>
                                Profile
                            </a>

                            {{-- Edit --}}


                            @canany(['teacher-or-admin', 'updateStudents'], $student)
                            <a href="{{ URL('student/edit', $student->id) }}" class="edit-btn">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>

                            @endcanany


                            {{-- Delete --}}
                             @can('teacher-or-admin')
                            <form action="{{ URL('student/delete', $student->id) }}" method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Are you sure you want to delete this student?')">
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
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                            <p style="font-size:0.95rem;font-weight:500;">No students found</p>
                            <p style="font-size:0.82rem;margin-top:0.3rem;">Try a different search or add a new student</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper">
        {{ $students->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection


@section('scripts')
<script></script>
@endsection
