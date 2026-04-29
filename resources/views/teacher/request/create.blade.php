{{-- resources/views/teacher/request/create.blade.php --}}
@extends('app.layout')

@section('head')
<title>New Teaching Request — SchoolMS</title>
@endsection
<script src="{{ asset('js/app.js') }}"></script>
@section('styles')
<style>
.page-wrap   { max-width: 860px; margin: 2rem auto; padding: 0 1.5rem 4rem; }
.page-header { margin-bottom: 2rem; }
.page-header h1 { font-size: 1.6rem; font-weight: 800; letter-spacing: -.02em; color: var(--text); margin-bottom: .25rem; }
.page-header p  { font-size: .9rem; color: var(--muted); }

/* card */
.card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; margin-bottom: 1.5rem; }
.card-header { padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
.card-header-icon { width: 34px; height: 34px; border-radius: 9px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.card-header h2 { font-size: .95rem; font-weight: 700; color: var(--text); margin: 0; }
.card-body  { padding: 1.5rem; }

/* form elements */
.form-grid  { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.form-group { margin-bottom: 1.25rem; }
.form-group:last-child { margin-bottom: 0; }
.form-label { display: block; font-size: .75rem; font-weight: 600; color: var(--muted); margin-bottom: .4rem; letter-spacing: .02em; }
.form-label span { color: var(--accent2); }
.form-input {
    width: 100%; padding: .65rem 1rem; border-radius: 10px;
    font-size: .875rem; font-family: inherit;
    border: 1.5px solid var(--border);
    background: var(--surface2); color: var(--text);
    transition: border-color .2s, box-shadow .2s; outline: none;
}
.form-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(108,99,255,.12); }
.form-input::placeholder { color: var(--muted); opacity: .5; }
textarea.form-input { resize: vertical; min-height: 90px; }
.error-msg { font-size: .75rem; color: var(--accent2); margin-top: .3rem; }

/* subject checkboxes */
.subjects-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: .6rem; }
.subject-pill {
    display: flex; align-items: center; gap: 9px;
    padding: .65rem 1rem; border-radius: 10px;
    border: 1.5px solid var(--border);
    background: var(--surface2); cursor: pointer;
    transition: all .15s; user-select: none;
}
.subject-pill:hover { border-color: rgba(108,99,255,.4); }
.subject-pill input[type=checkbox] { display: none; }
.subject-pill.checked { border-color: var(--accent); background: rgba(108,99,255,.08); }
.subject-pill .pill-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--border); flex-shrink: 0; transition: background .15s; }
.subject-pill.checked .pill-dot { background: var(--accent); }
.subject-pill .pill-name { font-size: .85rem; font-weight: 600; color: var(--text); }

/* availability days */
.days-list { display: flex; flex-direction: column; gap: .75rem; }
.day-row { border: 1.5px solid var(--border); border-radius: 12px; overflow: hidden; transition: border-color .2s; }
.day-row.active { border-color: rgba(108,99,255,.4); }
.day-toggle {
    display: flex; align-items: center; gap: 12px;
    padding: .85rem 1.1rem; cursor: pointer; user-select: none;
    background: var(--surface2);
}
.day-toggle input[type=checkbox] { display: none; }
.day-check {
    width: 20px; height: 20px; border-radius: 6px;
    border: 2px solid var(--border); flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    transition: all .15s;
}
.day-row.active .day-check { background: var(--accent); border-color: var(--accent); }
.day-check svg { opacity: 0; transition: opacity .15s; }
.day-row.active .day-check svg { opacity: 1; }
.day-name { font-size: .875rem; font-weight: 600; color: var(--text); flex: 1; }
.day-hint { font-size: .75rem; color: var(--muted); }

