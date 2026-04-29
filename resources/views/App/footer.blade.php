<footer style="
    background: var(--surface);
    border-top: 1px solid var(--border);
    padding: 1rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-left: var(--sidebar-width);
    font-family: 'Plus Jakarta Sans', sans-serif;
">

    {{-- Left — copyright --}}
    <p style="font-size: 0.78rem; color: var(--muted); margin: 0;">
         Eng-Mohammed ALBanna
    </p>

    {{-- Center — quote --}}
    <p style="font-size: 0.75rem; color: var(--muted); margin: 0; font-style: italic; text-align: center;">
     &copy; {{ date('Y') }} <span style="color: var(--accent); font-weight: 600;">SchoolMS</span>. All rights reserved.
    </p>

    {{-- Right — version --}}
    <p style="font-size: 0.75rem; color: var(--muted); margin: 0;">
        v1.0.0
    </p>

</footer>
