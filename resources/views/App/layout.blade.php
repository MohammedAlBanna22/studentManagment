<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans..." rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @yield('head')
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
    --nav-height: 60px;
    --sidebar-width: 240px;
    --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ─── LIGHT MODE ─── */
body.light-mode {
    --bg: #f0f2f5;
    --surface: #ffffff;
    --surface2: #e8eaf0;
    --border: rgba(0,0,0,0.08);
    --text: #1a1a2e;
    --muted: #666688;
}


/* ─── THEME TOGGLE BUTTON ─── */
.theme-toggle {
    width: 36px; height: 36px;
    border-radius: 9px;
    background: var(--surface2);
    border: 1px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    color: var(--muted);
    flex-shrink: 0;
    transition: background 0.2s, border-color 0.2s, color 0.2s;
}
.theme-toggle:hover {
    background: rgba(108,99,255,0.1);
    border-color: rgba(108,99,255,0.3);
    color: var(--accent);
}



        /* ─── TOP NAV ─── */
        .top-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: var(--nav-height);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            z-index: 300;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            gap: 1rem;
        }

        /* ✅ Toggle button in nav */
        .sidebar-toggle {
            width: 36px; height: 36px;
            border-radius: 9px;
            background: var(--surface2);
            border: 1px solid var(--border);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 5px; cursor: pointer;
            flex-shrink: 0;
            transition: background 0.2s, border-color 0.2s;
        }
        .sidebar-toggle:hover {
            background: rgba(108,99,255,0.1);
            border-color: rgba(108,99,255,0.3);
        }
        .sidebar-toggle .bar {
            width: 15px; height: 1.5px;
            background: var(--muted);
            border-radius: 99px;
            transition: transform var(--transition), opacity var(--transition), background var(--transition);
            display: block;
        }

        /* ✅ Animate to X when sidebar is visible */
        body.sidebar-visible .sidebar-toggle .bar:nth-child(1) {
            transform: translateY(6.5px) rotate(45deg);
            background: var(--accent);
        }
        body.sidebar-visible .sidebar-toggle .bar:nth-child(2) {
            opacity: 0; transform: scaleX(0);
        }
        body.sidebar-visible .sidebar-toggle .bar:nth-child(3) {
            transform: translateY(-6.5px) rotate(-45deg);
            background: var(--accent);
        }

        /* Logo */
        .nav-logo {
            display: flex; align-items: center; gap: 0.6rem;
            text-decoration: none; margin-right: auto;
        }
        .nav-logo-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
        }
        .nav-logo h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1rem; font-weight: 800;
            letter-spacing: -0.02em; color: var(--text);
            margin-top: 5%;
        }
        .nav-logo h1 span { color: var(--accent); }

        /* Nav links */
        .nav-links {
            display: flex; align-items: center; gap: 0.2rem;
            list-style: none;
        }
        .nav-links a {
            display: inline-flex; align-items: center;
            padding: 0.4rem 0.85rem;
            color: var(--muted); text-decoration: none;
            font-size: 0.88rem; font-weight: 500;
            border-radius: 8px;
            transition: color 0.2s, background 0.2s;
            margin-top: 20%;
        }
        .nav-links a:hover { color: var(--text); background: var(--surface2); }
        .nav-links a.active { color: var(--accent); background: rgba(108,99,255,0.1); }

        /* Nav user */
        .nav-user {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.35rem 0.75rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-left: 0.5rem;
        }
        .nav-user-avatar {
            width: 28px; height: 28px; border-radius: 7px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif; font-weight: 800;
            font-size: 0.72rem; color: #fff;
        }
        .nav-user-name { font-size: 0.82rem; font-weight: 500; }

        /* Logout */
        .nav-logout {
            display: inline-flex; align-items: center;
            padding: 0.4rem 0.6rem; color: var(--muted);
            border-radius: 8px; text-decoration: none;
            transition: color 0.2s, background 0.2s;
        }
        .nav-logout:hover { color: var(--accent2); background: rgba(255,101,132,0.08); }

        /* ─── BODY WRAPPER ─── */
        .body-wrapper {
            display: flex;
            min-height: 100vh;
            padding-top: var(--nav-height);
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            border-right: 1px solid var(--border);
            position: fixed;
            top: var(--nav-height); left: 0; bottom: 0;
            display: flex; flex-direction: column;
            padding: 1.25rem 0.85rem;
            overflow-y: auto;
            z-index: 200;

            /* ✅ Hidden by default */
            transform: translateX(-100%);
            transition: transform var(--transition);
        }

        /* ✅ Show sidebar */
        body.sidebar-visible .sidebar {
            transform: translateX(0);
        }

        /* Sidebar label */
        .sidebar-label {
            font-size: 0.68rem; font-weight: 600;
            color: var(--muted); text-transform: uppercase;
            letter-spacing: 0.1em; padding: 0 0.5rem;
            margin: 0.75rem 0 0.4rem;
        }
        .sidebar-label:first-child { margin-top: 0; }

        /* Sidebar nav */
        .sidebar-nav {
            list-style: none;
            display: flex; flex-direction: column; gap: 0.15rem;
        }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 0.7rem;
            padding: 0.6rem 0.75rem; color: var(--muted);
            text-decoration: none;
            font-size: 0.87rem; font-weight: 500;
            border-radius: 10px;
            transition: color 0.2s, background 0.2s;
        }
        .sidebar-nav a:hover { color: var(--text); background: var(--surface2); }
        .sidebar-nav a.active {
            color: var(--accent);
            background: rgba(108,99,255,0.1);
            border: 1px solid rgba(108,99,255,0.15);
        }
        .sidebar-nav a svg { flex-shrink: 0; opacity: 0.7; }
        .sidebar-nav a:hover svg,
        .sidebar-nav a.active svg { opacity: 1; }

        /* Sidebar divider */
        .sidebar-divider { height: 1px; background: var(--border); margin: 0.75rem 0; }

        /* Sidebar spacer */
        .sidebar-spacer { flex: 1; }

        /* Sidebar user */
        .sidebar-user {
            display: flex; align-items: center; gap: 0.7rem;
            padding: 0.7rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
        }
        .sidebar-user-avatar {
            width: 34px; height: 34px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif; font-weight: 800;
            font-size: 0.78rem; color: #fff; flex-shrink: 0;
        }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-info .u-name {
            font-size: 0.82rem; font-weight: 600;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-info .u-role { font-size: 0.7rem; color: var(--muted); }

        /* ─── MAIN CONTENT ─── */
        .main-content {
            flex: 1;
            padding: 2rem;
            min-height: calc(100vh - var(--nav-height));
            overflow-x: hidden;
            margin-left: 0;
            transition: margin-left var(--transition);
        }

        /* ✅ Push content when sidebar visible */
        body.sidebar-visible .main-content {
            margin-left: var(--sidebar-width);
        }

        /* ─── FOOTER ─── */
        .footer {
            padding: 1rem 2rem;
            border-top: 1px solid var(--border);
            font-size: 0.78rem;
            color: var(--muted);
            text-align: center;
            transition: margin-left var(--transition);
        }
        body.sidebar-visible .footer {
            margin-left: var(--sidebar-width);
        }

        /* ─── OVERLAY (mobile) ─── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 199;
            backdrop-filter: blur(2px);
        }
        body.sidebar-visible .sidebar-overlay { display: block; }

        @media (min-width: 768px) {
            body.sidebar-visible .sidebar-overlay { display: none; }
        }


        html {
    background: var(--bg) !important;
    min-height: 100%;
}

body {
    min-height: 100vh;
    background: var(--bg) !important;
}

body.light-mode {
    --bg: #f0f2f5;
    --surface: #ffffff;
    --surface2: #e8eaf0;
    --border: rgba(0,0,0,0.08);
    --text: #1a1a2e;
    --muted: #666688;
    background: var(--bg) !important;
}
/* REPLACE your existing html, body rule with this */
html, body {
    min-height: 100%;
    background: var(--bg);
    color: var(--text);
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: background 0.3s, color 0.3s;
}
    </style>
    @yield('styles')
</head>
<body>

    {{-- ─── TOP NAV ─── --}}
    <nav class="top-nav">

        {{-- ✅ Toggle button --}}
        <button class="sidebar-toggle" onclick="toggleSidebar()" title="Toggle sidebar">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>

        {{-- Logo --}}
        <a href="{{ URL('/') }}" class="nav-logo">
            <div class="nav-logo-icon">
                <svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <h1>School<span>MS</span></h1>
        </a>

        {{-- Nav links --}}
        <ul class="nav-links">
            <li><a href="{{ route('school.index') }}" class="{{ request()->is('student*') ? 'active' : '' }}">Home</a></li>

            <li><a href="{{ route('school.aboutUs') }}" class="{{ request()->is('teacher*') ? 'active' : '' }}">About Us</a></li>

            <li><a href="{{ route('school.contactUs') }}" class="{{ request()->is('class*') ? 'active' : '' }}">Contact Us</a></li>
        </ul>

        {{-- User --}}
        <div class="nav-user">
            <div class="nav-user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
            </div>
            <span class="nav-user-name">{{ auth()->user()->name ?? 'User' }}</span>
        </div>

        {{-- Logout --}}
        <a href="#" class="nav-logout" title="Logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
            </svg>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>


        {{-- Theme Toggle --}}
<button class="theme-toggle" onclick="toggleTheme()" id="theme-btn" title="Toggle theme">
    <svg id="icon-moon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
    </svg>
    <svg id="icon-sun" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;">
        <circle cx="12" cy="12" r="5"/>
        <line x1="12" y1="1" x2="12" y2="3"/>
        <line x1="12" y1="21" x2="12" y2="23"/>
        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
        <line x1="1" y1="12" x2="3" y2="12"/>
        <line x1="21" y1="12" x2="23" y2="12"/>
        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
    </svg>
</button>

    </nav>

    {{-- ─── BODY WRAPPER ─── --}}
    <div class="body-wrapper">

        {{-- Mobile overlay --}}
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        {{-- ─── SIDEBAR ─── --}}
        <aside class="sidebar">

            <div class="sidebar-label">Main Menu</div>

            <ul class="sidebar-nav">



                @can('students')



                    <li>
                            <a href="{{ route('student.profile', auth()->user()->student->id) }}" class="{{ request()->is('student*') ? 'active' : '' }}">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                            Student Dashboard


                            </a>
                    </li>

                    <li>
                        <a href="{{ route('payment.form') }}"
                        class="{{ request()->is('student/payment*') ? 'active' : '' }}">

                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 10H3"/>
                        <path d="M21 6H3"/>
                        <path d="M21 14H3"/>
                        <path d="M21 18H3"/>
                        </svg>

                        Payment
                        </a>
                    </li>




                @endcan



                   @can('teachers')



                    <li>
                            <a href="{{ route('teacher.show', auth()->user()->teacher->id) }}" class="{{ request()->is('teacher*') ? 'active' : '' }}">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                            Teacher Profile
                            </a>
                    </li>

                    <li>
                        <a href="{{ route('requests.index') }}"
                         class="{{ request()->is('teacher/requests*') ? 'active' : '' }}">

                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 12h6"/>
                        <path d="M9 16h6"/>
                        <path d="M9 8h6"/>
                        <path d="M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                        </svg>

                        Teacher Subjects
                        </a>
                        </li>


                @endcan



                 @can('teacher-or-admin')
                <li>
                    <a href="{{ route('student.index'  ) }}" class="{{ request()->is('student*') ? 'active' : '' }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                        All Students
                    </a>
                </li>
                @endcan
               @can('admin')
                <li>
                    <a href="{{ URL('/teacher') }}" class="{{ request()->is('teacher*') ? 'active' : '' }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                        </svg>
                        Teachers
                    </a>
                </li>
                @endcan

                @can('admins')
                <li>
                    <a href="{{ URL('/class') }}" class="{{ request()->is('class*') ? 'active' : '' }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Classes
                    </a>
                </li>

                    <li>
                         <a href="{{ route('subjects.index') }}"
                            class="{{ request()->is('subject*') ? 'active' : '' }}"
                            data-tooltip="Subjects">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                         <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                         <path d="M8 7h8M8 11h8M8 15h5"/>
                         </svg>
                    <span class="nav-text">Subjects</span>
                        </a>
                    </li>

                         <li>
                        <a href="{{ route('admin.schedule.index') }}"
                         class="{{ request()->is('teacher/requests*') ? 'active' : '' }}">

                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 12h6"/>
                        <path d="M9 16h6"/>
                        <path d="M9 8h6"/>
                        <path d="M5 4h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/>
                        </svg>

                        Teacher Requests
                        </a>
                        </li>



                         <li>
                            <a href="{{ route('payment.index') }}"
                            class="{{ request()->is('student/payment*') ? 'active' : '' }}">

                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 1v22"/>
                            <path d="M17 5H9.5a3.5 3.5 0 000 7H14a3.5 3.5 0 010 7H6"/>
                            </svg>

                             All Payment
                             </a>
                            </li>


                    @endcan
            </ul>

            <div class="sidebar-divider"></div>

            <div class="sidebar-label">Settings</div>

            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile*') ? 'active' : '' }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                        </svg>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->is('settings*') ? 'active' : '' }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>
                        </svg>
                        Settings
                    </a>
                </li>
            </ul>

            <div class="sidebar-spacer"></div>

            {{-- Sidebar user --}}
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                </div>
                <div class="sidebar-user-info">
                    <div class="u-name">{{ auth()->user()->name ?? 'User' }}</div>

                @php
                     $type = auth()->user()->user_type;
                    $color = match($type) {
                        'admin'   => '#ef4444',  // red
                        'teacher' => '#6c63ff',  // purple
                         'student' => '#43e97b',  // green
                        default   => '#888'
                    };
                @endphp

                <div class="u-role" style="color: {{ $color }}">
                     {{ ucfirst($type) }}
                </div>

                </div>
            </div>

        </aside>

        {{-- ─── MAIN CONTENT ─── --}}
        <main class="main-content">
            @yield('content')
        </main>

    </div>

    {{-- ─── FOOTER ─── --}}
    @include('App.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script>
    // ─── SIDEBAR ───
    function toggleSidebar() {
        document.body.classList.toggle('sidebar-visible');
        localStorage.setItem('sidebar',
            document.body.classList.contains('sidebar-visible') ? 'visible' : 'hidden'
        );
    }

    if (localStorage.getItem('sidebar') === 'visible') {
        document.body.classList.add('sidebar-visible');
    }

    // ─── THEME ───
    function toggleTheme() {
        const isLight = document.body.classList.toggle('light-mode');
        localStorage.setItem('theme', isLight ? 'light' : 'dark');
        updateThemeIcon(isLight);
    }

    function updateThemeIcon(isLight) {
        document.getElementById('icon-moon').style.display = isLight ? 'none' : 'block';
        document.getElementById('icon-sun').style.display  = isLight ? 'block' : 'none';
    }

    // ✅ Apply saved theme on load
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        document.body.classList.add('light-mode');
        updateThemeIcon(true);
    }
</script>

    @yield('scripts')
</body>
</html>
