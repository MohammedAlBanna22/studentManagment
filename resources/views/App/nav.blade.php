<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans..." rel="stylesheet">
<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --bg: #0a0a0f;
        --surface: #111118;
        --surface2: #1a1a24;
        --border: rgba(255,255,255,0.07);
        --accent: #6c63ff;
        --text: #f0f0f8;
        --muted: #8888aa;
    }

    body {
        background: var(--bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    nav {
        background: var(--surface);
        border-bottom: 1px solid var(--border);
        padding: 0 2rem;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    nav ul {
        list-style: none;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        max-width: 1100px;
        margin: 0 auto;
        height: 60px;
    }

    /* Logo — first item */
    nav ul li.logo {
        margin-right: auto;
    }

    nav ul li.logo a {
        font-family: 'Syne', sans-serif;
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--text);
        text-decoration: none;
        letter-spacing: -0.02em;
    }

    nav ul li.logo a span {
        color: var(--accent);
    }

    /* Nav links */
    nav ul li a {
        display: inline-flex;
        align-items: center;
        padding: 0.45rem 0.9rem;
        color: var(--muted);
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 500;
        border-radius: 8px;
        transition: color 0.2s, background 0.2s;
    }

    nav ul li a:hover {
        color: var(--text);
        background: var(--surface2);
    }

    /* Active link */
    nav ul li a.active {
        color: var(--accent);
        background: rgba(108,99,255,0.1);
    }

    /* CTA button — last item */
    nav ul li.cta a {
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
        color: #fff;
        padding: 0.45rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        margin-left: 0.5rem;
    }

    nav ul li.cta a:hover {
        opacity: 0.9;
        background: linear-gradient(135deg, var(--accent), #8b5cf6);
    }
</style>
</head>
<body>

<nav>
    <ul>
        {{-- Logo --}}
        <li class="logo">
            <a href="#">School<span>MS</span></a>
        </li>

        {{-- Nav links --}}
        <li><a href="#" class="active">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>

        {{-- CTA --}}
        <li class="cta"><a href="#">Get Started</a></li>
    </ul>
</nav>

</body>
</html>
