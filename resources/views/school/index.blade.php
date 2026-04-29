@extends('app.layout') {{-- Change 'layouts.app' to your actual layout name --}}

@section('head')
<title>Home — SchoolMS</title>
@endsection

@section('styles')
<style>
/* ─── HOME PAGE STYLES ─── */
.home-wrap { padding-bottom: 3rem; }

/* ── Hero ── */
.hero {
    position: relative;
    padding: 5rem 2rem 4rem;
    text-align: center;
    overflow: hidden;
}
.hero-glow {
    position: absolute;
    width: 700px; height: 700px;
    border-radius: 50%;
    top: -200px; left: 50%;
    transform: translateX(-50%);
    background: radial-gradient(circle, rgba(108,99,255,0.18) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}
.hero-grid {
    position: absolute; inset: 0; z-index: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
    background-size: 40px 40px;
    mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
    -webkit-mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
}
.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 16px;
    background: rgba(108,99,255,0.12);
    border: 1px solid rgba(108,99,255,0.3);
    border-radius: 999px;
    font-size: 0.75rem; font-weight: 600;
    color: var(--accent);
    letter-spacing: 0.05em; text-transform: uppercase;
    margin-bottom: 1.5rem;
    position: relative; z-index: 1;
}
.hero-badge-dot {
    width: 6px; height: 6px;
    background: var(--accent3); border-radius: 50%;
    animation: hpulse 2s infinite;
}
@keyframes hpulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(1.4); }
}
.hero h1 {
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 800; line-height: 1.1;
    letter-spacing: -0.03em;
    position: relative; z-index: 1;
    margin-bottom: 1.25rem;
    color: var(--text);
}
.hero h1 span {
    background: linear-gradient(135deg, var(--accent), #a78bfa, var(--accent2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-sub {
    font-size: 1.05rem; color: var(--muted);
    max-width: 560px; margin: 0 auto 2.5rem;
    line-height: 1.7; position: relative; z-index: 1;
}
.hero-actions {
    display: flex; gap: 12px;
    justify-content: center; flex-wrap: wrap;
    position: relative; z-index: 1;
}

/* ── Buttons ── */
.btn-hp-primary {
    padding: 0.75rem 2rem;
    background: var(--accent); color: #fff;
    border: none; border-radius: 12px;
    font-size: 0.9rem; font-weight: 600;
    cursor: pointer; transition: all 0.2s;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-hp-primary:hover {
    background: #5a52e0;
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(108,99,255,0.35);
    color: #fff; text-decoration: none;
}
.btn-hp-secondary {
    padding: 0.75rem 2rem;
    background: var(--surface2); color: var(--text);
    border: 1px solid var(--border); border-radius: 12px;
    font-size: 0.9rem; font-weight: 600;
    cursor: pointer; transition: all 0.2s;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-hp-secondary:hover {
    border-color: rgba(108,99,255,0.4);
    background: rgba(108,99,255,0.08);
    transform: translateY(-1px);
    color: var(--text); text-decoration: none;
}
.btn-hp-sm {
    font-size: 0.8rem;
    padding: 0.5rem 1.25rem;
}

/* ── Stats Bar ── */
.stats-bar {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1px;
    background: var(--border);
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
}
.stat-item {
    background: var(--surface);
    padding: 1.5rem 2rem;
    text-align: center;
}
.stat-num {
    font-size: 1.8rem; font-weight: 800;
    letter-spacing: -0.03em; margin-bottom: 4px;
}
.stat-num.c-purple { color: var(--accent); }
.stat-num.c-green  { color: var(--accent3); }
.stat-num.c-pink   { color: var(--accent2); }
.stat-num.c-amber  { color: #f59e0b; }
.stat-lbl {
    font-size: 0.75rem; color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.08em; font-weight: 500;
}

/* ── Section ── */
.hp-section {
    padding: 4rem 2rem;
    max-width: 1200px;
    margin: 0 auto;
}
.hp-section-label {
    font-size: 0.72rem; font-weight: 700;
    color: var(--accent);
    text-transform: uppercase; letter-spacing: 0.12em;
    margin-bottom: 0.75rem;
}
.hp-section-title {
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800; letter-spacing: -0.02em;
    margin-bottom: 0.75rem; line-height: 1.2;
    color: var(--text);
}
.hp-section-sub {
    font-size: 0.95rem; color: var(--muted);
    line-height: 1.7; max-width: 520px;
}
.hp-section-header {
    display: flex; align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap; gap: 1rem;
}
.hp-divider {
    height: 1px;
    background: var(--border);
    margin: 0 2rem;
}

/* ── Feature Cards ── */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 3rem;
}
.feature-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 1.75rem;
    transition: all 0.3s;
    cursor: default;
    position: relative; overflow: hidden;
}
.feature-card::before {
    content: '';
    position: absolute; inset: 0;
    border-radius: 16px;
    opacity: 0; transition: opacity 0.3s;
    pointer-events: none;
    background: radial-gradient(circle at 50% 0%, rgba(108,99,255,0.06), transparent 70%);
}
.feature-card:hover {
    transform: translateY(-4px);
    border-color: rgba(108,99,255,0.3);
}
.feature-card:hover::before { opacity: 1; }
.feature-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 1.25rem; flex-shrink: 0;
}
.fi-purple { background: rgba(108,99,255,0.15); }
.fi-green  { background: rgba(67,233,123,0.12); }
.fi-pink   { background: rgba(255,101,132,0.12); }
.fi-amber  { background: rgba(245,158,11,0.12); }
.fi-blue   { background: rgba(56,189,248,0.12); }
.fi-teal   { background: rgba(20,184,166,0.12); }
.feature-card h3 {
    font-size: 1rem; font-weight: 700;
    margin-bottom: 0.5rem;
    letter-spacing: -0.01em;
    color: var(--text);
}
.feature-card p {
    font-size: 0.85rem;
    color: var(--muted);
    line-height: 1.6;
    margin: 0;
}

/* ── Two Column Layout ── */
.two-col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-top: 3rem;
}

