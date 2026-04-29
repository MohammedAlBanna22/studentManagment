{{-- resources/views/subjects/add.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Subjects — {{ $teacher->name }}</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 600px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 2rem;
            transition: color 0.2s;
        }
        .back-btn:hover { color: var(--text); }
        .back-btn svg { transition: transform 0.2s; }
        .back-btn:hover svg { transform: translateX(-3px); }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            animation: fadeUp 0.4s ease both;
        }

        .card-header {
            margin-bottom: 2rem;
        }
        .card-header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .card-header p {
            color: var(--muted);
            font-size: 0.9rem;
            margin-top: 0.4rem;
        }

        .teacher-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: rgba(108,99,255,0.1);
            border: 1px solid rgba(108,99,255,0.2);
            border-radius: 99px;
            font-size: 0.82rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }
        .teacher-badge .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
        }

        /* toolbar */
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }
        .form-label {
            font-size: 0.82rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .select-all-btn {
            background: none;
            border: none;
            color: var(--accent);
            font-size: 0.82rem;
            cursor: pointer;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .select-all-btn:hover { text-decoration: underline; }

        /* subject list */
        .subject-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            max-height: 380px;
            overflow-y: auto;
            padding-right: 4px;
            margin-bottom: 1.5rem;
        }
        .subject-list::-webkit-scrollbar { width: 4px; }
        .subject-list::-webkit-scrollbar-track { background: var(--surface2); border-radius: 99px; }
        .subject-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }

        /* checkbox row */
        .subject-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.85rem 1rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            user-select: none;
        }
        .subject-row:hover {
            border-color: rgba(108,99,255,0.3);
        }
        .subject-row.checked {
            border-color: var(--accent);
            background: rgba(108,99,255,0.08);
        }

        /* hide native checkbox */
        .subject-row input[type="checkbox"] {
            display: none;
        }

        /* custom checkbox */
        .custom-check {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 1.5px solid var(--border);
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.2s, border-color 0.2s;
        }
        .subject-row.checked .custom-check {
            background: var(--accent);
            border-color: var(--accent);
        }
        .custom-check svg {
            display: none;
        }
        .subject-row.checked .custom-check svg {
            display: block;
        }

        /* subject icon */
        .subject-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(108,99,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            flex-shrink: 0;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.95rem;
        }

        .subject-info { flex: 1; }
        .subject-info .s-name {
            font-weight: 500;
            font-size: 0.95rem;
        }
        .subject-info .s-id {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 2px;
        }
        .subject-info .s-id span {
            color: var(--accent);
        }

        /* selected count badge */
        .count-badge {
            display: none;
            padding: 0.2rem 0.7rem;
            background: rgba(108,99,255,0.15);
            border: 1px solid rgba(108,99,255,0.25);
            border-radius: 99px;
            font-size: 0.78rem;
            color: var(--accent);
            font-weight: 600;
        }
        .count-badge.visible { display: inline-block; }

        /* empty state */
        .empty {
            text-align: center;
            padding: 2rem;
            color: var(--muted);
            font-size: 0.9rem;
            border: 1px dashed var(--border);
            border-radius: 12px;
        }

        /* error */
        .error-msg {
            color: var(--accent2);
            font-size: 0.82rem;
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            background: rgba(255,101,132,0.08);
            border: 1px solid rgba(255,101,132,0.2);
            border-radius: 10px;
        }

        /* submit */
        .submit-btn {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-1px); }
        .submit-btn:active { transform: translateY(0); }
        .submit-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="container">

    <a href="{{ route('teacher.show', $teacher->id) }}" class="back-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M19 12H5M5 12l7-7M5 12l7 7"/>
        </svg>
        Back to {{ $teacher->name }}
    </a>

    <div class="card">
        <div class="card-header">
            <h1>Assign Subjects</h1>
            <p>Select one or more subjects to assign to this teacher</p>
        </div>

        {{-- Teacher badge --}}
        <div class="teacher-badge">
            <div class="dot"></div>
            Teacher — {{ $teacher->name }} &nbsp;·&nbsp; ID: {{ $teacher->id }}
        </div>

        <form action="{{ route('subject.create') }}" method="POST" id="assignForm">
            @csrf
            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">

            @if($subjects->count())

            {{-- Toolbar --}}
            <div class="toolbar">
                <span class="form-label">
                    Available Subjects
                    <span class="count-badge" id="countBadge">0 selected</span>
                </span>
                <button type="button" class="select-all-btn" id="selectAllBtn" onclick="toggleSelectAll()">
                    Select All
                </button>
            </div>

            {{-- Subject checkboxes --}}
            <div class="subject-list" id="subjectList">
                @foreach($subjects as $subject)
                <label class="subject-row" id="row-{{ $subject->id }}" onclick="toggleRow({{ $subject->id }})">
                    <input type="checkbox"
                           name="subject_ids[]"
                           value="{{ $subject->id }}"
                           id="chk-{{ $subject->id }}">

                    <div class="custom-check">
                        <svg width="12" height="12" fill="none" stroke="#fff" stroke-width="3" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <div class="subject-icon">
                        {{ strtoupper(substr($subject->name, 0, 2)) }}
                    </div>

                    <div class="subject-info">
                        <div class="s-name">{{ $subject->name }}</div>
                        <div class="s-id">
                            Subject ID: <span>{{ $subject->id }}</span>
                            &nbsp;·&nbsp;
                            Teacher ID: <span>{{ $teacher->id }}</span>
                        </div>
                    </div>
                </label>
                @endforeach
            </div>

            @error('subject_ids')
            <div class="error-msg">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit-btn" id="submitBtn" >
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12l7 7 7-7"/>
                </svg>
                Assign Selected Subjects
            </button>

            @else
            <div class="empty">
                All subjects are already assigned to this teacher
            </div>
            @endif

        </form>
    </div>
