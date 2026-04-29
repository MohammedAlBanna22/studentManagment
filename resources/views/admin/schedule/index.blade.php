{{-- resources/views/admin/schedule/index.blade.php --}}
@extends('app.layout')

@section('head')
<title>Schedule Requests — SchoolMS Admin</title>
@endsection

@section('styles')
<style>
.page-wrap   { max-width: 1100px; margin: 2rem auto; padding: 0 1.5rem 4rem; }
.page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
.page-header h1 { font-size: 1.6rem; font-weight: 800; letter-spacing: -.02em; color: var(--text); margin: 0; }
.page-header p  { font-size: .9rem; color: var(--muted); margin: .2rem 0 0; }

/* stat strip */
.stat-strip { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
.stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: 14px; padding: 1.1rem 1.25rem; position: relative; overflow: hidden; cursor: pointer; transition: transform .15s, box-shadow .15s; }
.stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,.08); }
.stat-card.active-tab { box-shadow: 0 0 0 2px var(--accent); }
.stat-card.s-amber.active-tab  { box-shadow: 0 0 0 2px #f59e0b; }
.stat-card.s-green.active-tab  { box-shadow: 0 0 0 2px #43e97b; }
.stat-card.s-pink.active-tab   { box-shadow: 0 0 0 2px var(--accent2); }
.stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; border-radius:99px; }
.stat-card.s-purple::before { background: var(--accent); }
.stat-card.s-amber::before  { background: #f59e0b; }
.stat-card.s-green::before  { background: #43e97b; }
.stat-card.s-pink::before   { background: var(--accent2); }
.stat-num { font-size: 1.8rem; font-weight: 800; letter-spacing: -.03em; line-height: 1; }
.stat-lbl { font-size: .72rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .08em; margin-top: 4px; }

/* table card */
.table-card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
.table-card-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
.table-card-header h2 { font-size: .95rem; font-weight: 700; color: var(--text); margin: 0; }

/* active filter label */
.filter-label {
    font-size: .75rem; font-weight: 600; color: var(--muted);
    background: var(--surface2); border: 1px solid var(--border);
    border-radius: 8px; padding: .3rem .75rem;
    display: inline-flex; align-items: center; gap: 6px;
}
.filter-dot { width: 7px; height: 7px; border-radius: 50%; }

table { width: 100%; border-collapse: collapse; }
thead th { padding: .7rem 1.25rem; font-size: .72rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .08em; text-align: left; background: var(--surface2); border-bottom: 1px solid var(--border); }
tbody td { padding: 1rem 1.25rem; font-size: .85rem; color: var(--text); border-bottom: 1px solid var(--border); vertical-align: middle; }
tbody tr:last-child td { border-bottom: none; }
tbody tr:hover td { background: rgba(108,99,255,.03); }

/* row remove animation */
tbody tr { transition: opacity .3s, transform .3s; }
tbody tr.removing { opacity: 0; transform: translateX(30px); }
.declined-row {
    background: rgba(255, 0, 0, 0.05);
    border-left: 4px solid #ff4d4f;
}
/* badge */
.badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: .28rem .75rem; border-radius: 999px;
    font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em;
}
.badge-pending  { background: rgba(245,158,11,.12); color: #f59e0b; }
.badge-approved { background: rgba(67,233,123,.12);  color: #22c55e; }
.badge-declined { background: rgba(255,101,132,.12); color: var(--accent2); }
.badge-dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

/* subject tags */
.tag { display: inline-block; padding: .2rem .6rem; background: rgba(108,99,255,.1); color: var(--accent); border-radius: 999px; font-size: .73rem; font-weight: 600; margin: .15rem; }

/* avail pills */
.avail-mini { display: flex; flex-wrap: wrap; gap: .3rem; }
.avail-mini span {
    display: inline-flex; align-items: center; gap: 4px;
    padding: .2rem .6rem; background: var(--surface2);
    border: 1px solid var(--border); border-radius: 6px;
    font-size: .73rem; font-weight: 600; color: var(--muted);
}
.avail-mini .d { width: 6px; height: 6px; border-radius: 50%; }

/* icon-only action buttons */
.actions-cell { display: flex; align-items: center; gap: 6px; }
.icon-btn {
    width: 34px; height: 34px; border-radius: 9px;
    display: inline-flex; align-items: center; justify-content: center;
    border: 1.5px solid var(--border); background: var(--surface2);
    cursor: pointer; transition: all .18s; text-decoration: none;
    position: relative; flex-shrink: 0;
}
.icon-btn.assign { color: var(--accent); border-color: rgba(108,99,255,.25); background: rgba(108,99,255,.08); }
.icon-btn.assign:hover { background: var(--accent); color: #fff; border-color: var(--accent); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(108,99,255,.35); }
.icon-btn.done { color: #22c55e; border-color: rgba(67,233,123,.25); background: rgba(67,233,123,.08); cursor: default; pointer-events: none; }
.icon-btn.delete { color: var(--accent2); border-color: rgba(255,101,132,.25); background: rgba(255,101,132,.08); }
.icon-btn.delete:hover { background: var(--accent2); color: #fff; border-color: var(--accent2); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(255,101,132,.35); }
.icon-btn:disabled { opacity: .4; cursor: not-allowed; }
.icon-btn::after {
    content: attr(data-tip);
    position: absolute; bottom: calc(100% + 7px); left: 50%;
    transform: translateX(-50%) scale(.9);
    background: rgba(0,0,0,.8); color: #fff;
    font-size: .68rem; font-weight: 600; white-space: nowrap;
    padding: .25rem .6rem; border-radius: 6px;
    opacity: 0; pointer-events: none; transition: opacity .15s, transform .15s;
}
.icon-btn:hover::after { opacity: 1; transform: translateX(-50%) scale(1); }

/* empty */
.empty { text-align: center; padding: 3.5rem; color: var(--muted); }

/* confirm modal */
.modal-backdrop {
    position: fixed; inset: 0; background: rgba(0,0,0,.45);
    display: flex; align-items: center; justify-content: center;
    z-index: 999; opacity: 0; pointer-events: none; transition: opacity .2s;
}
.modal-backdrop.open { opacity: 1; pointer-events: all; }
.modal-box {
    background: var(--surface); border: 1px solid var(--border); border-radius: 18px;
    padding: 1.75rem; width: 100%; max-width: 380px; margin: 1rem;
    transform: scale(.95); transition: transform .2s;
}
.modal-backdrop.open .modal-box { transform: scale(1); }
.modal-box h3 { font-size: 1rem; font-weight: 800; color: var(--text); margin: 0 0 .5rem; }
.modal-box p  { font-size: .875rem; color: var(--muted); margin: 0 0 1.25rem; }
.modal-actions { display: flex; gap: .75rem; justify-content: flex-end; }
.btn-cancel {
    padding: .55rem 1.25rem; background: var(--surface2); color: var(--text);
    border: 1px solid var(--border); border-radius: 10px;
    font-size: .85rem; font-weight: 600; cursor: pointer; font-family: inherit;
}
.btn-confirm-del {
    padding: .55rem 1.25rem; background: var(--accent2); color: #fff;
    border: none; border-radius: 10px;
    font-size: .85rem; font-weight: 600; cursor: pointer; font-family: inherit;
    transition: background .2s;
}
.btn-confirm-del:hover { background: #e0405f; }

/* toast */
.toast {
    position: fixed; bottom: 2rem; right: 2rem;
    padding: .75rem 1.25rem; border-radius: 12px;
    font-size: .85rem; font-weight: 600;
    display: flex; align-items: center; gap: 8px;
    box-shadow: 0 8px 24px rgba(0,0,0,.15);
    transform: translateY(20px); opacity: 0;
    transition: all .3s; z-index: 1000; pointer-events: none;
}
.toast.show { transform: translateY(0); opacity: 1; }
.toast-success { background: #22c55e; color: #fff; }
.toast-error   { background: var(--accent2); color: #fff; }
</style>
@endsection

@section('content')
<div class="page-wrap">

    <div class="page-header">
        <div>
            <h1>Teaching Requests</h1>
            <p>Review and assign schedules to teachers.</p>
        </div>
    </div>

    {{-- stat strip — click to filter --}}
    <div class="stat-strip">
        <div class="stat-card s-purple active-tab" onclick="filterTab('all')" id="tab-all">
            <div class="stat-num" style="color:var(--accent);" id="cnt-total">{{ $counts->total }}</div>
            <div class="stat-lbl">Total</div>
        </div>
        <div class="stat-card s-amber" onclick="filterTab('pending')" id="tab-pending">
            <div class="stat-num" style="color:#f59e0b;" id="cnt-pending">{{ $counts->pending }}</div>
            <div class="stat-lbl">Pending</div>
        </div>
        <div class="stat-card s-green" onclick="filterTab('approved')" id="tab-approved">
            <div class="stat-num" style="color:#43e97b;" id="cnt-approved">{{ $counts->approved }}</div>
            <div class="stat-lbl">Approved</div>
        </div>
        <div class="stat-card s-pink" onclick="filterTab('declined')" id="tab-declined">
            <div class="stat-num" style="color:var(--accent2);" id="cnt-declined">{{ $counts->declined }}</div>
            <div class="stat-lbl">Declined</div>
        </div>
    </div>

    {{-- table --}}
    <div class="table-card">
        <div class="table-card-header">
            <h2>All Requests</h2>
            <span class="filter-label" id="active-filter-label">
                <span class="filter-dot" style="background:var(--accent)"></span>
                Showing All
            </span>
        </div>

        @if($requests->isEmpty())
        <div class="empty" id="empty-state">No requests yet.</div>
        @else
        <div style="overflow-x:auto;">
        <table id="requests-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Teacher</th>
                    <th>Subjects</th>
                    <th>Availability</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="requests-tbody">
            @foreach($requests as $req)
            <tr id="row-{{ $req->id }}" data-status="{{ $req->status }}" data-id="{{ $req->id }}">

                <td style="color:var(--muted);font-size:.8rem;">{{ $req->id }}</td>

                <td>
                    <div style="font-weight:700;">{{ $req->teacher->user->name }}</div>
                    <div style="font-size:.75rem;color:var(--muted);">{{ $req->teacher->user->email }}</div>
                </td>

                <td>
                    @foreach($req->subjects as $s)
                        <span class="tag">{{ $s->name }}</span>
                    @endforeach
                </td>

                <td>
                    <div class="avail-mini">
                        @foreach($req->availability as $av)
                        <span>
                            <span class="d" style="background:{{ $av->period==='A'?'#6c63ff':($av->period==='B'?'#43e97b':'#f59e0b') }}"></span>
                            {{ strtoupper($av->day) }}
                            @if($av->period==='A') A @elseif($av->period==='B') B @else A+B @endif
                        </span>
                        @endforeach
                    </div>
                </td>

                <td>
                    <span class="badge badge-{{ $req->status }}" id="badge-{{ $req->id }}">
                        <span class="badge-dot"></span>
                        {{ ucfirst($req->status) }}
                    </span>
                </td>

                <td style="color:var(--muted);font-size:.8rem;">{{ $req->created_at->diffForHumans() }}</td>

                <td>
                    <div class="actions-cell">
                        @if($req->status === 'pending')
                            <a href="{{ route('admin.schedule.assign', $req) }}"
                               class="icon-btn assign"
                               data-tip="Assign Schedule">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="9 11 12 14 22 4"/>
                                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                                </svg>
                            </a>
                        @else
                            <span class="icon-btn done" data-tip="{{ ucfirst($req->status) }}">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </span>
                        @endif

                        <button class="icon-btn delete"
                                data-tip="Delete"
                                onclick="confirmDelete({{ $req->id }})">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                                <path d="M10 11v6M14 11v6"/>
                                <path d="M9 6V4h6v2"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        @endif
    </div>

</div>

{{-- Delete confirm modal --}}
<div class="modal-backdrop" id="delete-modal">
    <div class="modal-box">
        <h3>Delete Request?</h3>
        <p>This will permanently remove the teaching request. This action cannot be undone.</p>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button class="btn-confirm-del" id="modal-confirm-btn" onclick="executeDelete()">
                Delete
            </button>
        </div>
    </div>
</div>

{{-- Toast --}}
<div class="toast" id="toast"></div>

@endsection

@section('scripts')
<script>
const CSRF = '{{ csrf_token() }}';
window.onload = () => filterTab('all');
let pendingDeleteId = null;
let activeFilter    = 'all';

/* ════════ FILTER TABS ════════ */
const filterColors = {
    all:      { color: 'var(--accent)',  label: 'Showing All' },
    pending:  { color: '#f59e0b',        label: 'Pending Only' },
    approved: { color: '#43e97b',        label: 'Approved Only' },
    declined: { color: 'var(--accent2)', label: 'Declined Only' },
};

async function filterTab(status) {
    activeFilter = status;

    // 🔥 Highlight active tab
    document.querySelectorAll('.stat-card').forEach(c => c.classList.remove('active-tab'));
    document.getElementById('tab-' + status).classList.add('active-tab');

    // 🔥 Update label
    const cfg = filterColors[status];
    const lbl = document.getElementById('active-filter-label');
    lbl.innerHTML = `
        <span class="filter-dot" style="background:${cfg.color}"></span>
        ${cfg.label}
    `;

    const tbody = document.getElementById('requests-tbody');

    // 🔄 Loading state
    tbody.innerHTML = `
        <tr>
            <td colspan="7" style="text-align:center;">Loading...</td>
        </tr>
    `;

    try {
        const res = await fetch(`/admin/schedule/requests/fetch?status=${status}`);

        if (!res.ok) throw new Error();

        const html = await res.text();

        // 🔥 Replace table rows
        tbody.innerHTML = html;

    } catch (e) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align:center;color:red;">
                    Failed to load data
                </td>
            </tr>
        `;
    }
}

function checkEmptyState() {
    const visible = [...document.querySelectorAll('#requests-tbody tr')]
        .filter(tr => tr.style.display !== 'none').length;
    let empty = document.getElementById('empty-state');
    const table = document.querySelector('#requests-table');
    if (!visible) {
        if (!empty) {
            empty = document.createElement('div');
            empty.id = 'empty-state';
            empty.className = 'empty';
            empty.textContent = 'No requests for this filter.';
            table.parentElement.parentElement.appendChild(empty);
        }
        if (table) table.style.display = 'none';
        empty.style.display = 'block';
    } else {
        if (empty) empty.style.display = 'none';
        if (table) table.style.display = '';
    }
}

/* ════════ DELETE ════════ */
function confirmDelete(id) {
    pendingDeleteId = id;
    document.getElementById('delete-modal').classList.add('open');
}

function closeModal() {
    document.getElementById('delete-modal').classList.remove('open');
    pendingDeleteId = null;
}

async function executeDelete() {
    if (!pendingDeleteId) return;

    const id = pendingDeleteId;
    const btn = document.getElementById('modal-confirm-btn');

    btn.disabled = true;
    btn.textContent = 'Declining…';

    try {
        const res = await fetch(`/admin/schedule/requests/${id}/decline`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            }
        });

        if (!res.ok) throw new Error();

        closeModal();

        const row = document.getElementById('row-' + id);

        if (row) {
            // optional animation
            row.style.transition = 'all .3s ease';
            row.style.opacity = '0.4';
            row.style.transform = 'translateX(20px)';

            // mark visually as declined
            row.classList.add('declined-row');

            setTimeout(() => {
                row.remove();
            }, 300);
        }

        showToast('Request declined.', 'success');

    } catch (e) {
        showToast('Failed to decline request.', 'error');
    } finally {
        btn.disabled = false;
        btn.textContent = 'Decline';
    }
}

// close modal on backdrop click
document.getElementById('delete-modal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

/* ════════ COUNT HELPERS ════════ */
function updateCount(status, delta) {
    const map = { total: 'cnt-total', pending: 'cnt-pending', approved: 'cnt-approved', declined: 'cnt-declined' };
    const el  = document.getElementById(map[status]);
    if (el) el.textContent = Math.max(0, parseInt(el.textContent) + delta);
}

/* ════════ TOAST ════════ */
function showToast(msg, type = 'success') {
    const t = document.getElementById('toast');
    t.textContent = (type === 'success' ? '✓ ' : '✕ ') + msg;
    t.className   = `toast toast-${type} show`;
    setTimeout(() => t.classList.remove('show'), 3000);
}
</script>
@endsection
