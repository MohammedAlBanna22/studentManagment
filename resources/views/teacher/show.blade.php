<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $teacher->name }} — Profile</title>
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
            padding: 2rem;
            overflow-x: hidden;
        }

        /* Ambient background glow */
        body::before {
            content: '';
            position: fixed;
            top: -20%;
            left: -10%;
            width: 60vw;
            height: 60vw;
            background: radial-gradient(circle, rgba(108,99,255,0.08) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -20%;
            right: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(255,101,132,0.06) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Back button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--muted);
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 2.5rem;
            transition: color 0.2s;
        }
        .back-btn:hover { color: var(--text); }
        .back-btn svg { transition: transform 0.2s; }
        .back-btn:hover svg { transform: translateX(-3px); }

        /* Hero card */
        .hero {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 2rem;
            align-items: center;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
            animation: fadeUp 0.5s ease both;
        }

        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 0 0 4px rgba(108,99,255,0.2);
        }

        .hero-info h1 {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.02em;
        }

        .hero-meta {
            display: flex;
            gap: 1.5rem;
            margin-top: 0.75rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--muted);
            font-size: 0.9rem;
        }
        .meta-item svg { opacity: 0.6; }

        .hero-stats {
            display: flex;
            gap: 1.5rem;
        }

        .stat {
            text-align: center;
            padding: 1rem 1.5rem;
            background: var(--surface2);
            border-radius: 16px;
            border: 1px solid var(--border);
        }
        .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-label {
            font-size: 0.75rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 0.2rem;
        }

        /* Grid layout */
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Section cards */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.75rem;
            box-shadow: var(--card-shadow);
            animation: fadeUp 0.5s ease both;
        }
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card.full { grid-column: 1 / -1; animation-delay: 0.3s; }

        .card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .card-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .icon-purple { background: rgba(108,99,255,0.15); color: var(--accent); }
        .icon-pink   { background: rgba(255,101,132,0.15); color: var(--accent2); }
        .icon-green  { background: rgba(67,233,123,0.15); color: var(--accent3); }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        /* Classes list */
        .class-list {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .class-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1rem;
            background: var(--surface2);
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: border-color 0.2s, transform 0.2s;
        }
        .class-item:hover {
            border-color: rgba(108,99,255,0.3);
            transform: translateX(4px);
        }
        .class-name {
            font-weight: 500;
            font-size: 0.95rem;
        }
        .class-badge {
            font-size: 0.72rem;
            padding: 0.2rem 0.6rem;
            border-radius: 99px;
            background: rgba(108,99,255,0.15);
            color: var(--accent);
            font-weight: 500;
        }

        /* Subjects with students */
       .subject-block {
    width: 100%;        /* ← add this */
    margin-bottom: 1.25rem;
}
        .subject-block:last-child { margin-bottom: 0; }

    .subject-header {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.7rem 1rem;
    background: linear-gradient(135deg, rgba(255,101,132,0.1), rgba(108,99,255,0.1));
    border-radius: 10px;
    margin-bottom: 0.75rem;
    border: 1px solid rgba(255,101,132,0.15);
    width: 100%;        /* ← add this */
}
        .subject-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent2);
            flex-shrink: 0;
        }
        .subject-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .students-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding-left: 0.5rem;
        }

        .student-chip {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.75rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 99px;
            font-size: 0.82rem;
            color: var(--muted);
            transition: all 0.2s;
        }
        .student-chip:hover {
            border-color: rgba(67,233,123,0.3);
            color: var(--accent3);
        }
        .student-chip-avatar {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent3), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .empty {
            color: var(--muted);
            font-size: 0.85rem;
            text-align: center;
            padding: 1.5rem;
            border: 1px dashed var(--border);
            border-radius: 12px;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .hero { grid-template-columns: 1fr; text-align: center; }
            .hero-meta { justify-content: center; }
            .hero-stats { justify-content: center; }
            .grid { grid-template-columns: 1fr; }
            .card.full { grid-column: 1; }
        }
        .addClassButton {
            background-color: #041d8b;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            margin-left: 250px;
        }

              .addSubjectsButton {
            background-color: #041d8b;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            margin-left: 220px;
        }

        show-more-a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;
    border: 1.5px dashed rgba(255,255,255,0.15);
    border-radius: 10px;
    background: var(--surface2);
    cursor: pointer;
    width: 100%;
    color: var(--muted);
    font-size: 0.85rem;
    transition: border-color 0.2s, color 0.2s;
}
.show-more-a:hover {
    border-color: var(--accent);
    color: var(--accent);
}
.show-more-a .avatars span {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    border: 2px solid var(--surface);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 700;
    color: #fff;
    margin-left: -6px;
}
.show-more-a .avatars span:first-child { margin-left: 0; }
    </style>
