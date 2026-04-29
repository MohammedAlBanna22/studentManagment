<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Subject — {{ $student->name }}</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans..." rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0a0a0f; --surface: #111118; --surface2: #1a1a24;
            --border: rgba(255,255,255,0.07); --accent: #6c63ff;
            --accent2: #ff6584; --accent3: #43e97b;
            --text: #f0f0f8; --muted: #8888aa;
        }
        body {
            background: var(--bg); color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh; display: flex;
            align-items: center; justify-content: center; padding: 2rem;
        }
        .container { width: 100%; max-width: 560px; }
        .back-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            color: var(--muted); text-decoration: none; font-size: 0.85rem;
            letter-spacing: 0.05em; text-transform: uppercase;
            margin-bottom: 2rem; transition: color 0.2s;
        }
        .back-btn:hover { color: var(--text); }
        .back-btn:hover svg { transform: translateX(-3px); }
        .back-btn svg { transition: transform 0.2s; }
        .card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 24px; padding: 2.5rem;
            box-shadow: 0 8px 40px rgba(0,0,0,0.5);
            animation: fadeUp 0.4s ease both;
        }
        .card-header { margin-bottom: 2rem; }
        .card-header h1 {
            font-family: 'Syne', sans-serif; font-size: 1.6rem;
            font-weight: 800; letter-spacing: -0.02em;
        }
        .card-header p { color: var(--muted); font-size: 0.9rem; margin-top: 0.4rem; }
        .student-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.4rem 1rem; background: rgba(108,99,255,0.1);
            border: 1px solid rgba(108,99,255,0.2); border-radius: 99px;
            font-size: 0.82rem; color: var(--accent); margin-bottom: 1.5rem;
        }
        .student-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--accent); }
        .field-group { display: flex; flex-direction: column; gap: 1.25rem; margin-bottom: 1.5rem; }
        .field { display: flex; flex-direction: column; gap: 0.5rem; }
        .form-label { font-size: 0.82rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.08em; }
        .select-wrapper { position: relative; }
        .select-wrapper select {
            width: 100%; padding: 0.85rem 2.5rem 0.85rem 1rem;
            background: var(--surface2); border: 1px solid var(--border);
            border-radius: 12px; color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem; appearance: none; cursor: pointer;
            transition: border-color 0.2s; outline: none;
        }
        .select-wrapper select:focus { border-color: var(--accent); background: rgba(108,99,255,0.05); }
        .select-wrapper select option { background: #1a1a24; }
        .select-wrapper::after {
            content: ''; position: absolute; right: 1rem; top: 50%;
            transform: translateY(-50%); border-left: 5px solid transparent;
            border-right: 5px solid transparent; border-top: 6px solid var(--muted);
            pointer-events: none;
        }
        .select-wrapper:focus-within::after { border-top-color: var(--accent); }
        .preview-row {
            display: none; align-items: center; gap: 0.75rem;
            padding: 0.75rem 1rem; background: rgba(108,99,255,0.06);
            border: 1px solid rgba(108,99,255,0.15);
            border-radius: 10px; margin-top: 0.5rem;
        }
        .preview-row.visible { display: flex; }
        .preview-icon {
            width: 34px; height: 34px; border-radius: 8px;
            background: rgba(108,99,255,0.15); display: flex;
            align-items: center; justify-content: center;
            color: var(--accent); font-family: 'Syne', sans-serif;
            font-weight: 800; font-size: 0.8rem; flex-shrink: 0;
        }
        .preview-info .p-name { font-size: 0.88rem; font-weight: 500; }
        .preview-info .p-id { font-size: 0.72rem; color: var(--muted); margin-top: 1px; }
        .preview-info .p-id span { color: var(--accent); }
        .divider { height: 1px; background: var(--border); margin: 0.25rem 0; }
        .error-msg {
            color: var(--accent2); font-size: 0.82rem; margin-bottom: 1rem;
            padding: 0.6rem 1rem; background: rgba(255,101,132,0.08);
            border: 1px solid rgba(255,101,132,0.2); border-radius: 10px;
        }
        .submit-btn {
            width: 100%; padding: 0.9rem;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            border: none; border-radius: 12px; color: #fff;
            font-family: 'Syne', sans-serif; font-size: 1rem;
            font-weight: 700; cursor: pointer;
            transition: opacity 0.2s, transform 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-1px); }
        .submit-btn:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="container">

    <a href="{{ route('student.profile', $student->id) }}" class="back-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M19 12H5M5 12l7-7M5 12l7 7"/>
        </svg>
        Back to {{ $student->name }}
    </a>

    <div class="card">
        <div class="card-header">
            <h1>Add Subject</h1>
            <p>Select a subject then the teacher will update</p>
        </div>

        <div class="student-badge">
            <div class="dot"></div>
            {{ $student->name }}
        </div>

        @if($errors->any())
        <div class="error-msg">
            @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
        </div>
        @endif

        <form action="{{ route('grade.store', $student->id) }}" method="POST">
            @csrf

            <div class="field-group">

                {{-- Subject Dropdown — loads all subjects first --}}
                <div class="field">
                    <label class="form-label">Subject</label>
                    <div class="select-wrapper">
                        <select name="subject_id" id="subject_id" required
                                onchange="loadTeachers(this.value)">
                            <option value="">-- Select Subject --</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Subject preview --}}
                    <div class="preview-row" id="subjectPreview">
                        <div class="preview-icon" id="subjectIcon"></div>
                        <div class="preview-info">
                            <div class="p-name" id="subjectName"></div>
                            <div class="p-id">Subject ID: <span id="subjectId"></span></div>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                {{-- Teacher Dropdown — filters by subject via AJAX --}}
                <div class="field">
                    <label class="form-label">Teacher</label>
                    <div class="select-wrapper">
                        <select name="teacher_id" id="teacher_id" required
                                onchange="showTeacherPreview(this)">
                            <option value="">-- Select Subject First --</option>
                        </select>
                    </div>
                    {{-- Teacher preview --}}
                    <div class="preview-row" id="teacherPreview">
                        <div class="preview-icon" id="teacherIcon"></div>
                        <div class="preview-info">
                            <div class="p-name" id="teacherName"></div>
                            <div class="p-id">Teacher ID: <span id="teacherId"></span></div>
                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="submit-btn" id="submitBtn" disabled>
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Add Subject
            </button>
        </form>
    </div>
