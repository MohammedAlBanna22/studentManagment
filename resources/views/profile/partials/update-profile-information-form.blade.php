<section>

    {{-- Header --}}
    <div style="margin-bottom: 1.5rem;">
        <h2 style="font-family: 'Syne', sans-serif; font-size: 1.1rem; font-weight: 800;">
            Profile Information
        </h2>
        <p style="font-size: 0.85rem; color: var(--muted); margin-top: 0.4rem; line-height: 1.6;">
            Update your account's profile information and email address.
        </p>
    </div>

    {{-- Success message --}}
    @if(session('status') === 'profile-updated')
    <div style="
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.6rem 1rem; margin-bottom: 1.25rem;
        background: rgba(67,233,123,0.08);
        border: 1px solid rgba(67,233,123,0.2);
        border-radius: 10px; color: var(--accent3);
        font-size: 0.85rem;
    ">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path d="M5 13l4 4L19 7"/>
        </svg>
        Profile updated successfully!
    </div>
    @endif

    {{-- Verification link sent --}}
    @if(session('status') === 'verification-link-sent')
    <div style="
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.6rem 1rem; margin-bottom: 1.25rem;
        background: rgba(108,99,255,0.08);
        border: 1px solid rgba(108,99,255,0.2);
        border-radius: 10px; color: var(--accent);
        font-size: 0.85rem;
    ">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/>
        </svg>
        A new verification link has been sent to your email address.
    </div>
    @endif

    {{-- Hidden verification form --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Main form --}}
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div style="display: flex; flex-direction: column; gap: 1.25rem;">

            {{-- Name --}}
            <div>
                <label for="name" style="
                    display: block; font-size: 0.78rem; font-weight: 600;
                    color: var(--muted); text-transform: uppercase;
                    letter-spacing: 0.08em; margin-bottom: 0.5rem;
                ">Name</label>
                <input
                    id="name" type="text" name="name"
                    value="{{ old('name', $user->name) }}"
                    required autofocus autocomplete="name"
                    placeholder="Your full name"
                    style="
                        width: 100%; padding: 0.8rem 1rem;
                        background: var(--surface2);
                        border: 1px solid var(--border);
                        border-radius: 12px; color: var(--text);
                        font-family: 'Plus Jakarta Sans', sans-serif;
                        font-size: 0.9rem; outline: none;
                        transition: border-color 0.2s;
                    "
                    onfocus="this.style.borderColor='var(--accent)'"
                    onblur="this.style.borderColor='var(--border)'">
                @if($errors->get('name'))
                <p style="color: var(--accent2); font-size: 0.78rem; margin-top: 0.4rem;">
                    {{ $errors->get('name')[0] }}
                </p>
                @endif
            </div>

            {{-- Email --}}
            <div>
                <label for="email" style="
                    display: block; font-size: 0.78rem; font-weight: 600;
                    color: var(--muted); text-transform: uppercase;
                    letter-spacing: 0.08em; margin-bottom: 0.5rem;
                ">Email</label>
                <input
                    id="email" type="email" name="email"
                    value="{{ old('email', $user->email) }}"
                    required autocomplete="username"
                    placeholder="Your email address"
                    style="
                        width: 100%; padding: 0.8rem 1rem;
                        background: var(--surface2);
                        border: 1px solid var(--border);
                        border-radius: 12px; color: var(--text);
                        font-family: 'Plus Jakarta Sans', sans-serif;
                        font-size: 0.9rem; outline: none;
                        transition: border-color 0.2s;
                    "
                    onfocus="this.style.borderColor='var(--accent)'"
                    onblur="this.style.borderColor='var(--border)'">
                @if($errors->get('email'))
                <p style="color: var(--accent2); font-size: 0.78rem; margin-top: 0.4rem;">
                    {{ $errors->get('email')[0] }}
                </p>
                @endif

                {{-- Email unverified warning --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="
                    display: flex; align-items: center; justify-content: space-between;
                    gap: 0.75rem; margin-top: 0.75rem;
                    padding: 0.65rem 1rem;
                    background: rgba(247,151,30,0.08);
                    border: 1px solid rgba(247,151,30,0.2);
                    border-radius: 10px;
                ">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg width="14" height="14" fill="none" stroke="#f7971e" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                            <line x1="12" y1="9" x2="12" y2="13"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                        <span style="font-size: 0.82rem; color: #f7971e;">
                            Your email address is unverified.
                        </span>
                    </div>
                    <button
                        form="send-verification"
                        type="submit"
                        style="
                            padding: 0.3rem 0.75rem;
                            background: rgba(247,151,30,0.1);
                            border: 1px solid rgba(247,151,30,0.3);
                            border-radius: 8px; color: #f7971e;
                            font-family: 'Plus Jakarta Sans', sans-serif;
                            font-size: 0.75rem; font-weight: 600;
                            cursor: pointer; white-space: nowrap;
                            transition: background 0.2s;
                        "
                        onmouseover="this.style.background='rgba(247,151,30,0.2)'"
                        onmouseout="this.style.background='rgba(247,151,30,0.1)'">
                        Resend Verification
                    </button>
                </div>
                @endif
            </div>

        </div>

        {{-- Submit --}}
        <div style="margin-top: 1.5rem;">
            <button type="submit" style="
                display: inline-flex; align-items: center; gap: 0.5rem;
                padding: 0.75rem 1.5rem;
                background: linear-gradient(135deg, var(--accent), #8b5cf6);
                border: none; border-radius: 12px; color: #fff;
                font-family: 'Syne', sans-serif;
                font-size: 0.95rem; font-weight: 700;
                cursor: pointer; transition: opacity 0.2s, transform 0.2s;
            "
            onmouseover="this.style.opacity='0.9'; this.style.transform='translateY(-1px)'"
            onmouseout="this.style.opacity='1'; this.style.transform='translateY(0)'">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v14a2 2 0 01-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Save Changes
            </button>
        </div>

    </form>

</section>
