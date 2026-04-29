<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
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
            --sidebar-full: 240px;
            --sidebar-mini: 64px;
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: var(--sidebar-full);
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 1.25rem 0.85rem;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 200;
            overflow: hidden;
            transition: width var(--transition);
            flex-shrink: 0;
        }

        /* Collapsed state */
        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-mini);
        }

        /* ─── SIDEBAR HEADER ─── */
        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
            min-width: var(--sidebar-full);
        }

        /* Logo */
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            overflow: hidden;
        }
        .logo-icon {
            width: 34px; height: 34px; border-radius: 9px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-text {
            font-family: 'Syne', sans-serif;
            font-size: 1rem; font-weight: 800;
            letter-spacing: -0.02em; color: var(--text);
            white-space: nowrap;
            transition: opacity var(--transition), width var(--transition);
        }
        .logo-text span { color: var(--accent); }

        body.sidebar-collapsed .logo-text {
            opacity: 0;
            width: 0;
            pointer-events: none;
        }

        /* Toggle button */
        .toggle-btn {
            width: 30px; height: 30px; border-radius: 8px;
            background: var(--surface2);
            border: 1px solid var(--border);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 4px; cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            flex-shrink: 0;
        }
        .toggle-btn:hover { background: rgba(108,99,255,0.1); border-color: rgba(108,99,255,0.3); }
        .toggle-btn .bar {
            width: 14px; height: 1.5px;
            background: var(--muted); border-radius: 99px;
            transition: transform var(--transition), opacity var(--transition), width var(--transition);
        }

        /* Collapsed — show arrow */
        body.sidebar-collapsed .toggle-btn .bar:nth-child(1) { transform: translateY(5.5px) rotate(-40deg); width: 10px; margin-left: 2px; }
        body.sidebar-collapsed .toggle-btn .bar:nth-child(2) { width: 14px; }
        body.sidebar-collapsed .toggle-btn .bar:nth-child(3) { transform: translateY(-5.5px) rotate(40deg); width: 10px; margin-left: 2px; }

        /* ─── SECTION LABEL ─── */
        .sidebar-label {
            font-size: 0.68rem; font-weight: 600;
            color: var(--muted); text-transform: uppercase;
            letter-spacing: 0.1em; padding: 0 0.5rem;
            margin: 0.75rem 0 0.4rem;
            white-space: nowrap;
            transition: opacity var(--transition);
        }
        body.sidebar-collapsed .sidebar-label { opacity: 0; }

        /* ─── NAV ─── */
        .sidebar-nav {
            list-style: none;
            display: flex; flex-direction: column; gap: 0.15rem;
        }

        .sidebar-nav a {
            display: flex; align-items: center; gap: 0.7rem;
            padding: 0.6rem 0.75rem;
            color: var(--muted);
            text-decoration: none;
            font-size: 0.87rem; font-weight: 500;
            border-radius: 10px;
            transition: color 0.2s, background 0.2s;
            white-space: nowrap;
            overflow: hidden;
            position: relative;
        }
        .sidebar-nav a:hover { color: var(--text); background: var(--surface2); }
        .sidebar-nav a.active {
            color: var(--accent);
            background: rgba(108,99,255,0.1);
            border: 1px solid rgba(108,99,255,0.15);
        }
        .sidebar-nav a svg { flex-shrink: 0; opacity: 0.7; min-width: 16px; }
        .sidebar-nav a:hover svg,
        .sidebar-nav a.active svg { opacity: 1; }

        /* Nav link text */
        .nav-text {
            transition: opacity var(--transition);
            white-space: nowrap;
        }
        body.sidebar-collapsed .nav-text { opacity: 0; pointer-events: none; }

        /* Tooltip on collapsed */
        .sidebar-nav a::after {
            content: attr(data-tooltip);
            position: absolute;
            left: calc(var(--sidebar-mini) - 0.5rem);
            top: 50%; transform: translateY(-50%);
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text);
            font-size: 0.78rem; font-weight: 500;
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.15s;
            z-index: 999;
        }
        body.sidebar-collapsed .sidebar-nav a:hover::after { opacity: 1; }

        /* ─── DIVIDER ─── */
        .sidebar-divider { height: 1px; background: var(--border); margin: 0.75rem 0; }

        /* ─── SPACER ─── */
        .sidebar-spacer { flex: 1; }

        /* ─── USER ─── */
        .sidebar-user {
            display: flex; align-items: center; gap: 0.7rem;
            padding: 0.7rem;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            min-width: var(--sidebar-full);
        }
        .sidebar-user-avatar {
            width: 34px; height: 34px; border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif; font-weight: 800;
            font-size: 0.78rem; color: #fff; flex-shrink: 0;
        }
        .sidebar-user-info {
            flex: 1; min-width: 0;
            transition: opacity var(--transition);
        }
        .sidebar-user-info .u-name {
            font-size: 0.82rem; font-weight: 600;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-info .u-role { font-size: 0.7rem; color: var(--muted); }
        body.sidebar-collapsed .sidebar-user-info { opacity: 0; pointer-events: none; }

        .logout-btn {
            color: var(--muted); transition: color 0.2s; flex-shrink: 0;
            text-decoration: none;
            transition: opacity var(--transition);
        }
        .logout-btn:hover { color: var(--accent2); }
        body.sidebar-collapsed .logout-btn { opacity: 0; pointer-events: none; }

        /* ─── MAIN CONTENT ─── */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-full);
            padding: 2rem;
            min-height: 100vh;
            transition: margin-left var(--transition);
        }
        body.sidebar-collapsed .main-content {
            margin-left: var(--sidebar-mini);
        }
    </style>