</div>

<script>
    let selectedCount = 0;
    const total = {{ $subjects->count() }};

    function toggleRow(id) {
        const chk = document.getElementById('chk-' + id);
        const row = document.getElementById('row-' + id);

        // toggle checkbox
        chk.checked = !chk.checked;
        row.classList.toggle('checked', chk.checked);

        selectedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
        updateUI();
    }

    function toggleSelectAll() {
        const allChecked = selectedCount === total;
        document.querySelectorAll('input[name="subject_ids[]"]').forEach(chk => {
            chk.checked = !allChecked;
            document.getElementById('row-' + chk.value)
                    .classList.toggle('checked', !allChecked);
        });
        selectedCount = allChecked ? 0 : total;
        updateUI();
    }

    function updateUI() {
        const badge      = document.getElementById('countBadge');
        const submitBtn  = document.getElementById('submitBtn');
        const selectBtn  = document.getElementById('selectAllBtn');

        // badge
        if (selectedCount > 0) {
            badge.textContent = selectedCount + ' selected';
            badge.classList.add('visible');
        } else {
            badge.classList.remove('visible');
        }

        // submit button
        submitBtn.disabled = selectedCount === 0;
        submitBtn.querySelector('span') && null;
        submitBtn.childNodes.forEach(n => {
            if (n.nodeType === 3) n.textContent = '';
        });

        // update button text
        const txt = submitBtn.lastChild;
        if (selectedCount > 0) {
            submitBtn.childNodes[submitBtn.childNodes.length - 1].textContent =
                ` Assign ${selectedCount} Subject${selectedCount > 1 ? 's' : ''}`;
        } else {
            submitBtn.childNodes[submitBtn.childNodes.length - 1].textContent =
                ' Assign Selected Subjects';
        }

        // select all label
        selectBtn.textContent = selectedCount === total ? 'Deselect All' : 'Select All';
    }
</script>
</body>
</html>
