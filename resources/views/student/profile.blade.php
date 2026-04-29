
{{-- resources/views/students/show.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student->name }} — Profile</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans..." rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            --accent4: #f7971e;
            --text: #f0f0f8;
            --muted: #8888aa;
            --card-shadow: 0 8px 40px rgba(0,0,0,0.5);
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 860px;
            margin: 0 auto;
        }

        /* Back button */
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
        .back-btn:hover svg { transform: translateX(-3px); }
        .back-btn svg { transition: transform 0.2s; }

        /* Profile header card */
        .profile-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.4s ease both;
        }

        /* Avatar */
        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0;
            overflow: hidden;
        }
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info { flex: 1; }
        .profile-info h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .profile-info .class-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.8rem;
            background: rgba(108,99,255,0.1);
            border: 1px solid rgba(108,99,255,0.2);
            border-radius: 99px;
            font-size: 0.8rem;
            color: var(--accent);
            margin-top: 0.5rem;
        }
        .class-badge .dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent);
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.4s ease 0.1s both;
        }

        .info-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.2rem 1.4rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(108,99,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            flex-shrink: 0;
        }

        .info-content .label {
            font-size: 0.75rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.07em;
        }
        .info-content .value {
            font-size: 0.92rem;
            font-weight: 500;
            margin-top: 2px;
        }

        /* Gender badge colors */
        .gender-male   { color: #60a5fa; }
        .gender-female { color: #f472b6; }

        /* Subjects section */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            animation: fadeUp 0.4s ease 0.2s both;
        }
        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
        }

        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1.1rem;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.2s;
        }
        .add-btn:hover { opacity: 0.9; transform: translateY(-1px); }
        .add-btn:active { transform: translateY(0); }

        /* Subject list */
        .subject-list {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
            animation: fadeUp 0.4s ease 0.3s both;
        }

        .subject-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.2rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            transition: border-color 0.2s;
        }
        .subject-row:hover { border-color: rgba(108,99,255,0.3); }

        .subject-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: rgba(108,99,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .subject-info { flex: 1; }
        .subject-info .s-name {
            font-weight: 600;
            font-size: 0.95rem;
        }
        .subject-info .s-meta {
            font-size: 0.78rem;
            color: var(--muted);
            margin-top: 3px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .s-meta span { color: var(--accent); }

        /* Grade badge */
        .grade-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
        }
        .grade-high   { background: rgba(67,233,123,0.1);  color: var(--accent3); border: 1px solid rgba(67,233,123,0.2);  }
        .grade-mid    { background: rgba(247,151,30,0.1);  color: var(--accent4); border: 1px solid rgba(247,151,30,0.2);  }
        .grade-low    { background: rgba(255,101,132,0.1); color: var(--accent2); border: 1px solid rgba(255,101,132,0.2); }
        .grade-none   { background: rgba(255,255,255,0.05); color: var(--muted);  border: 1px solid var(--border); }

        /* Empty state */
        .empty {
            text-align: center;
            padding: 2.5rem;
            color: var(--muted);
            font-size: 0.9rem;
            border: 1px dashed var(--border);
            border-radius: 14px;
        }
        .empty svg { margin-bottom: 0.75rem; opacity: 0.4; }

        /* Success / error */
        .alert {
            padding: 0.6rem 1rem;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .alert-success {
            background: rgba(67,233,123,0.08);
            border: 1px solid rgba(67,233,123,0.2);
            color: var(--accent3);
        }
        .alert-error {
            background: rgba(255,101,132,0.08);
            border: 1px solid rgba(255,101,132,0.2);
            color: var(--accent2);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            .info-grid { grid-template-columns: 1fr; }
            .profile-card { flex-direction: column; text-align: center; }
        }
        .btn-delete {
    background: #e3342f;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
    cursor: pointer;
}


    </style>
</head>
<body>
<div class="container">
@can('teacher-or-admin')
    <a href="{{ route('students.index') }}" class="back-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M19 12H5M5 12l7-7M5 12l7 7"/>
        </svg>
        Back to Students
    </a>
@endcan

@can('students')
    <a href="{{ route('school.index') }}" class="back-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M19 12H5M5 12l7-7M5 12l7 7"/>
        </svg>
        Back to home
    </a>
@endcan



    @if(session('success'))
    <div class="alert alert-success">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    {{-- Profile Header --}}
    <div class="profile-card">
        <div class="avatar">
            @if($student->image)
                <img src="{{ asset('storage/' . $student->image) }}" alt="{{ $student->name }}">
            @else
                {{ strtoupper(substr($student->name, 0, 2)) }}
            @endif
        </div>

        <div class="profile-info">
            <h1>{{ $student->name }}</h1>

                <div class="dot"></div>
                @forelse ($student->className as $class)
                <div class="class-badge">  <span>{{ $class->name ?? 'No Class' }}</span></div>

                @endforeach


        </div>
    </div>

    {{-- Info Grid --}}
    <div class="info-grid">

        <div class="info-card">
            <div class="info-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 4h16v16H4z M8 2v4 M16 2v4 M4 10h16"/>
                </svg>
            </div>
            <div class="info-content">
                <div class="label">Date of Birth</div>
                <div class="value">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') }}</div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
            </div>
            <div class="info-content">
                <div class="label">Gender</div>
                <div class="value {{ $student->gender === 'male' ? 'gender-male' : 'gender-female' }}">
                    {{ ucfirst($student->gender) }}
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 16.92V19a2 2 0 01-2 2A18 18 0 013 4a2 2 0 012-2h2.09a2 2 0 012 1.72c.13 1 .37 1.97.72 2.9a2 2 0 01-.45 2.11L8.09 9a16 16 0 006.91 6.91l1.27-1.27a2 2 0 012.11-.45c.93.35 1.9.59 2.9.72A2 2 0 0122 16.92z"/>
                </svg>
            </div>
            <div class="info-content">
                <div class="label">Phone</div>
                <div class="value">{{ $student->phone ?? '—' }}</div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 4h16v2L12 13 4 6V4z M4 6v14h16V6"/>
                </svg>
            </div>
            <div class="info-content">
                <div class="label">Email</div>
                <div class="value">{{ $student->email ?? '—' }}</div>
            </div>
        </div>

        <div class="info-card" style="grid-column: span 2">
            <div class="info-icon">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z"/>
                </svg>
            </div>
            <div class="info-content">
                <div class="label">Address</div>
                <div class="value">{{ $student->address ?? '—' }}</div>
            </div>
        </div>

    </div>

    {{-- Subjects Section --}}
    <div class="section-header">
        <span class="section-title">Subjects</span>
        <a href="{{ route('grade.create', $student) }}" class="add-btn">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Subject
        </a>
    </div>

    <div class="subject-list">
        @forelse($student->subjects as $subject)
        <div class="subject-row">
            <div class="subject-icon">
                {{ strtoupper(substr($subject->name, 0, 2)) }}
            </div>
            <div class="subject-info">
                <div class="s-name">{{ $subject->name }}</div>
                <div class="s-meta">
                    teacher: <span>{{ $subject->pivot->teacher->name ?? '—' }}</span>
                </div>
            </div>

            {{-- Grade badge --}}
            @php
                $grade = $subject->pivot->grade;
                $gradeClass = is_null($grade) ? 'grade-none'
                    : ($grade >= 85 ? 'grade-high'
                    : ($grade >= 60 ? 'grade-mid' : 'grade-low'));
                $gradeLabel = is_null($grade) ? 'No Grade' : $grade . '%';
            @endphp
            <span class="grade-badge {{ $gradeClass }}">{{ $gradeLabel }} </span>
            <span class="grade-badge {{ $gradeClass }}">{{ $gradeClass}}</span>

                      {{-- ✅ DELETE BUTTON --}}
        <form action="{{ route('student.subject.delete', [$student->id, $subject->id]) }}"
              method="POST"
              onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn-delete">
                Delete
            </button>
        </form>

        </div>



        @empty
        <div class="empty">
            <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <p>No subjects assigned yet.</p>
            <p style="margin-top: 0.4rem; font-size:0.8rem">Click <strong style="color:var(--accent)">Add Subject</strong> to get started</p>
        </div>
        @endforelse
    </div>

</div>
</body>
</html>