</head>
<body>

    {{-- ─── SIDEBAR ─── --}}
    <aside class="sidebar">

        {{-- Header: Logo + Toggle --}}
        <div class="sidebar-header">
            <a href="{{ URL('/') }}" class="sidebar-logo">
                <div class="logo-icon">
                    <svg width="16" height="16" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <span class="logo-text">School<span>MS</span></span>
            </a>

            {{-- Toggle button --}}
            <button class="toggle-btn" onclick="toggleSidebar()" title="Toggle sidebar">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </button>
        </div>

        {{-- Main Menu --}}
        <div class="sidebar-label">Main Menu</div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ URL('/student') }}"
                   class="{{ request()->is('student*') ? 'active' : '' }}"
                   data-tooltip="Students">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                    <span class="nav-text">Students</span>
                </a>
            </li>
            @can('teacher-or-admin')
            <li>
                <a href="{{ URL('/teacher') }}"
                   class="{{ request()->is('teacher*') ? 'active' : '' }}"
                   data-tooltip="Teachers">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <span class="nav-text">Teachers</span>
                </a>
            </li>
            @endcan
            <li>
                <a href="{{ URL('/class') }}"
                   class="{{ request()->is('class*') ? 'active' : '' }}"
                   data-tooltip="Classes">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    <span class="nav-text">Classes</span>
                </a>
            </li>

            <li>
                <a href="{{ route('subjects.index') }}"
                   class="{{ request()->is('class*') ? 'active' : '' }}"
                   data-tooltip="Classes">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    <span class="nav-text">Subjects</span>
                </a>
            </li>
        </ul>

         <li>
                <a href="{{ route('profile.edit') }}"
                   class="{{ request()->is('class*') ? 'active' : '' }}"
                   data-tooltip="Classes">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    <span class="nav-text">Setting</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-divider"></div>

        {{-- Settings --}}
        <div class="sidebar-label">Settings</div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('profile.edit') }}"
                   class="{{ request()->is('profile*') ? 'active' : '' }}"
                   data-tooltip="Profile">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}" data-tooltip="Settings">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>
                    </svg>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-spacer"></div>

        {{-- User --}}
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
            </div>
            <div class="sidebar-user-info">
                <div class="u-name">{{ auth()->user()->name ?? 'User' }}</div>
                <div class="u-role">{{ auth()->user()->role ?? 'Admin' }}</div>
            </div>
            <a href="{{ URL('/logout') }}" class="logout-btn" title="Logout">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
                </svg>
            </a>
        </div>

    </aside>

    {{-- ─── MAIN CONTENT ─── --}}
    <main class="main-content">
        @yield('content')
    </main>

    <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebar', document.body.classList.contains('sidebar-collapsed') ? 'collapsed' : 'open');
        }

        // Restore state
        if (localStorage.getItem('sidebar') === 'collapsed') {
            document.body.classList.add('sidebar-collapsed');
        }
    </script>

    @yield('scripts')
</body>
</html>