</div>

<script>
// Step 1 — Subject selected → load teachers
function loadTeachers(subjectId) {
    const teacherSelect   = document.getElementById('teacher_id');
    const subjectPreview  = document.getElementById('subjectPreview');
    const subjectIcon     = document.getElementById('subjectIcon');
    const subjectNameEl   = document.getElementById('subjectName');
    const subjectIdEl     = document.getElementById('subjectId');
    const teacherPreview  = document.getElementById('teacherPreview');
    const btn             = document.getElementById('submitBtn');

    // Reset teacher dropdown and preview
    teacherSelect.innerHTML = '<option value="">Loading...</option>';
    teacherPreview.classList.remove('visible');
    btn.disabled = true;

    if (!subjectId) {
        teacherSelect.innerHTML = '<option value="">-- Select Subject First --</option>';
        subjectPreview.classList.remove('visible');
        return;
    }

    // Show subject preview
    const subjectSelect = document.getElementById('subject_id');
    const label = subjectSelect.options[subjectSelect.selectedIndex].textContent;
    subjectIcon.textContent   = label.substring(0, 2).toUpperCase();
    subjectNameEl.textContent = label;
    subjectIdEl.textContent   = subjectId;
    subjectPreview.classList.add('visible');

    // AJAX — fetch teachers by subject
    fetch(`/api/teachers-by-subject/${subjectId}`)
        .then(res => res.json())
        .then(teachers => {
            teacherSelect.innerHTML = '<option value="">-- Select Teacher --</option>';

            if (teachers.length === 0) {
                teacherSelect.innerHTML = '<option value="" disabled>No teachers found</option>';
                return;
            }

            teachers.forEach(t => {
                const opt = document.createElement('option');
                opt.value       = t.id;
                opt.textContent = t.name;
                teacherSelect.appendChild(opt);
            });

            // Auto select if only one teacher
            if (teachers.length === 1) {
                teacherSelect.value = teachers[0].id;
                showTeacherPreview(teacherSelect);
            }
        })
        .catch(() => {
            teacherSelect.innerHTML = '<option value="">Error loading teachers</option>';
        });
}

// Step 2 — Teacher selected → show preview + enable submit
function showTeacherPreview(select) {
    const preview = document.getElementById('teacherPreview');
    const icon    = document.getElementById('teacherIcon');
    const name    = document.getElementById('teacherName');
    const id      = document.getElementById('teacherId');
    const btn     = document.getElementById('submitBtn');

    if (select.value) {
        const label = select.options[select.selectedIndex].textContent;
        icon.textContent = label.substring(0, 2).toUpperCase();
        name.textContent = label;
        id.textContent   = select.value;
        preview.classList.add('visible');
        btn.disabled = false;
    } else {
        preview.classList.remove('visible');
        btn.disabled = true;
    }
}
</script>
</body>
</html>