</head>
<body>
<div class="container">
 @can('admins')
    <a href="{{ url('teacher') }}" class="back-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M5 12l7-7M5 12l7 7"/></svg>
        Back to Teachers
    </a>
    @endcan


     @can('teachers')
    <a href="{{ route('school.index') }}" class="back-btn">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M5 12l7-7M5 12l7 7"/></svg>
        Back to Home
    </a>
    @endcan

    {{-- Hero Card --}}
    <div class="hero">
        @if (count($teacher->images) > 0)

    <div class="avatar" style="padding:0;overflow:hidden;">
        <img src="{{ asset('storage/' . $teacher->images->first()->path) }}"
             alt="{{ $teacher->name }}"
             style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
    </div>
    @else
    <div class="avatar">{{ strtoupper(substr($teacher->name, 0, 1)) }}</div>
    @endif
        <div class="hero-info">
            <h1>{{ $teacher->name }}</h1>
            <div class="hero-meta">
                @if($teacher->email)
                <span class="meta-item">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg>
                    {{ $teacher->email }}
                </span>
                @endif
                @if($teacher->phone)
                <span class="meta-item">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.63A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                    {{ $teacher->phone }}
                </span>
                @endif
            </div>
        </div>

        <div class="hero-stats">
            <div class="stat">
                <div class="stat-num">{{ $teacher->class->count() }}</div>
                <div class="stat-label">Classes</div>
            </div>
            <div class="stat">
                <div class="stat-num"> {{  $teacher->subjects->count() }}</div>
                <div class="stat-label">Subjects</div>
            </div>
            <div class="stat">
                <div class="stat-num">{{ $teacher->students->count() }}</p> </div>
                <div class="stat-label">Students</div>
            </div>
        </div>
    </div>

    <div class="grid">

        {{-- Classes --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon icon-purple">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <span class="card-title">Classes</span>
                <a href="{{ route('SchoolClass.addByteacher',$teacher->id)}}" class="addClassButton">Add classes</a>
            </div>
            @if($teacher->class->count())
            <div class="class-list">
                @foreach($teacher->class as $class)

                <div class="class-item">
                    <span class="class-name">{{ $class->name }}</span>

                        <span class="class-name">{{$class->description}}</span>


                    <span class="class-badge">Active</span>
                </div>

                @endforeach
            </div>
            @else
            <div class="empty">No classes assigned</div>
            @endif
        </div>

        {{-- Subjects --}}
        <div class="card">
            <div class="card-header">
                <div class="card-icon icon-pink">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                </div>
                <span class="card-title">Subjects</span>
                <a href="{{ URL('subject/add',$teacher->id)}}" class="addSubjectsButton">Add Subjects</a>
            </div>
 <!-- #region -->
            @if($teacher->subjects->count())
            <div class="class-list">
                  @foreach($teacher->subjects as $subject)
                <div class="class-item">
                    <span class="class-name">  {{ $subject->name }} subject</span>
                    <span class="class-badge" style="background:rgba(255,101,132,0.15);color:var(--accent2);">{{-- - {{ $subject->students->count() }}--}} students</span>
                </div>
                 @endforeach
            </div>
             @else
            <div class="empty">No subjects assigned</div>
            @endif
        </div>

      {{-- Students per subject --}}
<div class="card full">
    <div class="card-header">
        <span class="card-title">Students by Subject</span>
    </div>

    @if($subjectsWithStudents->count())
        @foreach($subjectsWithStudents as $subject)
            <div class="subject-block">
                <div class="subject-header">
                    <div class="subject-dot"></div>
                    <span class="subject-name">{{ $subject->name }}</span>

                </div>

                <div class="students-grid" id="grid-{{ $subject->id }}">
                    @forelse($subject->studentList as $index => $student)
                        <div class="student-chip"
                             style="{{ $index >= 5 ? 'display:none;' : '' }}"
                             data-extra="{{ $index >= 5 ? '1' : '0' }}"
                             data-grid="{{ $subject->id }}">
                            <div class="student-chip-avatar">
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            </div>
                            {{ $student->name }}
                            {{-- Class name --}}
                            <span class="student-class">
                                {{ $student->schoolClass->class_name ?? '—' }}
                            </span>
                        </div>
                    @empty
                        <div class="empty " style="width:300px; height:50px; padding: 20px;">No students for this subject</div>
                    @endforelse
                </div>

                @if($subject->total_students > 5)
                    <div style="margin-top: 8px; padding-left: 6px;">
                        <a href="#" class="show-more-btn"
                           data-grid="{{ $subject->id }}"
                           data-remaining="{{ $subject->total_students - 5 }}"
                           data-expanded="false"
                           onclick="toggleStudents(this)">
                            + {{ $subject->total_students - 5 }} more students
                        </a>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="empty">No subjects to display</div>
    @endif
</div>



    </div>
</div>
</body>
</html>
