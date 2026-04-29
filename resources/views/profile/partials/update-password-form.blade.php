<section>

    {{-- Header --}}
    <div style="margin-bottom: 1.5rem;">
        <h2 style="font-family: 'Syne', sans-serif; font-size: 1.1rem; font-weight: 800;">
            Update Password
        </h2>
        <p style="font-size: 0.85rem; color: var(--muted); margin-top: 0.4rem; line-height: 1.6;">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </div>

    {{-- Success message --}}
    @if(session('status') === 'password-updated')
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
        Password updated successfully!
    </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div style="display: flex; flex-direction: column; gap: 1.25rem;">

            {{-- Current Password --}}
            <div>
                <label for="update_password_current_password" style="
                    display: block; font-size: 0.78rem; font-weight: 600;
                    color: var(--muted); text-transform: uppercase;
                    letter-spacing: 0.08em; margin-bottom: 0.5rem;
                ">Current Password</label>
                <input
                    id="update_password_current_password"
                    type="password"
                    name="current_password"
                    autocomplete="current-password"
                    placeholder="Enter current password"
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
                @if($errors->updatePassword->get('current_password'))
                <p style="color: var(--accent2); font-size: 0.78rem; margin-top: 0.4rem;">
                    {{ $errors->updatePassword->get('current_password')[0] }}
                </p>
                @endif
            </div>

            {{-- New Password --}}
            <div>
                <label for="update_password_password" style="
                    display: block; font-size: 0.78rem; font-weight: 600;
                    color: var(--muted); text-transform: uppercase;
                    letter-spacing: 0.08em; margin-bottom: 0.5rem;
                ">New Password</label>
                <input
                    id="update_password_password"
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    placeholder="Enter new password"
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
                @if($errors->updatePassword->get('password'))
                <p style="color: var(--accent2); font-size: 0.78rem; margin-top: 0.4rem;">
                    {{ $errors->updatePassword->get('password')[0] }}
                </p>
                @endif
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="update_password_password_confirmation" style="
                    display: block; font-size: 0.78rem; font-weight: 600;
                    color: var(--muted); text-transform: uppercase;
                    letter-spacing: 0.08em; margin-bottom: 0.5rem;
                ">Confirm Password</label>
                <input
                    id="update_password_password_confirmation"
                    type="password"
                    name="password_confirmation"
                    autocomplete="new-password"
                    placeholder="Confirm new password"
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
                @if($errors->updatePassword->get('password_confirmation'))
                <p style="color: var(--accent2); font-size: 0.78rem; margin-top: 0.4rem;">
                    {{ $errors->updatePassword->get('password_confirmation')[0] }}
                </p>
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
                Save Password
            </button>
        </div>

    </form>

</section>
