{{-- resources/views/admin/schedule/assign.blade.php --}}
@extends('app.layout')

@section('head')
<title>Assign Schedule — SchoolMS Admin</title>
@endsection

@section('styles')
<style>
.page-wrap { max-width: 1060px; margin: 2rem auto; padding: 0 1.5rem 4rem; }
.page-header { margin-bottom: 2rem; }
.page-header h1 { font-size: 1.6rem; font-weight: 800; letter-spacing: -.02em; color: var(--text); margin-bottom: .25rem; }
.page-header p  { font-size: .9rem; color: var(--muted); }

/* layout grid */
.layout-grid { display: grid; grid-template-columns: 320px 1fr; gap: 1.5rem; align-items: start; }

/* card */
.card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; margin-bottom: 1.25rem; }
.card:last-child { margin-bottom: 0; }
.card-header { padding: 1rem 1.25rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
.card-header-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.card-header h2 { font-size: .9rem; font-weight: 700; color: var(--text); margin: 0; }
.card-body { padding: 1.25rem; }

/* teacher info */
.teacher-avatar {
    width: 52px; height: 52px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; font-weight: 800;
    background: rgba(108,99,255,.15); color: var(--accent);
    margin-bottom: .875rem;
}
.teacher-name  { font-size: 1rem; font-weight: 700; color: var(--text); margin-bottom: 2px; }
.teacher-email { font-size: .8rem; color: var(--muted); margin-bottom: .75rem; }

/* tags */
.tag {
    display: inline-block; padding: .25rem .65rem;
    background: rgba(108,99,255,.1); color: var(--accent);
    border-radius: 999px; font-size: .75rem; font-weight: 600; margin: .2rem;
    border: 1.5px solid transparent; cursor: pointer; transition: all .15s;
}
.tag.selected {
    background: var(--accent); color: #fff;
    border-color: var(--accent);
}
.tag:hover:not(.selected) { border-color: rgba(108,99,255,.4); }
.section-label { font-size: .7rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; margin-bottom: .5rem; }

/* availability list */
.avail-list { display: flex; flex-direction: column; gap: .4rem; }
.avail-row {
    display: flex; align-items: center; gap: 8px;
    padding: .5rem .75rem; background: var(--surface2);
    border: 1px solid var(--border); border-radius: 8px;
    font-size: .82rem; font-weight: 600; color: var(--text);
}
.avail-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
.avail-period { margin-left: auto; font-size: .73rem; font-weight: 600; padding: .15rem .5rem; border-radius: 6px; }
.p-a    { background: rgba(108,99,255,.12); color: var(--accent); }
.p-b    { background: rgba(67,233,123,.12);  color: #22c55e; }
.p-both { background: rgba(245,158,11,.12);  color: #f59e0b; }

/* form */
.form-group { margin-bottom: 1.25rem; }
.form-group:last-child { margin-bottom: 0; }
.form-label { display: block; font-size: .75rem; font-weight: 600; color: var(--muted); margin-bottom: .4rem; letter-spacing: .02em; }
.form-label span { color: var(--accent2); }
.form-select {
    width: 100%; padding: .7rem 2.5rem .7rem 1rem; border-radius: 10px;
    font-size: .875rem; font-family: inherit;
    border: 1.5px solid var(--border);
    background: var(--surface2); color: var(--text);
    transition: border-color .2s, box-shadow .2s; outline: none;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23888' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
}
.form-select:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(108,99,255,.12); }

/* slot cards */
.slot-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .5rem; margin-top: .4rem; }
.slot-btn {
    padding: .65rem .75rem; border-radius: 10px;
    border: 1.5px solid var(--border); background: var(--surface2);
    font-size: .82rem; font-weight: 600; color: var(--muted);
    cursor: pointer; transition: all .15s; text-align: left; font-family: inherit;
}
.slot-btn:hover { border-color: rgba(108,99,255,.4); color: var(--text); }
.slot-btn.selected { border-color: var(--accent); background: rgba(108,99,255,.08); color: var(--accent); }
.slot-btn.period-b:hover    { border-color: rgba(67,233,123,.4); }
.slot-btn.period-b.selected { border-color: #43e97b; background: rgba(67,233,123,.08); color: #22c55e; }
.slot-time { font-size: .7rem; font-weight: 500; opacity: .7; display: block; margin-top: 1px; }

/* class cards */
.class-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .5rem; margin-top: .4rem; }
.class-btn {
    padding: .65rem .75rem; border-radius: 10px;
    border: 1.5px solid var(--border); background: var(--surface2);
    font-size: .82rem; font-weight: 600; color: var(--muted);
    cursor: pointer; transition: all .15s; text-align: left; font-family: inherit;
}
.class-btn:hover    { border-color: rgba(108,99,255,.4); color: var(--text); }
.class-btn.selected { border-color: var(--accent); background: rgba(108,99,255,.08); color: var(--accent); }
.class-cap { font-size: .7rem; font-weight: 500; opacity: .7; display: block; margin-top: 1px; }

/* ── Day block (accordion-style) ── */
.day-blocks { display: flex; flex-direction: column; gap: .75rem; margin-top: .5rem; }

.day-block {
    border: 1.5px solid var(--border); border-radius: 12px;
    overflow: hidden; background: var(--surface2);
    transition: border-color .2s;
}
.day-block.active { border-color: var(--accent); }

.day-block-header {
    display: flex; align-items: center; gap: 10px;
    padding: .75rem 1rem; cursor: pointer;
    user-select: none;
}
.day-block-header input[type="checkbox"] {
    width: 16px; height: 16px; accent-color: var(--accent);
    cursor: pointer; flex-shrink: 0;
}
.day-block-header .day-label {
    font-size: .875rem; font-weight: 700; color: var(--text); flex: 1;
}
.day-block-header .day-badge {
    font-size: .72rem; font-weight: 600; padding: .2rem .55rem;
    border-radius: 6px;
}
.day-block-body {
    padding: 0 1rem 1rem;
    display: none;
}
.day-block.active .day-block-body { display: block; }

.day-sub-label {
    font-size: .7rem; font-weight: 700; color: var(--muted);
    text-transform: uppercase; letter-spacing: .08em;
    margin: .75rem 0 .4rem;
}

/* selected summary badge inside day header */
.day-summary {
    font-size: .72rem; font-weight: 600;
    background: rgba(108,99,255,.12); color: var(--accent);
    border-radius: 6px; padding: .2rem .55rem;
    display: none;
}
.day-summary.visible { display: inline-block; }

/* subject multi-select grid */
.subject-grid { display: flex; flex-wrap: wrap; gap: .35rem; margin-top: .4rem; }
.subject-btn {
    padding: .3rem .8rem; border-radius: 999px;
    border: 1.5px solid var(--border); background: var(--surface2);
    font-size: .78rem; font-weight: 600; color: var(--muted);
    cursor: pointer; transition: all .15s; font-family: inherit;
}
.subject-btn:hover    { border-color: rgba(108,99,255,.4); color: var(--text); }
.subject-btn.selected { border-color: var(--accent); background: rgba(108,99,255,.1); color: var(--accent); }

/* conflict error */
.conflict-box {
    background: rgba(255,101,132,.08); border: 1px solid rgba(255,101,132,.25);
    border-radius: 12px; padding: .875rem 1.1rem; margin-bottom: 1.25rem;
}
.conflict-box p { font-size: .85rem; color: var(--accent2); margin: 0 0 .3rem; }
.conflict-box p:last-child { margin-bottom: 0; }

/* footer */
.form-footer {
    display: flex; align-items: center; justify-content: space-between;
    gap: 1rem; padding-top: 1.25rem;
    border-top: 1px solid var(--border); margin-top: 1.25rem; flex-wrap: wrap;
}
.btn-primary {
    padding: .7rem 2rem; background: var(--accent); color: #fff;
    border: none; border-radius: 12px; font-size: .9rem; font-weight: 600;
    cursor: pointer; transition: all .2s; font-family: inherit;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-primary:hover    { background: #5a52e0; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(108,99,255,.35); }
.btn-primary:disabled { opacity: .5; cursor: not-allowed; transform: none; box-shadow: none; }
.btn-secondary {
    padding: .7rem 1.5rem; background: var(--surface2); color: var(--text);
    border: 1px solid var(--border); border-radius: 12px; font-size: .9rem; font-weight: 600;
    cursor: pointer; transition: all .2s; font-family: inherit;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
}
.btn-secondary:hover { border-color: rgba(108,99,255,.4); color: var(--text); }

/* state messages */
.state-msg { font-size: .82rem; color: var(--muted); font-style: italic; padding: .5rem 0; margin: 0; }

/* selection counter */
.selection-counter {
    font-size: .78rem; font-weight: 600; color: var(--muted);
    background: var(--surface2); border: 1px solid var(--border);
    border-radius: 8px; padding: .4rem .75rem;
    display: inline-flex; align-items: center; gap: 6px;
}
.selection-counter .count { color: var(--accent); font-size: .9rem; }

@media (max-width: 768px) {
    .layout-grid { grid-template-columns: 1fr; }
    .slot-grid, .class-grid { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')
<div class="page-wrap">

    <div class="page-header">
        <h1>Assign Schedule</h1>
        <p>Select subjects, pick days, and assign a time slot for each day.</p>
    </div>

    <div class="layout-grid">

        {{-- ════════ LEFT: Teacher info ════════ --}}
        <div>

            {{-- Teacher --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon" style="background:rgba(108,99,255,.12)">
                        <svg width="14" height="14" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h2>Teacher</h2>
                </div>
                <div class="card-body">
                    <div class="teacher-avatar">
                        {{ strtoupper(substr($req->teacher->user->name, 0, 2)) }}
                    </div>
                    <div class="teacher-name">{{ $req->teacher->user->name }}</div>
                    <div class="teacher-email">{{ $req->teacher->user->email }}</div>

                    @if($req->notes)
                    <div style="background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.2);
                                border-radius:9px;padding:.6rem .875rem;font-size:.8rem;color:var(--text);">
                        💬 {{ $req->notes }}
                    </div>
                    @endif
                </div>
            </div>

            {{-- Subjects (info) --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon" style="background:rgba(67,233,123,.10)">
                        <svg width="14" height="14" fill="none" stroke="#43e97b" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                        </svg>
                    </div>
                    <h2>Requested Subjects</h2>
                </div>
                <div class="card-body">
                    @foreach($req->subjects as $s)
                        <span class="tag">{{ $s->name }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Availability --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon" style="background:rgba(245,158,11,.10)">
                        <svg width="14" height="14" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8"  y1="2" x2="8"  y2="6"/>
                            <line x1="3"  y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <h2>Availability</h2>
                </div>
                <div class="card-body">
                    <div class="avail-list">
                        @foreach($req->availability as $av)
                        <div class="avail-row">
                            <span class="avail-dot" style="background:{{
                                $av->period === 'A' ? '#6c63ff' :
                                ($av->period === 'B' ? '#43e97b' : '#f59e0b')
                            }}"></span>
                            <span>{{ ucfirst($av->day) }}</span>
                            <span class="avail-period {{
                                $av->period === 'A' ? 'p-a' :
                                ($av->period === 'B' ? 'p-b' : 'p-both')
                            }}">
                                @if($av->period === 'A')     A · 08:00–12:00
                                @elseif($av->period === 'B') B · 12:00–16:00
                                @else                        A+B · 08:00–16:00
                                @endif
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>{{-- /LEFT --}}

        {{-- ════════ RIGHT: Assignment form ════════ --}}
        <div>
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon" style="background:rgba(108,99,255,.12)">
                        <svg width="14" height="14" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="9 11 12 14 22 4"/>
                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                        </svg>
                    </div>
                    <h2>Assign Schedule</h2>
                </div>
                <div class="card-body">

                    @if($errors->any())
                    <div class="conflict-box">
                        @foreach($errors->all() as $e)
                            <p>⚠ {{ $e }}</p>
                        @endforeach
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.schedule.store') }}" id="assign-form">
                    @csrf
                    <input type="hidden" name="teaching_request_id" value="{{ $req->id }}">

                        {{-- ① Subjects (multi-select) --}}
                        <div class="form-group">
                            <label class="form-label">
                                Subjects <span>*</span>
                                <span style="font-weight:400;color:var(--muted);text-transform:none;letter-spacing:0">
                                    — select one or more
                                </span>
                            </label>
                            <div class="subject-grid" id="subject-grid">
                                @foreach($req->subjects as $s)
                                    <button type="button"
                                            class="subject-btn"
                                            data-id="{{ $s->id }}"
                                            onclick="toggleSubject(this, {{ $s->id }})">
                                        {{ $s->name }}
                                    </button>
                                @endforeach
                            </div>
                            {{-- hidden inputs injected by JS --}}
                            <div id="subject-inputs"></div>
                            <p id="subject-err" style="font-size:.75rem;color:var(--accent2);margin-top:.3rem;display:none;">
                                Please select at least one subject.
                            </p>
                        </div>

                        {{-- ② Days + slots (multi-day, each with its own slot + class) --}}
                        <div class="form-group">
                            <label class="form-label">
                                Days &amp; Slots <span>*</span>
                                <span style="font-weight:400;color:var(--muted);text-transform:none;letter-spacing:0">
                                    — select 3 or more days
                                </span>
                            </label>

                            <div style="margin-bottom:.6rem;display:flex;align-items:center;gap:.5rem;">
                                <span class="selection-counter">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8"  y1="2" x2="8"  y2="6"/>
                                        <line x1="3"  y1="10" x2="21" y2="10"/>
                                    </svg>
                                    <span class="count" id="day-count">0</span> day(s) selected
                                </span>
                            </div>

                            <div class="day-blocks" id="day-blocks">
                                @foreach($req->availability as $av)
                                <div class="day-block"
                                     id="day-block-{{ $av->day }}"
                                     data-day="{{ $av->day }}"
                                     data-period="{{ $av->period }}">

                                    <div class="day-block-header" onclick="toggleDayBlock('{{ $av->day }}', this)">
                                        <input type="checkbox"
                                               id="day-cb-{{ $av->day }}"
                                               onclick="event.stopPropagation(); toggleDayCheck('{{ $av->day }}')">
                                        <span class="day-label">{{ ucfirst($av->day) }}</span>
                                        <span class="day-badge {{
                                            $av->period === 'A' ? 'p-a' :
                                            ($av->period === 'B' ? 'p-b' : 'p-both')
                                        }}">
                                            @if($av->period === 'A')     Period A
                                            @elseif($av->period === 'B') Period B
                                            @else                        A + B
                                            @endif
                                        </span>
                                        <span class="day-summary" id="summary-{{ $av->day }}"></span>
                                    </div>

                                    <div class="day-block-body" id="body-{{ $av->day }}">

                                        {{-- Hour slots --}}
                                        <div class="day-sub-label">Hour Slot</div>
                                        <div class="slot-grid" id="slot-grid-{{ $av->day }}">
                                            <p class="state-msg">Loading…</p>
                                        </div>
                                        <input type="hidden"
                                               name="days[{{ $av->day }}][hour_slot_id]"
                                               id="slot-hidden-{{ $av->day }}"
                                               value="">

                                        {{-- Classes --}}
                                        <div class="day-sub-label" style="margin-top:1rem;">Class</div>
                                        <div class="class-grid" id="class-grid-{{ $av->day }}">
                                            <p class="state-msg">← Pick a slot first</p>
                                        </div>
                                        <input type="hidden"
                                               name="days[{{ $av->day }}][class_id]"
                                               id="class-hidden-{{ $av->day }}"
                                               value="">

                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <p id="day-err" style="font-size:.75rem;color:var(--accent2);margin-top:.5rem;display:none;">
                                Please select at least 3 days.
                            </p>
                        </div>

                        <div class="form-footer">
                            <a href="{{ route('admin.schedule.index') }}" class="btn-secondary">
                                ← Back
                            </a>
                            <button type="submit" class="btn-primary" id="submit-btn" disabled
                                    onclick="return validateForm()">
                                <svg width="14" height="14" fill="none" stroke="currentColor"
                                     stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                Confirm Assignment
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>{{-- /RIGHT --}}

    </div>
</div>
@endsection

@section('scripts')
<script>
const teacherId = {{ $req->teacher_id }};

/* ════════════════════════════════════════
   STATE
════════════════════════════════════════ */
const selectedSubjects = new Set();
// dayState[day] = { period, slotId, classId }
const dayState = {};

// Pre-fill availability data from Blade
const availability = @json($req->availability->keyBy('day'));

/* ════════════════════════════════════════
   ① SUBJECTS
════════════════════════════════════════ */
function toggleSubject(btn, id) {
    if (selectedSubjects.has(id)) {
        selectedSubjects.delete(id);
        btn.classList.remove('selected');
    } else {
        selectedSubjects.add(id);
        btn.classList.add('selected');
    }
    syncSubjectInputs();
    checkSubmit();
}

function syncSubjectInputs() {
    const container = document.getElementById('subject-inputs');
    container.innerHTML = '';
    selectedSubjects.forEach(id => {
        const inp = document.createElement('input');
        inp.type  = 'hidden';
        inp.name  = 'subject_ids[]';
        inp.value = id;
        container.appendChild(inp);
    });
}

/* ════════════════════════════════════════
   ② DAY BLOCKS – toggle check + expand
════════════════════════════════════════ */
function toggleDayBlock(day, headerEl) {
    // Only expand/collapse body via header click (not checkbox)
    const block = document.getElementById('day-block-' + day);
    const cb    = document.getElementById('day-cb-' + day);
    // toggling checkbox also
    cb.checked = !cb.checked;
    handleDayToggle(day, cb.checked);
}

function toggleDayCheck(day) {
    const cb = document.getElementById('day-cb-' + day);
    handleDayToggle(day, cb.checked);
}

async function handleDayToggle(day, checked) {
    const block = document.getElementById('day-block-' + day);
    const body  = document.getElementById('body-' + day);

    if (checked) {
        block.classList.add('active');
        body.style.display = 'block';
        if (!dayState[day]) {
            dayState[day] = {
                period  : availability[day]?.period ?? 'both',
                slotId  : null,
                classId : null,
            };
            await loadSlots(day);
        }
    } else {
        block.classList.remove('active');
        body.style.display = 'none';
        delete dayState[day];
        clearDayHiddens(day);
        updateSummary(day, null, null);
    }

    updateDayCount();
    checkSubmit();
}

/* ════════════════════════════════════════
   LOAD SLOTS for a day
════════════════════════════════════════ */
async function loadSlots(day) {
    const period = dayState[day]?.period ?? 'both';
    const grid   = document.getElementById('slot-grid-' + day);
    grid.innerHTML = '<p class="state-msg">Loading slots…</p>';

    try {
        const res   = await fetch(
            `{{ route('admin.schedule.free-slots') }}?teacher_id=${teacherId}&day=${day}&period=${period}`
        );
        const slots = await res.json();

        if (!slots.length) {
            grid.innerHTML = '<p class="state-msg">No free slots on this day.</p>';
            return;
        }

        let html = '';
        slots.forEach(slot => {
            const cls = slot.period === 'B' ? 'period-b' : '';
            html += `
                <button type="button"
                        class="slot-btn ${cls}"
                        data-id="${slot.id}"
                        onclick="selectSlot(this, '${day}', ${slot.id})">
                    ${slot.label}
                    <span class="slot-time">Period ${slot.period}</span>
                </button>`;
        });
        grid.innerHTML = html;

    } catch (e) {
        grid.innerHTML = '<p class="state-msg" style="color:var(--accent2)">Error loading slots.</p>';
    }
}

/* ════════════════════════════════════════
   SELECT SLOT → load classes
════════════════════════════════════════ */
async function selectSlot(btn, day, slotId) {
    // highlight
    document.querySelectorAll(`#slot-grid-${day} .slot-btn`).forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');

    dayState[day].slotId  = slotId;
    dayState[day].classId = null;
    document.getElementById('slot-hidden-' + day).value = slotId;

    // reset class
    const classGrid = document.getElementById('class-grid-' + day);
    document.getElementById('class-hidden-' + day).value = '';
    classGrid.innerHTML = '<p class="state-msg">Loading classes…</p>';
    updateSummary(day, btn.childNodes[0]?.textContent?.trim() ?? '', null);
    checkSubmit();

    try {
        const res     = await fetch(
            `{{ route('admin.schedule.free-classes') }}?day=${day}&hour_slot_id=${slotId}`
        );
        const classes = await res.json();

        if (!classes.length) {
            classGrid.innerHTML = '<p class="state-msg">No classes available at this slot.</p>';
            return;
        }

        let html = '';
        classes.forEach(cls => {
            html += `
                <button type="button"
                        class="class-btn"
                        data-id="${cls.id}"
                        onclick="selectClass(this, '${day}', ${cls.id}, '${cls.name}')">
                    ${cls.name}
                    <span class="class-cap">Capacity: ${cls.capacity}</span>
                </button>`;
        });
        classGrid.innerHTML = html;

    } catch (e) {
        classGrid.innerHTML = '<p class="state-msg" style="color:var(--accent2)">Error loading classes.</p>';
    }
}

/* ════════════════════════════════════════
   SELECT CLASS
════════════════════════════════════════ */
function selectClass(btn, day, classId, className) {
    document.querySelectorAll(`#class-grid-${day} .class-btn`).forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');

    dayState[day].classId = classId;
    document.getElementById('class-hidden-' + day).value = classId;

    const slotLabel = document.querySelector(`#slot-grid-${day} .slot-btn.selected`)
                        ?.childNodes[0]?.textContent?.trim() ?? '';
    updateSummary(day, slotLabel, className);
    checkSubmit();
}

/* ════════════════════════════════════════
   HELPERS
════════════════════════════════════════ */
function clearDayHiddens(day) {
    document.getElementById('slot-hidden-' + day).value  = '';
    document.getElementById('class-hidden-' + day).value = '';

    const sg = document.getElementById('slot-grid-' + day);
    const cg = document.getElementById('class-grid-' + day);
    if (sg) sg.innerHTML = '<p class="state-msg">Loading…</p>';
    if (cg) cg.innerHTML = '<p class="state-msg">← Pick a slot first</p>';
}

function updateDayCount() {
    document.getElementById('day-count').textContent = Object.keys(dayState).length;
}

function updateSummary(day, slotLabel, className) {
    const el = document.getElementById('summary-' + day);
    if (!el) return;
    if (slotLabel && className) {
        el.textContent = slotLabel + ' · ' + className;
        el.classList.add('visible');
    } else if (slotLabel) {
        el.textContent = slotLabel;
        el.classList.add('visible');
    } else {
        el.textContent = '';
        el.classList.remove('visible');
    }
}

/* ════════════════════════════════════════
   SUBMIT GATE
════════════════════════════════════════ */
function checkSubmit() {
    const subjectOk = selectedSubjects.size >= 1;
    const dayKeys   = Object.keys(dayState);
    const dayOk     = dayKeys.length >= 3
                   && dayKeys.every(d => dayState[d].slotId && dayState[d].classId);

    document.getElementById('submit-btn').disabled = !(subjectOk && dayOk);
}

function validateForm() {
    let ok = true;

    if (selectedSubjects.size < 1) {
        document.getElementById('subject-err').style.display = 'block';
        ok = false;
    } else {
        document.getElementById('subject-err').style.display = 'none';
    }

    const dayKeys = Object.keys(dayState);
    if (dayKeys.length < 3 || !dayKeys.every(d => dayState[d].slotId && dayState[d].classId)) {
        document.getElementById('day-err').style.display = 'block';
        ok = false;
    } else {
        document.getElementById('day-err').style.display = 'none';
    }

    return ok;
}
</script>
@endsection
