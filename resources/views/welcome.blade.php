<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SchoolMS — School Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans..." rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --accent: #6c63ff;
            --accent2: #ff6584;
            --accent3: #43e97b;
        }

        * { box-sizing: border-box; }

        body { font-family: 'Instrument Sans', system-ui, sans-serif; }

        .font-display { font-family: 'Syne', system-ui, sans-serif; }

        /* ── Animated grid background ── */
        .grid-bg {
            background-image:
                linear-gradient(rgba(108,99,255,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108,99,255,0.06) 1px, transparent 1px);
            background-size: 44px 44px;
        }
        .dark .grid-bg {
            background-image:
                linear-gradient(rgba(108,99,255,0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108,99,255,0.1) 1px, transparent 1px);
        }

        /* ── Glowing orb ── */
        .glow-orb {
            background: radial-gradient(circle, rgba(108,99,255,0.35) 0%, transparent 65%);
            animation: orbpulse 4s ease-in-out infinite;
        }
        .dark .glow-orb {
            background: radial-gradient(circle, rgba(108,99,255,0.25) 0%, transparent 65%);
        }
        @keyframes orbpulse {
            0%, 100% { transform: scale(1); opacity: 0.7; }
            50%       { transform: scale(1.08); opacity: 1; }
        }

        /* ── Fade-up entries ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up-1 { animation: fadeUp 0.7s ease 0.05s both; }
        .fade-up-2 { animation: fadeUp 0.7s ease 0.18s both; }
        .fade-up-3 { animation: fadeUp 0.7s ease 0.30s both; }
        .fade-up-4 { animation: fadeUp 0.7s ease 0.42s both; }
        .fade-up-5 { animation: fadeUp 0.7s ease 0.54s both; }

        /* ── Stat card accent bar ── */
        .stat-bar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            border-radius: 99px;
        }
        .stat-bar-purple::before { background: #6c63ff; }
        .stat-bar-green::before  { background: #43e97b; }
        .stat-bar-amber::before  { background: #f59e0b; }
        .stat-bar-pink::before   { background: #ff6584; }

        /* ── Feature card hover glow ── */
        .feature-card {
            transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        }
        .feature-card:hover {
            transform: translateY(-4px);
        }

        /* ── Dot pulse ── */
        .dot-pulse {
            animation: dotpulse 2s ease-in-out infinite;
        }
        @keyframes dotpulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.4; transform: scale(1.5); }
        }

        /* ── Activity dot ── */
        .activity-row { transition: background 0.15s; }
        .activity-row:hover { background: rgba(108,99,255,0.05); }
        .dark .activity-row:hover { background: rgba(108,99,255,0.08); }

        /* ── Scrollbar ── */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { scrollbar-width: none; }

        /* ── Shimmer on badge ── */
        .badge-shimmer {
            position: relative;
            overflow: hidden;
        }
        .badge-shimmer::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            animation: shimmer 3s infinite;
        }
        @keyframes shimmer {
            0%   { left: -100%; }
            100% { left: 200%; }
        }
    </style>
</head>

<body class="bg-[#f4f3ff] dark:bg-[#0a0a0f] text-[#1a1a2e] dark:text-[#f0f0f8] min-h-screen antialiased">

    {{-- ════════════════════════════════════════ --}}
    {{--  TOP NAV                                  --}}
    {{-- ════════════════════════════════════════ --}}
    <header class="fixed top-0 left-0 right-0 z-50 border-b border-[#6c63ff]/10 dark:border-white/5"
            style="background: rgba(244,243,255,0.85); backdrop-filter: blur(16px);">
        <div class="dark:hidden absolute inset-0" style="background: rgba(244,243,255,0.85);"></div>
        <div class="hidden dark:block absolute inset-0" style="background: rgba(10,10,15,0.85);"></div>

        <div class="relative max-w-7xl mx-auto px-6 h-16 flex items-center gap-4">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 mr-auto no-underline">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                     style="background: linear-gradient(135deg, #6c63ff, #8b5cf6);">
                    <svg width="15" height="15" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <span class="font-display font-800 text-base tracking-tight text-[#1a1a2e] dark:text-[#f0f0f8]">
                    School<span style="color:#6c63ff">MS</span>
                </span>
            </a>

            {{-- Nav links (hidden on small screens) --}}
            <nav class="hidden md:flex items-center gap-1">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('school.index') }}"
                           class="px-4 py-1.5 rounded-lg text-sm font-medium text-[#444] dark:text-[#aaa]
                                  hover:text-[#6c63ff] hover:bg-[#6c63ff]/08 transition-all duration-150 no-underline">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-1.5 rounded-lg text-sm font-medium text-[#444] dark:text-[#aaa]
                                  hover:text-[#6c63ff] hover:bg-[#6c63ff]/08 transition-all duration-150 no-underline">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-4 py-1.5 rounded-lg text-sm font-semibold text-white
                                      transition-all duration-150 no-underline"
                               style="background: #6c63ff;">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif



            </nav>
        </div>
    </header>

    {{-- ════════════════════════════════════════ --}}
    {{--  HERO                                     --}}
    {{-- ════════════════════════════════════════ --}}
    <section class="relative pt-28 pb-20 px-6 overflow-hidden grid-bg">

        {{-- Glow orb --}}
        <div class="glow-orb absolute top-[-160px] left-1/2 -translate-x-1/2 w-[700px] h-[700px] rounded-full pointer-events-none"></div>

        {{-- Mask fade-out bottom --}}
        <div class="absolute bottom-0 left-0 right-0 h-32 pointer-events-none"
             style="background: linear-gradient(to bottom, transparent, #f4f3ff);"></div>
        <div class="hidden dark:block absolute bottom-0 left-0 right-0 h-32 pointer-events-none"
             style="background: linear-gradient(to bottom, transparent, #0a0a0f);"></div>

        <div class="relative max-w-4xl mx-auto text-center">

            {{-- Badge --}}
            <div class="fade-up-1 inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase mb-6 badge-shimmer"
                 style="background: rgba(108,99,255,0.12); border: 1px solid rgba(108,99,255,0.28); color: #6c63ff;">
                <span class="dot-pulse w-1.5 h-1.5 rounded-full inline-block" style="background:#43e97b;"></span>
                Academic Year 2025 – 2026 &nbsp;·&nbsp; Live System
            </div>

            {{-- Headline --}}
            <h1 class="fade-up-2 font-display font-extrabold leading-tight tracking-tight mb-5"
                style="font-size: clamp(2.4rem, 6vw, 4.2rem);">
                The smarter way to<br>
                <span style="background: linear-gradient(135deg, #6c63ff, #a78bfa, #ff6584);
                             -webkit-background-clip: text; -webkit-text-fill-color: transparent;
                             background-clip: text;">
                    run your school
                </span>
            </h1>

            {{-- Subtext --}}
            <p class="fade-up-3 text-base leading-relaxed text-[#666688] dark:text-[#8888aa] max-w-xl mx-auto mb-8">
                SchoolMS unifies students, teachers, classes, and administration into
                one beautifully crafted management portal — fast, reliable, and always in sync.
            </p>

            {{-- CTAs --}}
            <div class="fade-up-4 flex items-center justify-center gap-3 flex-wrap">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold text-white no-underline transition-all hover:opacity-90 hover:-translate-y-px"
                       style="background: #6c63ff; box-shadow: 0 8px 24px rgba(108,99,255,0.35);">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        Open Dashboard
                    </a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold text-white no-underline transition-all hover:opacity-90 hover:-translate-y-px"
                           style="background: #6c63ff; box-shadow: 0 8px 24px rgba(108,99,255,0.35);">
                            Get Started Free
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold no-underline transition-all hover:-translate-y-px"
                           style="background: rgba(108,99,255,0.08); border: 1px solid rgba(108,99,255,0.2); color: #6c63ff;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/></svg>
                            Log In
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════ --}}
    {{--  STATS STRIP                              --}}
    {{-- ════════════════════════════════════════ --}}
    <section class="fade-up-5 border-y border-[#6c63ff]/08 dark:border-white/05"
             style="background: rgba(255,255,255,0.7);">
        <div class="hidden dark:block absolute inset-0"
             style="background: rgba(17,17,24,0.7);"></div>
        <div class="relative max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4">
            <div class="stat-bar stat-bar-purple relative text-center py-7 px-4 border-r border-[#6c63ff]/08 dark:border-white/05">
                <div class="font-display text-3xl font-extrabold tracking-tight" style="color:#6c63ff;">1,248</div>
                <div class="text-xs font-semibold uppercase tracking-widest text-[#888] mt-1">Students</div>
            </div>
            <div class="stat-bar stat-bar-green relative text-center py-7 px-4 border-r border-[#6c63ff]/08 dark:border-white/05 md:border-r">
                <div class="font-display text-3xl font-extrabold tracking-tight" style="color:#43e97b;">87</div>
                <div class="text-xs font-semibold uppercase tracking-widest text-[#888] mt-1">Teachers</div>
            </div>
            <div class="stat-bar stat-bar-amber relative text-center py-7 px-4 border-r border-[#6c63ff]/08 dark:border-white/05">
                <div class="font-display text-3xl font-extrabold tracking-tight" style="color:#f59e0b;">34</div>
                <div class="text-xs font-semibold uppercase tracking-widest text-[#888] mt-1">Classes</div>
            </div>
            <div class="stat-bar stat-bar-pink relative text-center py-7 px-4">
                <div class="font-display text-3xl font-extrabold tracking-tight" style="color:#ff6584;">96%</div>
                <div class="text-xs font-semibold uppercase tracking-widest text-[#888] mt-1">Attendance</div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════ --}}
    {{--  FEATURES                                 --}}
    {{-- ════════════════════════════════════════ --}}
    <section class="py-20 px-6">
        <div class="max-w-5xl mx-auto">

            <div class="text-center mb-14">
                <div class="inline-block text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-3"
                     style="background:rgba(108,99,255,0.1); color:#6c63ff;">Core Modules</div>
                <h2 class="font-display text-3xl md:text-4xl font-extrabold tracking-tight">
                    Everything in one system
                </h2>
                <p class="text-sm text-[#666688] dark:text-[#8888aa] mt-3 max-w-md mx-auto leading-relaxed">
                    Purpose-built tools for every aspect of school management — fast and intuitive.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                {{-- Feature 1 --}}
                <div class="feature-card relative p-6 rounded-2xl border border-[#6c63ff]/10 dark:border-white/06
                            bg-white dark:bg-[#111118] hover:border-[#6c63ff]/30 hover:shadow-[0_8px_32px_rgba(108,99,255,0.12)]">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
                         style="background:rgba(108,99,255,0.12);">
                        <svg width="20" height="20" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-sm mb-2">Student Management</h3>
                    <p class="text-xs leading-relaxed text-[#666688] dark:text-[#8888aa]">
                        Enroll, track, and manage student records, grades, and attendance all in one place.
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div class="feature-card relative p-6 rounded-2xl border border-[#6c63ff]/10 dark:border-white/06
                            bg-white dark:bg-[#111118] hover:border-[#43e97b]/40 hover:shadow-[0_8px_32px_rgba(67,233,123,0.1)]">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
                         style="background:rgba(67,233,123,0.10);">
                        <svg width="20" height="20" fill="none" stroke="#43e97b" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-sm mb-2">Teacher Profiles</h3>
                    <p class="text-xs leading-relaxed text-[#666688] dark:text-[#8888aa]">
                        Maintain comprehensive teacher records including schedules and qualifications.
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div class="feature-card relative p-6 rounded-2xl border border-[#6c63ff]/10 dark:border-white/06
                            bg-white dark:bg-[#111118] hover:border-[#f59e0b]/40 hover:shadow-[0_8px_32px_rgba(245,158,11,0.1)]">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
                         style="background:rgba(245,158,11,0.10);">
                        <svg width="20" height="20" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-sm mb-2">Class Organization</h3>
                    <p class="text-xs leading-relaxed text-[#666688] dark:text-[#8888aa]">
                        Organize students into classes, assign teachers, and manage timetables with ease.
                    </p>
                </div>

                {{-- Feature 4 --}}
                <div class="feature-card relative p-6 rounded-2xl border border-[#6c63ff]/10 dark:border-white/06
                            bg-white dark:bg-[#111118] hover:border-[#38bdf8]/40 hover:shadow-[0_8px_32px_rgba(56,189,248,0.1)]">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
                         style="background:rgba(56,189,248,0.10);">
                        <svg width="20" height="20" fill="none" stroke="#38bdf8" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                            <path d="M8 7h8M8 11h8M8 15h5"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-sm mb-2">Subjects & Curriculum</h3>
                    <p class="text-xs leading-relaxed text-[#666688] dark:text-[#8888aa]">
                        Define subjects, link them to classes and teachers, track curriculum coverage.
                    </p>
                </div>

                {{-- Feature 5 --}}
                <div class="feature-card relative p-6 rounded-2xl border border-[#6c63ff]/10 dark:border-white/06
                            bg-white dark:bg-[#111118] hover:border-[#ff6584]/40 hover:shadow-[0_8px_32px_rgba(255,101,132,0.1)]">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
                         style="background:rgba(255,101,132,0.10);">
                        <svg width="20" height="20" fill="none" stroke="#ff6584" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-sm mb-2">Attendance Tracking</h3>
                    <p class="text-xs leading-relaxed text-[#666688] dark:text-[#8888aa]">
                        Digital daily attendance with real-time reports and parent notifications.
                    </p>
                </div>

                {{-- Feature 6 --}}
                <div class="feature-card relative p-6 rounded-2xl border border-[#6c63ff]/10 dark:border-white/06
                            bg-white dark:bg-[#111118] hover:border-[#14b8a6]/40 hover:shadow-[0_8px_32px_rgba(20,184,166,0.1)]">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5"
                         style="background:rgba(20,184,166,0.10);">
                        <svg width="20" height="20" fill="none" stroke="#14b8a6" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-sm mb-2">Performance Reports</h3>
                    <p class="text-xs leading-relaxed text-[#666688] dark:text-[#8888aa]">
                        Detailed grade reports, exam results, and performance trends with PDF export.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════ --}}
    {{--  ACTIVITY + QUICK ACTIONS                 --}}
    {{-- ════════════════════════════════════════ --}}
    <section class="py-4 pb-20 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- ── Activity Feed ── --}}
                <div class="rounded-2xl border border-[#6c63ff]/10 dark:border-white/06 overflow-hidden
                            bg-white dark:bg-[#111118]">
                    <div class="flex items-center justify-between px-5 py-4
                                border-b border-[#6c63ff]/08 dark:border-white/05">
                        <span class="text-sm font-semibold">Recent Activity</span>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                              style="background:rgba(108,99,255,0.1);color:#6c63ff;">
                            Live
                        </span>
                    </div>
                    <div>
                        @php
                        $activities = [
                            ['dot'=>'#43e97b', 'title'=>'New student enrolled in Class 10-B', 'sub'=>'Admissions · Student Management', 'time'=>'2m ago'],
                            ['dot'=>'#6c63ff', 'title'=>'Math exam grades uploaded', 'sub'=>'Grades · Class 9-A', 'time'=>'15m ago'],
                            ['dot'=>'#f59e0b', 'title'=>'Attendance report generated', 'sub'=>'Reports · All Classes', 'time'=>'1h ago'],
                            ['dot'=>'#ff6584', 'title'=>'New subject "Computer Science" added', 'sub'=>'Curriculum · Admin', 'time'=>'3h ago'],
                            ['dot'=>'#43e97b', 'title'=>'Teacher profile updated', 'sub'=>'Staff · Teacher Management', 'time'=>'5h ago'],
                            ['dot'=>'#6c63ff', 'title'=>'Class 11-C timetable revised', 'sub'=>'Scheduling · Admin', 'time'=>'Yesterday'],
                        ];
                        @endphp
                        @foreach($activities as $a)
                        <div class="activity-row flex items-start gap-3 px-5 py-3.5">
                            <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0"
                                 style="background:{{ $a['dot'] }};"></div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-semibold leading-snug">{{ $a['title'] }}</div>
                                <div class="text-[11px] text-[#888] mt-0.5">{{ $a['sub'] }}</div>
                            </div>
                            <span class="text-[11px] text-[#aaa] flex-shrink-0 mt-0.5">{{ $a['time'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- ── Quick Actions ── --}}
                <div class="rounded-2xl border border-[#6c63ff]/10 dark:border-white/06 overflow-hidden
                            bg-white dark:bg-[#111118]">
                    <div class="px-5 py-4 border-b border-[#6c63ff]/08 dark:border-white/05">
                        <span class="text-sm font-semibold">Quick Actions</span>
                    </div>
                    <div class="grid grid-cols-2 gap-px bg-[#6c63ff]/06 dark:bg-white/04">
                        @php
                        $actions = [
                            ['icon'=>'<path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>', 'color'=>'#6c63ff', 'bg'=>'rgba(108,99,255,0.12)', 'label'=>'Add Student', 'sub'=>'Enroll new student', 'url'=>'/student/create'],
                            ['icon'=>'<circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>', 'color'=>'#43e97b', 'bg'=>'rgba(67,233,123,0.10)', 'label'=>'Add Teacher', 'sub'=>'Register staff', 'url'=>'/teacher/create'],
                            ['icon'=>'<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>', 'color'=>'#f59e0b', 'bg'=>'rgba(245,158,11,0.10)', 'label'=>'Create Class', 'sub'=>'Set up new class', 'url'=>'/class/create'],
                            ['icon'=>'<path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>', 'color'=>'#14b8a6', 'bg'=>'rgba(20,184,166,0.10)', 'label'=>'Add Subject', 'sub'=>'New curriculum', 'url'=>'/subject/create'],
                            ['icon'=>'<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>', 'color'=>'#ff6584', 'bg'=>'rgba(255,101,132,0.10)', 'label'=>'Reports', 'sub'=>'Generate reports', 'url'=>'#'],
                            ['icon'=>'<polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>', 'color'=>'#38bdf8', 'bg'=>'rgba(56,189,248,0.10)', 'label'=>'Attendance', 'sub'=>"Mark today's roll", 'url'=>'#'],
                        ];
                        @endphp
                        @foreach($actions as $act)
                        <a href="{{ $act['url'] }}"
                           class="flex flex-col gap-2.5 p-4 bg-white dark:bg-[#111118]
                                  hover:bg-[#f8f7ff] dark:hover:bg-[#1a1a24] transition-colors no-underline">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                                 style="background:{{ $act['bg'] }}">
                                <svg width="16" height="16" fill="none" stroke="{{ $act['color'] }}"
                                     stroke-width="2" viewBox="0 0 24 24">{!! $act['icon'] !!}</svg>
                            </div>
                            <div>
                                <div class="text-xs font-semibold text-[#1a1a2e] dark:text-[#f0f0f8]">{{ $act['label'] }}</div>
                                <div class="text-[11px] text-[#888] mt-0.5">{{ $act['sub'] }}</div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════ --}}
    {{--  UPCOMING EVENTS                          --}}
    {{-- ════════════════════════════════════════ --}}
    <section class="pb-20 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-end justify-between mb-6">
                <div>
                    <div class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#6c63ff;">Calendar</div>
                    <h2 class="font-display text-2xl font-extrabold tracking-tight">Upcoming Events</h2>
                </div>
                <a href="#" class="text-xs font-semibold px-4 py-2 rounded-xl no-underline transition-all
                                   hover:bg-[#6c63ff]/08"
                   style="color:#6c63ff; border:1px solid rgba(108,99,255,0.2);">
                    Full Calendar →
                </a>
            </div>

            <div class="flex gap-4 overflow-x-auto no-scrollbar pb-2">
                @php
                $events = [
                    ['day'=>'18','mon'=>'Nov','title'=>'Mid-Term Exams','desc'=>'All classes · 3 days','color'=>'#6c63ff','bg'=>'rgba(108,99,255,0.1)'],
                    ['day'=>'22','mon'=>'Nov','title'=>'Parent–Teacher Day','desc'=>'Main Hall · 9:00 AM','color'=>'#43e97b','bg'=>'rgba(67,233,123,0.1)'],
                    ['day'=>'01','mon'=>'Dec','title'=>'Science Fair 2025','desc'=>'Auditorium · All Day','color'=>'#f59e0b','bg'=>'rgba(245,158,11,0.1)'],
                    ['day'=>'10','mon'=>'Dec','title'=>'End-of-Term Ceremony','desc'=>'School Grounds · 11 AM','color'=>'#ff6584','bg'=>'rgba(255,101,132,0.1)'],
                    ['day'=>'15','mon'=>'Dec','title'=>'Winter Break Begins','desc'=>'All students & staff','color'=>'#38bdf8','bg'=>'rgba(56,189,248,0.1)'],
                ];
                @endphp
                @foreach($events as $ev)
                <div class="feature-card flex-shrink-0 w-48 p-4 rounded-2xl border border-[#6c63ff]/10 dark:border-white/06
                            bg-white dark:bg-[#111118] hover:border-[{{ $ev['color'] }}]/40
                            hover:shadow-[0_8px_24px_rgba(0,0,0,0.08)]">
                    <div class="inline-flex flex-col items-center px-3 py-2 rounded-xl mb-4"
                         style="background:{{ $ev['bg'] }}">
                        <span class="font-display text-2xl font-extrabold leading-none"
                              style="color:{{ $ev['color'] }};">{{ $ev['day'] }}</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest mt-0.5"
                              style="color:{{ $ev['color'] }};">{{ $ev['mon'] }}</span>
                    </div>
                    <h4 class="text-xs font-semibold mb-1 leading-snug">{{ $ev['title'] }}</h4>
                    <p class="text-[11px] text-[#888]">{{ $ev['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════ --}}
    {{--  ANNOUNCEMENT BANNER                      --}}
    {{-- ════════════════════════════════════════ --}}
    <section class="pb-20 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="relative rounded-2xl p-8 overflow-hidden flex items-center gap-6 flex-wrap"
                 style="background: linear-gradient(135deg, rgba(108,99,255,0.1), rgba(255,101,132,0.07));
                        border: 1px solid rgba(108,99,255,0.2);">

                {{-- BG pattern --}}
                <div class="absolute inset-0 opacity-30 grid-bg pointer-events-none rounded-2xl"></div>

                <div class="relative w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0"
                     style="background:rgba(108,99,255,0.18);">
                    <svg width="24" height="24" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 01-3.46 0"/>
                    </svg>
                </div>

                <div class="relative flex-1 min-w-52">
                    <h3 class="font-display text-lg font-extrabold mb-1">
                        Q1 2026 Registration is now open
                    </h3>
                    <p class="text-xs text-[#666688] dark:text-[#8888aa] leading-relaxed">
                        New student registrations and class transfers for the upcoming quarter are
                        now being accepted. Submit before December 31st.
                    </p>
                    <div class="flex gap-2 mt-3 flex-wrap">
                        <span class="text-[11px] font-semibold px-3 py-1 rounded-full"
                              style="background:rgba(108,99,255,0.12);color:#6c63ff;">Deadline: Dec 31</span>
                        <span class="text-[11px] font-semibold px-3 py-1 rounded-full"
                              style="background:rgba(67,233,123,0.10);color:#43e97b;">Admissions Open</span>
                    </div>
                </div>

                @auth
                    <a href="{{ url('/student/create') }}"
                       class="relative inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white
                              no-underline transition-all hover:opacity-90 flex-shrink-0"
                       style="background:#6c63ff;">
                        Apply Now →
                    </a>
                @else
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="relative inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold text-white
                                  no-underline transition-all hover:opacity-90 flex-shrink-0"
                           style="background:#6c63ff;">
                            Get Started →
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════ --}}
    {{--  FOOTER                                   --}}
    {{-- ════════════════════════════════════════ --}}
    <footer class="border-t border-[#6c63ff]/08 dark:border-white/05 py-8 px-6 text-center">
        <div class="flex items-center justify-center gap-2 mb-2">
            <div class="w-6 h-6 rounded-lg flex items-center justify-center"
                 style="background:linear-gradient(135deg,#6c63ff,#8b5cf6);">
                <svg width="11" height="11" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <span class="font-display text-sm font-extrabold tracking-tight">
                School<span style="color:#6c63ff">MS</span>
            </span>
        </div>
        <p class="text-xs text-[#888]">
            © {{ date('Y') }} SchoolMS — All rights reserved.
            Built with <span style="color:#ff6584;">♥</span> using Laravel.
        </p>
    </footer>

</body>
</html>