.day-period-picker { padding: .85rem 1.1rem; border-top: 1px solid var(--border); display: none; background: var(--surface); }
.day-row.active .day-period-picker { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; }
.period-label { font-size: .75rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; margin-right: .25rem; }
.period-options { display: flex; gap: .5rem; flex-wrap: wrap; }
.period-btn {
    padding: .35rem .9rem; border-radius: 999px; border: 1.5px solid var(--border);
    font-size: .78rem; font-weight: 600; cursor: pointer; transition: all .15s;
    background: transparent; font-family: inherit; color: var(--muted);
}
.period-btn:hover { border-color: rgba(108,99,255,.4); color: var(--text); }
.period-btn.selected { background: rgba(108,99,255,.12); border-color: var(--accent); color: var(--accent); }

/* counter badge */
.day-counter { font-size: .75rem; font-weight: 600; padding: .2rem .6rem; border-radius: 999px; background: rgba(108,99,255,.1); color: var(--accent); margin-left: auto; }
.day-counter.warn  { background: rgba(245,158,11,.12); color: #f59e0b; }
.day-counter.error { background: rgba(255,101,132,.12); color: var(--accent2); }

/* submit */
.form-footer { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; padding-top: 1.25rem; border-top: 1px solid var(--border); margin-top: 1.25rem; }
.btn-primary {
    padding: .7rem 2rem; background: var(--accent); color: #fff;
    border: none; border-radius: 12px; font-size: .9rem; font-weight: 600;
    cursor: pointer; transition: all .2s; font-family: inherit;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-primary:hover { background: #5a52e0; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(108,99,255,.35); }
.btn-secondary {
    padding: .7rem 1.5rem; background: var(--surface2); color: var(--text);
    border: 1px solid var(--border); border-radius: 12px; font-size: .9rem; font-weight: 600;
    cursor: pointer; transition: all .2s; font-family: inherit; text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-secondary:hover { border-color: rgba(108,99,255,.4); background: rgba(108,99,255,.06); color: var(--text); }

/* alert */
.alert-error { background: rgba(255,101,132,.08); border: 1px solid rgba(255,101,132,.25); border-radius: 12px; padding: .875rem 1.1rem; margin-bottom: 1.5rem; }
.alert-error ul { margin: 0; padding-left: 1rem; }
.alert-error li { font-size: .85rem; color: var(--accent2); }
</style>
@endsection

@section('content')
<div class="page-wrap">

    <div class="page-header">
        <h1>New Teaching Request</h1>
        <p>Select the subjects you want to teach and your weekly availability.</p>
    </div>

    {{-- validation errors --}}
    @if($errors->any())
    <div class="alert-error">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('requests.store') }}" id="request-form">
    @csrf

        {{-- ── Subjects ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon" style="background:rgba(108,99,255,.12)">
                    <svg width="15" height="15" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                    </svg>
                </div>
                <h2>Subjects I want to teach</h2>
            </div>
            <div class="card-body">
                <div class="subjects-grid">
                    @foreach($subjects as $subject)
                    <label class="subject-pill {{ collect(old('subjects', []))->contains($subject->id) ? 'checked' : '' }}"
                           onclick="togglePill(this)">
                        <input type="checkbox"
                               name="subjects[]"
                               value="{{ $subject->id }}"
                               {{ collect(old('subjects', []))->contains($subject->id) ? 'checked' : '' }}>
                        <span class="pill-dot"></span>
                        <span class="pill-name">{{ $subject->name }}</span>
                    </label>
                    @endforeach
                </div>
                @error('subjects') <p class="error-msg">{{ $message }}</p> @enderror
            </div>
        </div>

       @php
$days = [
    'sun' => 'Sunday',
    'mon' => 'Monday',
    'tue' => 'Tuesday',
    'wed' => 'Wednesday',
    'thu' => 'Thursday',
    'fri' => 'Friday',
];

$oldDays = collect(old('days', []))->keyBy('day');
@endphp

<div class="days-list">
@foreach($days as $key => $label)

@php
    $oldDay = $oldDays[$key] ?? null;
    $isActive = $oldDay ? true : false;
@endphp

<div class="day-row {{ $isActive ? 'active' : '' }}" id="row_{{ $key }}">

<label class="day-toggle">
    {{-- Remove name entirely, JS handles the state --}}
   <input type="checkbox"
       name="active_days[]"
       value="{{ $key }}"
       onchange="toggleDay('{{ $key }}', this)"
       {{ $isActive ? 'checked' : '' }}>

        <span class="day-check">
            <svg width="11" height="11" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
        </span>

        <span class="day-name">{{ $label }}</span>

        <span class="day-hint">
            @if($key === 'fri' || $key === 'sun') Weekend @else Weekday @endif
        </span>
    </label>

    <div class="day-period-picker">
    <input type="hidden"
           name="days[{{ $key }}][day]"
           id="day_{{ $key }}"
           value="{{ $key }}">

    <input type="hidden"
           name="days[{{ $key }}][period]"
           id="period_{{ $key }}"
           value="{{ $oldDay['period'] ?? 'both' }}">

    <span class="period-label">Period:</span>
    <div class="period-options">
        @foreach(['A' => 'A (08:00–12:00)', 'B' => 'B (12:00–16:00)', 'both' => 'Both'] as $val => $lbl)
        <button type="button"
                class="period-btn {{ ($oldDay['period'] ?? 'both') === $val ? 'selected' : '' }}"
                onclick="selectPeriod(this, '{{ $key }}', '{{ $val }}')">
            {{ $lbl }}
        </button>
        @endforeach
    </div>
</div>
</div>
@endforeach
</div>

        {{-- ── Notes ── --}}
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon" style="background:rgba(245,158,11,.10)">
                    <svg width="15" height="15" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </div>
                <h2>Notes <span style="font-weight:400;color:var(--muted)">(optional)</span></h2>
            </div>
            <div class="card-body">
                <textarea name="notes" class="form-input" placeholder="Any preferences or additional info for the admin…" rows="3">{{ old('notes') }}</textarea>
            </div>
        </div>

        {{-- ── Submit ── --}}
        <div class="form-footer">
            <a href="{{ route('requests.index') }}" class="btn-secondary">← Back</a>
            <button type="submit" class="btn-primary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                Submit Request
            </button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
let activeCount = {{ collect(old('days', []))->count() }};
const MAX = 6;
const MIN = 3;

function updateBadge() {
    const badge = document.getElementById('day-count-badge');

    badge.textContent = activeCount + ' / ' + MAX + ' days';

    badge.className = 'day-counter' +
        (activeCount < MIN ? ' error' : activeCount === MAX ? ' warn' : '');
}

updateBadge();

function toggleDay(key, checkbox) {
    const row = document.getElementById('row_' + key);
    const picker = row.querySelector('.day-period-picker');
    const inputs = picker.querySelectorAll('input[type=hidden]');

    if (checkbox.checked) {
        if (activeCount >= MAX) {
            checkbox.checked = false;
            return;
        }
        row.classList.add('active');
        inputs.forEach(i => i.disabled = false);
        activeCount++;
    } else {
        row.classList.remove('active');
        inputs.forEach(i => i.disabled = true);
        activeCount--;
    }

    updateBadge();
}

function selectPeriod(btn, key, val) {
    const container = btn.parentElement;

    container.querySelectorAll('.period-btn')
        .forEach(b => b.classList.remove('selected'));

    btn.classList.add('selected');

    document.getElementById('period_' + key).value = val;
}
function togglePill(label) {
    const cb = label.querySelector('input[type=checkbox]');

    cb.checked = !cb.checked;

    label.classList.toggle('checked', cb.checked);
}

// On page load, disable inactive days
document.querySelectorAll('.day-row').forEach(row => {
    if (!row.classList.contains('active')) {
        row.querySelectorAll('.day-period-picker input[type=hidden]')
           .forEach(i => i.disabled = true);
    }
});
</script>
@endsection
