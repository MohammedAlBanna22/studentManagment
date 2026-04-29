{{-- resources/views/teacher/request/index.blade.php --}}
@extends('app.layout')

@section('head')
<title>My Requests — SchoolMS</title>
@endsection

@section('styles')
<style>
.page-wrap   { max-width: 900px; margin: 2rem auto; padding: 0 1.5rem 4rem; }
.page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
.page-header h1 { font-size: 1.6rem; font-weight: 800; letter-spacing: -.02em; color: var(--text); margin: 0; }
.page-header p  { font-size: .9rem; color: var(--muted); margin: .2rem 0 0; }

.btn-primary {
    padding: .65rem 1.5rem; background: var(--accent); color: #fff;
    border: none; border-radius: 12px; font-size: .875rem; font-weight: 600;
    cursor: pointer; transition: all .2s; font-family: inherit; text-decoration: none;
    display: inline-flex; align-items: center; gap: 7px;
}
.btn-primary:hover { background: #5a52e0; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(108,99,255,.35); color: #fff; }

/* request card */
.req-list { display: flex; flex-direction: column; gap: 1rem; }
.req-card {
    background: var(--surface); border: 1px solid var(--border); border-radius: 16px;
    padding: 1.25rem 1.5rem; transition: border-color .2s;
}
.req-card:hover { border-color: rgba(108,99,255,.3); }
.req-card-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; flex-wrap: wrap; margin-bottom: 1rem; }
.req-card-meta { font-size: .75rem; color: var(--muted); margin-top: .2rem; }

/* status badge */
.badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: .3rem .8rem; border-radius: 999px;
    font-size: .73rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em;
    flex-shrink: 0;
}
.badge-pending  { background: rgba(245,158,11,.12); color: #f59e0b; }
.badge-approved { background: rgba(67,233,123,.12); color: #22c55e; }
.badge-declined { background: rgba(255,101,132,.12); color: var(--accent2); }
.badge-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

/* subjects row */
.tag {
    display: inline-block; padding: .25rem .65rem;
    background: rgba(108,99,255,.1); color: var(--accent);
    border-radius: 999px; font-size: .75rem; font-weight: 600;
    margin: .2rem;
}

/* availability grid */
.avail-grid { display: flex; flex-wrap: wrap; gap: .5rem; margin-top: .75rem; }
.avail-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: .3rem .8rem; border-radius: 8px;
    border: 1px solid var(--border); font-size: .78rem; font-weight: 600; color: var(--muted);
    background: var(--surface2);
}
.avail-pill .p-dot { width: 7px; height: 7px; border-radius: 50%; }

/* empty state */
.empty { text-align: center; padding: 4rem 2rem; }
.empty-icon { width: 56px; height: 56px; border-radius: 16px; background: rgba(108,99,255,.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
.empty h3 { font-size: 1.05rem; font-weight: 700; color: var(--text); margin-bottom: .4rem; }
.empty p  { font-size: .875rem; color: var(--muted); max-width: 320px; margin: 0 auto 1.5rem; line-height: 1.6; }
</style>
@endsection

@section('content')
<div class="page-wrap">

    <div class="page-header">
        <div>
            <h1>My Teaching Requests</h1>
            <p>Track the status of your submitted requests.</p>
        </div>
        <a href="{{ route('requests.create') }}" class="btn-primary">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Request
        </a>
    </div>

    @if(session('success'))
    <div style="background:rgba(67,233,123,.1);border:1px solid rgba(67,233,123,.25);border-radius:12px;padding:.875rem 1.1rem;margin-bottom:1.5rem;font-size:.875rem;color:#22c55e;font-weight:600;">
        ✓ {{ session('success') }}
    </div>
    @endif

    @if($requests->isEmpty())
    <div class="empty">
        <div class="empty-icon">
            <svg width="22" height="22" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
        </div>
        <h3>No requests yet</h3>
        <p>Submit your first teaching request and the admin will assign you a schedule.</p>
        <a href="{{ route('requests.create') }}" class="btn-primary">Create Request</a>
    </div>
    @else
    <div class="req-list">
        @foreach($requests as $req)
        <div class="req-card">
            <div class="req-card-top">
                <div>
                    <div style="font-size:.95rem;font-weight:700;color:var(--text);">
                        Request #{{ $req->id }}
                    </div>
                    <div class="req-card-meta">
                        Submitted {{ $req->created_at->diffForHumans() }}
                        @if($req->notes) · "{{ Str::limit($req->notes, 60) }}" @endif
                    </div>
                </div>
                <span class="badge badge-{{ $req->status }}">
                    <span class="badge-dot"></span>
                    {{ ucfirst($req->status) }}
                </span>
            </div>

            {{-- Subjects --}}
            <div style="margin-bottom:.6rem;">
                <span style="font-size:.72rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;">Subjects</span><br>
                @foreach($req->subjects as $s)
                    <span class="tag">{{ $s->name }}</span>
                @endforeach
            </div>

            {{-- Availability --}}
            <div>
                <span style="font-size:.72rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;">Availability</span>
                <div class="avail-grid">
                    @foreach($req->availability as $av)
                    <span class="avail-pill">
                        <span class="p-dot" style="background:
                            {{ $av->period === 'A' ? '#6c63ff' : ($av->period === 'B' ? '#43e97b' : '#f59e0b') }}">
                        </span>
                        {{ strtoupper($av->day) }} —
                        @if($av->period === 'A') Period A (08–12)
                        @elseif($av->period === 'B') Period B (12–16)
                        @else Both (08–16)
                        @endif
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection
