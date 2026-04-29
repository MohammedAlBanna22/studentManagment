{{-- resources/views/classes/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class — {{ $teacher->name }}</title>
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

        /* Field group */
        .field-group {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            font-size: 0.82rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* Select styling */
        .select-wrapper {
            position: relative;
        }

        .select-wrapper select {
            width: 100%;
            padding: 0.85rem 2.5rem 0.85rem 1rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            outline: none;
        }

        .select-wrapper select:hover {
            border-color: rgba(108,99,255,0.3);
        }

        .select-wrapper select:focus {
            border-color: var(--accent);
            background: rgba(108,99,255,0.05);
        }

        .select-wrapper select option {
            background: #1a1a24;
            color: var(--text);
        }

        /* Custom dropdown arrow */
        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid var(--muted);
            pointer-events: none;
            transition: border-top-color 0.2s;
        }

        .select-wrapper:focus-within::after {
            border-top-color: var(--accent);
        }

        /* Selected preview card */
        .preview-row {
            display: none;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: rgba(108,99,255,0.06);
            border: 1px solid rgba(108,99,255,0.15);
            border-radius: 10px;
            margin-top: 0.5rem;
        }
        .preview-row.visible { display: flex; }

        .preview-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(108,99,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .preview-info { flex: 1; }
        .preview-info .p-name {
            font-size: 0.88rem;
            font-weight: 500;
        }
        .preview-info .p-id {
            font-size: 0.72rem;
            color: var(--muted);
            margin-top: 1px;
        }
        .preview-info .p-id span { color: var(--accent); }

        .preview-check {
            color: var(--accent3);
        }

        /* Divider */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 0.25rem 0;
        }

        /* Error */
        .error-msg {
            color: var(--accent2);
            font-size: 0.82rem;
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            background: rgba(255,101,132,0.08);
            border: 1px solid rgba(255,101,132,0.2);
            border-radius: 10px;
        }

        /* Success */
        .success-msg {
            color: var(--accent3);
            font-size: 0.82rem;
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            background: rgba(67,233,123,0.08);
            border: 1px solid rgba(67,233,123,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Submit */
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

        /* Empty subjects */
        .empty {
            text-align: center;
            padding: 2rem;
            color: var(--muted);
            font-size: 0.9rem;
            border: 1px dashed var(--border);
            border-radius: 12px;
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
            <h1>Add Class</h1>
            <p>Assign a class and subject to this teacher</p>
        </div>

        {{-- Teacher badge --}}
        <div class="teacher-badge">
            <div class="dot"></div>
            Teacher — {{ $teacher->name }} &nbsp;·&nbsp; ID: {{ $teacher->id }}
        </div>

        @if(session('success'))
        <div class="success-msg">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="error-msg">{{ session('error') }}</div>
        @endif

        @if($errors->any())
        <div class="error-msg">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
        @endif

        @if($subjects->count())

        <form action="{{ route('SchoolClass.create') }}" method="POST" id="addClassForm">
            @csrf
            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">

            <div class="field-group">

                {{-- Class Dropdown --}}
                <div class="field">
                    <label class="form-label">Class</label>
                    <div class="select-wrapper">
                        <select name="class_id" id="classSelect" required onchange="updatePreview('class')">
                            <option value="">-- Select Class --</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    data-label="{{ $class->class_name }}"
                                    {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Class preview --}}
                    <div class="preview-row" id="classPreview">
                        <div class="preview-icon" id="classIcon"></div>
                        <div class="preview-info">
                            <div class="p-name" id="classPreviewName"></div>
                            <div class="p-id">Class ID: <span id="classPreviewId"></span></div>
                        </div>
                        <div class="preview-check">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                {{-- Subject Dropdown --}}
                <div class="field">
                    <label class="form-label">Subject</label>
                    <div class="select-wrapper">
                        <select name="subject_id" id="subjectSelect" required onchange="updatePreview('subject')">
                            <option value="">-- Select Subject --</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    data-label="{{ $subject->name }}"
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
                            <div class="p-name" id="subjectPreviewName"></div>
                            <div class="p-id">
                                Subject ID: <span id="subjectPreviewId"></span>
                                &nbsp;·&nbsp;
                                Teacher ID: <span>{{ $teacher->id }}</span>
                            </div>
                        </div>
                        <div class="preview-check">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="submit-btn" id="submitBtn" disabled>
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M12 5v14M5 12l7 7 7-7"/>
                </svg>
                Assign Class
            </button>

        </form>

        @else
        <div class="empty">
            No subjects are assigned to this teacher yet.
        </div>
        @endif

    </div>
</div>

<script>
    function updatePreview(type) {
        const select = document.getElementById(type === 'class' ? 'classSelect' : 'subjectSelect');
        const preview = document.getElementById(type === 'class' ? 'classPreview' : 'subjectPreview');
        const icon = document.getElementById(type === 'class' ? 'classIcon' : 'subjectIcon');
        const nameEl = document.getElementById(type === 'class' ? 'classPreviewName' : 'subjectPreviewName');
        const idEl = document.getElementById(type === 'class' ? 'classPreviewId' : 'subjectPreviewId');

        const selected = select.options[select.selectedIndex];

        if (select.value) {
            const label = selected.dataset.label;
            icon.textContent = label.substring(0, 2).toUpperCase();
            nameEl.textContent = label;
            idEl.textContent = select.value;
            preview.classList.add('visible');
        } else {
            preview.classList.remove('visible');
        }

        checkSubmit();
    }

    function checkSubmit() {
        const classVal   = document.getElementById('classSelect').value;
        const subjectVal = document.getElementById('subjectSelect').value;
        const btn        = document.getElementById('submitBtn');
        btn.disabled     = !(classVal && subjectVal);
    }

    // Restore old values on page load if validation failed
    window.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById('classSelect').value)   updatePreview('class');
        if (document.getElementById('subjectSelect').value) updatePreview('subject');
    });
</script>
</body>
</html>