/* ── Panel ── */
.hp-panel {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
}
.hp-panel-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
}
.hp-panel-title {
    font-size: 0.9rem; font-weight: 700;
    color: var(--text);
}
.hp-panel-badge {
    font-size: 0.7rem; font-weight: 600;
    padding: 3px 10px; border-radius: 99px;
    background: rgba(108,99,255,0.12);
    color: var(--accent);
}

/* ── Activity Feed ── */
.activity-list { padding: 0.5rem 0; }
.activity-item {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 0.875rem 1.5rem;
    transition: background 0.15s;
}
.activity-item:hover { background: var(--surface2); }
.activity-dot {
    width: 8px; height: 8px;
    border-radius: 50%; flex-shrink: 0; margin-top: 5px;
}
.ad-purple { background: var(--accent); }
.ad-green  { background: var(--accent3); }
.ad-pink   { background: var(--accent2); }
.ad-amber  { background: #f59e0b; }
.activity-content { flex: 1; min-width: 0; }
.activity-content strong {
    font-size: 0.85rem; font-weight: 600;
    display: block; margin-bottom: 2px;
    color: var(--text);
}
.activity-content span { font-size: 0.75rem; color: var(--muted); }
.activity-time { font-size: 0.7rem; color: var(--muted); flex-shrink: 0; margin-top: 2px; }

/* ── Quick Actions ── */
.quick-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: var(--border);
}
.quick-btn {
    background: var(--surface);
    padding: 1.25rem;
    display: flex; flex-direction: column;
    align-items: flex-start; gap: 10px;
    cursor: pointer; transition: background 0.15s;
    border: none; color: var(--text); text-align: left;
    width: 100%;
}
.quick-btn:hover { background: var(--surface2); }
.quick-btn-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
}
.quick-btn strong { font-size: 0.82rem; font-weight: 600; color: var(--text); }
.quick-btn small  { font-size: 0.72rem; color: var(--muted); }

