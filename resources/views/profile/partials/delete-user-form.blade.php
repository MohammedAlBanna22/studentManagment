<section>

    {{-- Header --}}
    <div style="margin-bottom: 1.5rem;">
        <h2 style="font-family: 'Syne', sans-serif; font-size: 1.1rem; font-weight: 800; color: var(--accent2);">
            Delete Account
        </h2>
        <p style="font-size: 0.85rem; color: var(--muted); margin-top: 0.4rem; line-height: 1.6;">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </div>

    {{-- Delete button — triggers modal --}}
    <button
        onclick="document.getElementById('deleteModal').style.display='flex'"
        style="
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.65rem 1.25rem;
            background: rgba(255,101,132,0.1);
            border: 1px solid rgba(255,101,132,0.3);
            border-radius: 10px; color: var(--accent2);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.88rem; font-weight: 600;
            cursor: pointer; transition: background 0.2s;
        "
        onmouseover="this.style.background='rgba(255,101,132,0.2)'"
        onmouseout="this.style.background='rgba(255,101,132,0.1)'">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="3 6 5 6 21 6"/>
            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
            <path d="M10 11v6M14 11v6"/>
            <path d="M9 6V4h6v2"/>
        </svg>
        Delete Account
    </button>

    {{-- Modal overlay --}}
    <div id="deleteModal" style="
        display: none;
        position: fixed; inset: 0; z-index: 999;
        background: rgba(0,0,0,0.7);
        align-items: center; justify-content: center;
        padding: 1rem;
        backdrop-filter: blur(4px);
    ">
        {{-- Modal card --}}
        <div style="
            background: var(--surface);
            border: 1px solid rgba(255,101,132,0.2);
            border-radius: 20px; padding: 2rem;
            width: 100%; max-width: 480px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.6);
            animation: fadeUp 0.3s ease both;
        ">
            {{-- Modal header --}}
            <div style="display:flex; align-items:flex-start; gap:1rem; margin-bottom:1.25rem;">
                <div style="
                    width: 42px; height: 42px; border-radius: 11px; flex-shrink: 0;
                    background: rgba(255,101,132,0.1);
                    border: 1px solid rgba(255,101,132,0.2);
                    display: flex; align-items: center; justify-content: center;
                ">
                    <svg width="18" height="18" fill="none" stroke="var(--accent2)" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <div>
                    <h3 style="font-family: 'Syne', sans-serif; font-size: 1.05rem; font-weight: 800;">
                        Are you sure?
                    </h3>
                    <p style="font-size: 0.82rem; color: var(--muted); margin-top: 0.3rem; line-height: 1.6;">
                        Once your account is deleted, all data will be permanently removed.
                        Enter your password to confirm.
                    </p>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                {{-- Password input --}}
                <div style="margin-bottom: 1.25rem;">
                    <label style="
                        display: block; font-size: 0.78rem; font-weight: 600;
                        color: var(--muted); text-transform: uppercase;
                        letter-spacing: 0.08em; margin-bottom: 0.5rem;
                    ">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        style="
                            width: 100%; padding: 0.8rem 1rem;
                            background: var(--surface2);
                            border: 1px solid var(--border);
                            border-radius: 12px; color: var(--text);
                            font-family: 'Plus Jakarta Sans', sans-serif;
                            font-size: 0.9rem; outline: none;
                            transition: border-color 0.2s;
                        "
                        onfocus="this.style.borderColor='var(--accent2)'"
                        onblur="this.style.borderColor='var(--border)'">

                    {{-- Error --}}
                    @if($errors->userDeletion->get('password'))
                    <p style="color: var(--accent2); font-size: 0.78rem; margin-top: 0.4rem;">
                        {{ $errors->userDeletion->get('password')[0] }}
                    </p>
                    @endif
                </div>

                {{-- Buttons --}}
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">

                    {{-- Cancel --}}
                    <button
                        type="button"
                        onclick="document.getElementById('deleteModal').style.display='none'"
                        style="
                            padding: 0.65rem 1.25rem;
                            background: var(--surface2);
                            border: 1px solid var(--border);
                            border-radius: 10px; color: var(--muted);
                            font-family: 'Plus Jakarta Sans', sans-serif;
                            font-size: 0.88rem; font-weight: 600;
                            cursor: pointer; transition: color 0.2s, border-color 0.2s;
                        "
                        onmouseover="this.style.color='var(--text)'; this.style.borderColor='rgba(255,255,255,0.15)'"
                        onmouseout="this.style.color='var(--muted)'; this.style.borderColor='var(--border)'">
                        Cancel
                    </button>

                    {{-- Confirm Delete --}}
                    <button
                        type="submit"
                        style="
                            display: inline-flex; align-items: center; gap: 0.4rem;
                            padding: 0.65rem 1.25rem;
                            background: var(--accent2);
                            border: none; border-radius: 10px; color: #fff;
                            font-family: 'Plus Jakarta Sans', sans-serif;
                            font-size: 0.88rem; font-weight: 600;
                            cursor: pointer; transition: opacity 0.2s;
                        "
                        onmouseover="this.style.opacity='0.85'"
                        onmouseout="this.style.opacity='1'">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                        </svg>
                        Delete Account
                    </button>

                </div>
            </form>
        </div>
    </div>

</section>

<script>
    {{-- Close modal on overlay click --}}
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) this.style.display = 'none';
    });

    {{-- Auto open modal if there are validation errors --}}
    @if($errors->userDeletion->isNotEmpty())
        document.getElementById('deleteModal').style.display = 'flex';
    @endif
</script>