/* ── Events ── */
.events-row {
    display: flex; gap: 1rem;
    overflow-x: auto; padding-bottom: 0.5rem;
    scrollbar-width: none; margin-top: 2rem;
}
.events-row::-webkit-scrollbar { display: none; }
.event-card {
    flex-shrink: 0; width: 220px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px; padding: 1.25rem;
    transition: all 0.2s;
}
.event-card:hover {
    border-color: rgba(108,99,255,0.3);
    transform: translateY(-2px);
}
.event-date-badge {
    display: inline-flex; flex-direction: column;
    align-items: center; padding: 8px 14px;
    border-radius: 10px; margin-bottom: 1rem;
}
.event-date-badge .day {
    font-size: 1.4rem; font-weight: 800; line-height: 1;
}
.event-date-badge .mon {
    font-size: 0.65rem; text-transform: uppercase;
    letter-spacing: 0.1em; font-weight: 600; margin-top: 2px;
}
.event-card h4 {
    font-size: 0.875rem; font-weight: 700;
    margin-bottom: 6px; color: var(--text);
}
.event-card p { font-size: 0.75rem; color: var(--muted); margin: 0; }

/* ── Announcement Banner ── */
.announce-wrap {
    max-width: 1200px; margin: 0 auto;
    padding: 0 2rem 4rem;
}
.announce-card {
    background: linear-gradient(135deg, rgba(108,99,255,0.12), rgba(255,101,132,0.08));
    border: 1px solid rgba(108,99,255,0.2);
    border-radius: 20px; padding: 2.5rem;
    display: flex; align-items: center;
    gap: 2rem; flex-wrap: wrap;
}
.announce-icon {
    width: 56px; height: 56px;
    border-radius: 16px;
    background: rgba(108,99,255,0.2);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.announce-content { flex: 1; min-width: 240px; }
.announce-content h3 {
    font-size: 1.1rem; font-weight: 800;
    margin-bottom: 6px; color: var(--text);
}
.announce-content p {
    font-size: 0.87rem; color: var(--muted);
    line-height: 1.6; margin: 0;
}
.announce-meta {
    display: flex; gap: 12px;
    margin-top: 12px; flex-wrap: wrap;
}
.announce-tag {
    font-size: 0.72rem; font-weight: 600;
    padding: 4px 12px; border-radius: 99px;
    background: rgba(108,99,255,0.15);
    color: var(--accent);
}
.announce-tag.green {
    background: rgba(67,233,123,0.12);
    color: var(--accent3);
}

/* ── Fade-in animation ── */
@keyframes hfadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
.hfade { animation: hfadeUp 0.6s ease forwards; }
.hd1   { animation-delay: 0.05s; opacity: 0; }
.hd2   { animation-delay: 0.15s; opacity: 0; }
.hd3   { animation-delay: 0.25s; opacity: 0; }
.hd4   { animation-delay: 0.35s; opacity: 0; }

/* ── Responsive ── */
@media (max-width: 768px) {
    .stats-bar      { grid-template-columns: repeat(2, 1fr); }
    .two-col        { grid-template-columns: 1fr; }
    .hero-actions   { flex-direction: column; align-items: center; }
}
@media (max-width: 480px) {
    .hero h1        { font-size: 2rem; }
    .stats-bar      { grid-template-columns: repeat(2, 1fr); }
}
</style>
@endsection

@section('content')
<div class="home-wrap">

    {{-- ─── HERO ─── --}}
    <section class="hero">
        <div class="hero-glow"></div>
        <div class="hero-grid"></div>

        <div class="hero-badge hfade">
            <span class="hero-badge-dot"></span>
            Academic Year 2025 – 2026
        </div>

        <h1 class="hfade hd1">
            Welcome to <span>SchoolMS</span><br>Management Portal
        </h1>

        <p class="hero-sub hfade hd2">
            Your unified hub for students, teachers, classes, and administration —
            all in one beautifully designed workspace.
        </p>

        <div class="hero-actions hfade hd3">
            @can('teacher-or-admin')
                <a href="{{ route('school.index') }}" class="btn-hp-primary">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                    </svg>
                    Go to Dashboard
                </a>
            @endcan

            @can('students')
                <a href="{{ route('student.profile', auth()->user()->student->id) }}" class="btn-hp-primary">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                    </svg>
                    My Dashboard
                </a>
            @endcan

            <a href="{{ route('profile.edit') }}" class="btn-hp-secondary">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 8 12 12 14 14"/>
                </svg>
                My Profile
            </a>
        </div>
    </section>

    {{-- ─── STATS BAR ─── --}}
    <div class="stats-bar hfade hd4">
        <div class="stat-item">
            <div class="stat-num c-purple">1,248</div>
            <div class="stat-lbl">Enrolled Students</div>
        </div>
        <div class="stat-item">
            <div class="stat-num c-green">87</div>
            <div class="stat-lbl">Active Teachers</div>
        </div>
        <div class="stat-item">
            <div class="stat-num c-amber">34</div>
            <div class="stat-lbl">Classes Running</div>
        </div>
        <div class="stat-item">
            <div class="stat-num c-pink">96%</div>
            <div class="stat-lbl">Attendance Rate</div>
        </div>
    </div>

    {{-- ─── FEATURES ─── --}}
    <section class="hp-section">
        <div class="hp-section-label">Core Modules</div>
        <h2 class="hp-section-title">Everything you need,<br>in one system</h2>
        <p class="hp-section-sub">Manage every aspect of your school with purpose-built tools designed for efficiency and clarity.</p>

        <div class="features-grid">

            @can('teacher-or-admin')
            <div class="feature-card">
                <div class="feature-icon fi-purple">
                    <svg width="20" height="20" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <h3>Student Management</h3>
                <p>Enroll, track, and manage student records, grades, attendance, and performance analytics in one place.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-green">
                    <svg width="20" height="20" fill="none" stroke="#43e97b" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                </div>
                <h3>Teacher Profiles</h3>
                <p>Maintain comprehensive teacher records including subjects taught, schedules, qualifications, and evaluations.</p>
            </div>
            @endcan

            @can('admins')
            <div class="feature-card">
                <div class="feature-icon fi-amber">
                    <svg width="20" height="20" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
                <h3>Class Organization</h3>
                <p>Organize students into classes, assign teachers, manage timetables, and monitor classroom capacity efficiently.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-blue">
                    <svg width="20" height="20" fill="none" stroke="#38bdf8" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                        <path d="M8 7h8M8 11h8M8 15h5"/>
                    </svg>
                </div>
                <h3>Subjects & Curriculum</h3>
                <p>Define subjects, link them to classes and teachers, and track curriculum coverage across all grade levels.</p>
            </div>
            @endcan

            <div class="feature-card">
                <div class="feature-icon fi-pink">
                    <svg width="20" height="20" fill="none" stroke="#ff6584" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>
                <h3>Attendance Tracking</h3>
                <p>Digital daily attendance with real-time reports, parent notifications, and trend analysis per class or student.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon fi-teal">
                    <svg width="20" height="20" fill="none" stroke="#14b8a6" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </div>
                <h3>Performance Reports</h3>
                <p>Generate detailed grade reports, exam results, and performance trends with exportable PDF summaries.</p>
            </div>

        </div>
    </section>

    <div class="hp-divider"></div>

    {{-- ─── ACTIVITY + QUICK ACTIONS ─── --}}
    <section class="hp-section">
        <div class="hp-section-header">
            <div>
                <div class="hp-section-label">Overview</div>
                <h2 class="hp-section-title">Live Activity</h2>
            </div>
            <a href="#" class="btn-hp-secondary btn-hp-sm">View All Activity →</a>
        </div>

        <div class="two-col">

            {{-- Activity Feed --}}
            <div class="hp-panel">
                <div class="hp-panel-header">
                    <span class="hp-panel-title">Recent Activity</span>
                    <span class="hp-panel-badge">Live</span>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-dot ad-green"></div>
                        <div class="activity-content">
                            <strong>New student enrolled in Class 10-B</strong>
                            <span>Admissions · Student Management</span>
                        </div>
                        <span class="activity-time">2m ago</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-purple"></div>
                        <div class="activity-content">
                            <strong>Math exam grades uploaded</strong>
                            <span>Grades · Class 9-A</span>
                        </div>
                        <span class="activity-time">15m ago</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-amber"></div>
                        <div class="activity-content">
                            <strong>Attendance report generated for November</strong>
                            <span>Reports · All Classes</span>
                        </div>
                        <span class="activity-time">1h ago</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-pink"></div>
                        <div class="activity-content">
                            <strong>New subject "Computer Science" added</strong>
                            <span>Curriculum · Admin</span>
                        </div>
                        <span class="activity-time">3h ago</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-green"></div>
                        <div class="activity-content">
                            <strong>Teacher profile updated</strong>
                            <span>Staff · Teacher Management</span>
                        </div>
                        <span class="activity-time">5h ago</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-purple"></div>
                        <div class="activity-content">
                            <strong>Class 11-C timetable revised</strong>
                            <span>Scheduling · Admin</span>
                        </div>
                        <span class="activity-time">Yesterday</span>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="hp-panel">
                <div class="hp-panel-header">
                    <span class="hp-panel-title">Quick Actions</span>
                </div>
                <div class="quick-grid">

                    @can('teacher-or-admin')
                    <a href="{{ URL('/student/create') }}" class="quick-btn" style="text-decoration:none">
                        <div class="quick-btn-icon" style="background:rgba(108,99,255,0.15)">
                            <svg width="16" height="16" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <line x1="19" y1="8" x2="19" y2="14"/>
                                <line x1="22" y1="11" x2="16" y2="11"/>
                            </svg>
                        </div>
                        <strong>Add Student</strong>
                        <small>Enroll new student</small>
                    </a>

                    <a href="{{ URL('/teacher/create') }}" class="quick-btn" style="text-decoration:none">
                        <div class="quick-btn-icon" style="background:rgba(67,233,123,0.12)">
                            <svg width="16" height="16" fill="none" stroke="#43e97b" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                                <line x1="19" y1="8" x2="19" y2="14"/>
                                <line x1="22" y1="11" x2="16" y2="11"/>
                            </svg>
                        </div>
                        <strong>Add Teacher</strong>
                        <small>Register staff member</small>
                    </a>
                    @endcan

                    @can('admins')
                    <a href="{{ URL('/class/create') }}" class="quick-btn" style="text-decoration:none">
                        <div class="quick-btn-icon" style="background:rgba(245,158,11,0.12)">
                            <svg width="16" height="16" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                <polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <strong>Create Class</strong>
                        <small>Set up new class</small>
                    </a>

                    <a href="{{ route('subject.create') }}" class="quick-btn" style="text-decoration:none">
                        <div class="quick-btn-icon" style="background:rgba(20,184,166,0.12)">
                            <svg width="16" height="16" fill="none" stroke="#14b8a6" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                            </svg>
                        </div>
                        <strong>Add Subject</strong>
                        <small>New curriculum item</small>
                    </a>
                    @endcan

                    <a href="#" class="quick-btn" style="text-decoration:none">
                        <div class="quick-btn-icon" style="background:rgba(255,101,132,0.12)">
                            <svg width="16" height="16" fill="none" stroke="#ff6584" stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                            </svg>
                        </div>
                        <strong>Reports</strong>
                        <small>Generate reports</small>
                    </a>

                    <a href="#" class="quick-btn" style="text-decoration:none">
                        <div class="quick-btn-icon" style="background:rgba(56,189,248,0.12)">
                            <svg width="16" height="16" fill="none" stroke="#38bdf8" stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="9 11 12 14 22 4"/>
                                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                            </svg>
                        </div>
                        <strong>Attendance</strong>
                        <small>Mark today's roll</small>
                    </a>

                </div>
            </div>

        </div>
    </section>

    <div class="hp-divider"></div>

    {{-- ─── UPCOMING EVENTS ─── --}}
    <section class="hp-section">
        <div class="hp-section-header">
            <div>
                <div class="hp-section-label">Calendar</div>
                <h2 class="hp-section-title">Upcoming Events</h2>
            </div>
            <a href="#" class="btn-hp-secondary btn-hp-sm">Full Calendar →</a>
        </div>

        <div class="events-row">
            <div class="event-card">
                <div class="event-date-badge" style="background:rgba(108,99,255,0.12)">
                    <span class="day" style="color:var(--accent)">18</span>
                    <span class="mon" style="color:var(--accent)">Nov</span>
                </div>
                <h4>Mid-Term Examinations</h4>
                <p>All classes · 3 days</p>
            </div>
            <div class="event-card">
                <div class="event-date-badge" style="background:rgba(67,233,123,0.1)">
                    <span class="day" style="color:var(--accent3)">22</span>
                    <span class="mon" style="color:var(--accent3)">Nov</span>
                </div>
                <h4>Parent–Teacher Meetings</h4>
                <p>Main Hall · 9:00 AM</p>
            </div>
            <div class="event-card">
                <div class="event-date-badge" style="background:rgba(245,158,11,0.1)">
                    <span class="day" style="color:#f59e0b">01</span>
                    <span class="mon" style="color:#f59e0b">Dec</span>
                </div>
                <h4>Science Fair 2025</h4>
                <p>Auditorium · All Day</p>
            </div>
            <div class="event-card">
                <div class="event-date-badge" style="background:rgba(255,101,132,0.1)">
                    <span class="day" style="color:var(--accent2)">10</span>
                    <span class="mon" style="color:var(--accent2)">Dec</span>
                </div>
                <h4>End-of-Term Ceremony</h4>
                <p>School Grounds · 11:00 AM</p>
            </div>
            <div class="event-card">
                <div class="event-date-badge" style="background:rgba(56,189,248,0.1)">
                    <span class="day" style="color:#38bdf8">15</span>
                    <span class="mon" style="color:#38bdf8">Dec</span>
                </div>
                <h4>Winter Break Begins</h4>
                <p>All students & staff</p>
            </div>
        </div>
    </section>

    {{-- ─── ANNOUNCEMENT BANNER ─── --}}
    <div class="announce-wrap">
        <div class="announce-card">
            <div class="announce-icon">
                <svg width="26" height="26" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 01-3.46 0"/>
                </svg>
            </div>
            <div class="announce-content">
                <h3>Registration for Q1 2026 is now open</h3>
                <p>New student registrations and class transfers for the upcoming academic quarter are now being accepted. Submit applications through the Student Management portal before December 31st.</p>
                <div class="announce-meta">
                    <span class="announce-tag">Deadline: Dec 31</span>
                    <span class="announce-tag green">Admissions Open</span>
                </div>
            </div>
            @can('teacher-or-admin')
                <a href="{{ URL('/student/create') }}" class="btn-hp-primary" style="flex-shrink:0">Apply Now →</a>
            @endcan
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    // Staggered fade-in on scroll for feature cards
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';
                entry.target.style.transition = `opacity 0.5s ease ${i * 0.08}s, transform 0.5s ease ${i * 0.08}s`;
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, 50);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.feature-card, .event-card').forEach(el => observer.observe(el));
</script>
@endsection
