@extends('app.layout')

@section('head')
<title>Contact Us — SchoolMS</title>
@endsection

@section('styles')
<style>
/* ─── CONTACT PAGE STYLES ─── */
.contact-wrap { padding-bottom: 4rem; }

/* ── Hero (mirrors about-hero) ── */
.contact-hero {
    position: relative;
    padding: 5rem 2rem 4rem;
    text-align: center;
    overflow: hidden;
}
.contact-hero-glow {
    position: absolute;
    width: 700px; height: 700px;
    border-radius: 50%;
    top: -200px; left: 50%;
    transform: translateX(-50%);
    background: radial-gradient(circle, rgba(108,99,255,0.18) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}
.contact-hero-grid {
    position: absolute; inset: 0; z-index: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
    background-size: 40px 40px;
    mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
    -webkit-mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
}
.contact-badge {
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
.contact-badge-dot {
    width: 6px; height: 6px;
    background: var(--accent3); border-radius: 50%;
    animation: cbpulse 2s infinite;
}
@keyframes cbpulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(1.4); }
}
.contact-hero h1 {
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 800; line-height: 1.1;
    letter-spacing: -0.03em;
    position: relative; z-index: 1;
    margin-bottom: 1.25rem;
    color: var(--text);
}
.contact-hero h1 span {
    background: linear-gradient(135deg, var(--accent), #a78bfa, var(--accent2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.contact-hero-sub {
    font-size: 1.05rem; color: var(--muted);
    max-width: 560px; margin: 0 auto;
    line-height: 1.7; position: relative; z-index: 1;
}

/* ── Shared section helpers ── */
.ct-section {
    padding: 4rem 2rem;
    max-width: 1200px;
    margin: 0 auto;
}
.ct-section-label {
    font-size: 0.72rem; font-weight: 700;
    color: var(--accent);
    text-transform: uppercase; letter-spacing: 0.12em;
    margin-bottom: 0.75rem;
}
.ct-section-title {
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800; letter-spacing: -0.02em;
    margin-bottom: 0.75rem; line-height: 1.2;
    color: var(--text);
}
.ct-section-sub {
    font-size: 0.95rem; color: var(--muted);
    line-height: 1.7; max-width: 520px;
}
.ct-divider {
    height: 1px; background: var(--border);
    margin: 0 2rem;
}

/* ── Info cards (mirrors value-card) ── */
.info-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 3rem;
}
.info-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 1.75rem;
    transition: all 0.3s;
    position: relative; overflow: hidden;
}
.info-card::before {
    content: '';
    position: absolute; inset: 0; border-radius: 16px;
    opacity: 0; transition: opacity 0.3s; pointer-events: none;
    background: radial-gradient(circle at 50% 0%, rgba(108,99,255,0.06), transparent 70%);
}
.info-card:hover { transform: translateY(-4px); border-color: rgba(108,99,255,0.3); }
.info-card:hover::before { opacity: 1; }
.info-icon {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 1.25rem;
}
.ii-purple { background: rgba(108,99,255,0.15); }
.ii-green  { background: rgba(67,233,123,0.12); }
.ii-amber  { background: rgba(245,158,11,0.12); }
.ii-pink   { background: rgba(255,101,132,0.12); }
.ii-blue   { background: rgba(56,189,248,0.12); }
.info-card h3 {
    font-size: 1rem; font-weight: 700;
    margin-bottom: 0.4rem; letter-spacing: -0.01em; color: var(--text);
}
.info-card p  { font-size: 0.85rem; color: var(--muted); line-height: 1.6; margin: 0 0 0.75rem; }
.info-card a  { font-size: 0.85rem; font-weight: 600; text-decoration: none; transition: opacity 0.2s; }
.info-card a:hover { opacity: 0.75; }

/* ── Main layout: form + sidebar ── */
.contact-main-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 2rem;
    margin-top: 3rem;
    align-items: start;
}

/* ── Form card ── */
.form-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px; overflow: hidden;
}
.form-card-header {
    padding: 1.5rem 1.75rem;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
}
.form-card-header-text h3 { font-size: 1.05rem; font-weight: 700; color: var(--text); margin: 0 0 4px; }
.form-card-header-text p  { font-size: 0.8rem; color: var(--muted); margin: 0; }
.form-card-header-icon {
    width: 38px; height: 38px; border-radius: 10px;
    background: rgba(108,99,255,0.12);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.form-body { padding: 1.75rem; }
.form-row {
    display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;
}
.form-group { margin-bottom: 1.25rem; }
.form-group:last-child { margin-bottom: 0; }
.form-label {
    display: block; font-size: 0.75rem; font-weight: 600;
    color: var(--muted); margin-bottom: 0.4rem; letter-spacing: 0.02em;
}
.form-label span { color: var(--accent2); }
.form-input {
    width: 100%; padding: 0.7rem 1rem; border-radius: 10px;
    font-size: 0.875rem; font-family: inherit;
    border: 1.5px solid var(--border);
    background: var(--surface2); color: var(--text);
    transition: border-color .2s, box-shadow .2s;
    outline: none; appearance: none;
}
.form-input::placeholder { color: var(--muted); opacity: 0.6; }
.form-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(108,99,255,0.12); }
textarea.form-input { resize: vertical; min-height: 130px; }

/* Priority pills */
.priority-group { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 0.4rem; }
.p-pill {
    padding: 5px 14px; border-radius: 999px; border: 1.5px solid;
    font-size: 0.75rem; font-weight: 600; cursor: pointer;
    transition: all 0.15s; background: transparent; font-family: inherit;
}
.p-pill-green  { border-color: rgba(67,233,123,0.4);  color: #43e97b; }
.p-pill-purple { border-color: rgba(108,99,255,0.5);  color: var(--accent); background: rgba(108,99,255,0.10); }
.p-pill-amber  { border-color: rgba(245,158,11,0.4);  color: #f59e0b; }
.p-pill-pink   { border-color: rgba(255,101,132,0.4); color: var(--accent2); }
.p-pill:hover  { opacity: 0.8; transform: scale(1.03); }

/* Form footer */
.form-footer {
    display: flex; align-items: center;
    justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    padding-top: 1.25rem; border-top: 1px solid var(--border); margin-top: 1.25rem;
}
.form-footer-note { font-size: 0.75rem; color: var(--muted); max-width: 260px; line-height: 1.5; }
.form-footer-note a { color: var(--accent); text-decoration: none; }
.form-footer-note a:hover { text-decoration: underline; }

/* Buttons (mirrors btn-ab-primary / secondary exactly) */
.btn-ct-primary {
    padding: 0.75rem 2rem; background: var(--accent); color: #fff;
    border: none; border-radius: 12px; font-size: 0.9rem; font-weight: 600;
    cursor: pointer; transition: all 0.2s; text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px; font-family: inherit;
}
.btn-ct-primary:hover {
    background: #5a52e0; transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(108,99,255,0.35); color: #fff;
}
.btn-ct-secondary {
    padding: 0.75rem 2rem; background: var(--surface2); color: var(--text);
    border: 1px solid var(--border); border-radius: 12px;
    font-size: 0.9rem; font-weight: 600; cursor: pointer; transition: all 0.2s;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-family: inherit;
}
.btn-ct-secondary:hover {
    border-color: rgba(108,99,255,0.4); background: rgba(108,99,255,0.08);
    transform: translateY(-1px); color: var(--text);
}

/* ── Sidebar ── */
.sidebar { display: flex; flex-direction: column; gap: 1.25rem; }
.sidebar-card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
.sidebar-card-header {
    padding: 1rem 1.25rem; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 10px;
}
.sidebar-card-header-icon {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.sidebar-card-header span { font-size: 0.85rem; font-weight: 700; color: var(--text); }
.sidebar-card-body { padding: 1.25rem; }

/* Map placeholder */
.map-placeholder {
    height: 160px;
    background:
        linear-gradient(rgba(108,99,255,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(108,99,255,0.04) 1px, transparent 1px);
    background-size: 28px 28px; background-color: var(--surface2);
    display: flex; align-items: center; justify-content: center; position: relative;
}
.map-pin {
    width: 48px; height: 48px; border-radius: 50%; background: var(--accent);
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 8px 24px rgba(108,99,255,0.4); position: relative; z-index: 1;
}
.map-dot-ring {
    position: absolute; width: 80px; height: 80px; border-radius: 50%;
    border: 1px solid rgba(108,99,255,0.25);
    animation: ring-pulse 2.5s ease-in-out infinite;
}
.map-dot-ring-2 { width: 116px; height: 116px; animation-delay: 0.6s; }
@keyframes ring-pulse {
    0%, 100% { opacity: 0.6; transform: scale(1); }
    50%       { opacity: 0.2; transform: scale(1.06); }
}
.map-badge {
    position: absolute; top: 10px; left: 10px;
    font-size: 0.68rem; font-weight: 700; color: var(--accent);
    text-transform: uppercase; letter-spacing: 0.1em;
    background: rgba(108,99,255,0.12); border: 1px solid rgba(108,99,255,0.2);
    border-radius: 6px; padding: 3px 8px;
}

/* Office hours rows */
.hours-row {
    display: flex; align-items: center; justify-content: space-between;
    font-size: 0.82rem; padding: 0.5rem 0; border-bottom: 1px solid var(--border);
}
.hours-row:last-child { border-bottom: none; padding-bottom: 0; }
.hours-row-day  { color: var(--muted); }
.hours-row-time { font-weight: 600; color: var(--text); }
.hours-row-time.closed { color: var(--accent2); }
.online-badge {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.75rem; font-weight: 600; color: #43e97b; margin-top: 1rem;
}
.online-dot { width: 7px; height: 7px; border-radius: 50%; background: #43e97b; animation: cbpulse 2s infinite; }

/* Social buttons */
.social-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.social-btn {
    display: flex; align-items: center; gap: 8px; padding: 0.6rem 0.875rem;
    border-radius: 10px; font-size: 0.78rem; font-weight: 600;
    text-decoration: none; transition: all 0.2s;
    border: 1px solid var(--border); color: var(--text);
}
.social-btn:hover { transform: translateY(-2px); border-color: rgba(108,99,255,0.3); color: var(--text); text-decoration: none; }

/* ── FAQ ── */
.faq-list { margin-top: 3rem; display: flex; flex-direction: column; gap: 1rem; }
.faq-item {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 14px; overflow: hidden; transition: border-color 0.2s; cursor: pointer;
}
.faq-item:hover { border-color: rgba(108,99,255,0.3); }
.faq-item.open  { border-color: rgba(108,99,255,0.3); }
.faq-question {
    display: flex; align-items: center; gap: 12px;
    padding: 1.1rem 1.25rem; user-select: none;
}
.faq-q-icon {
    width: 32px; height: 32px; flex-shrink: 0;
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
}
.faq-q-text { flex: 1; font-size: 0.9rem; font-weight: 700; color: var(--text); line-height: 1.4; }
.faq-chevron { flex-shrink: 0; transition: transform 0.25s ease; }
.faq-item.open .faq-chevron { transform: rotate(180deg); }
.faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding 0.2s ease; padding: 0 1.25rem; }
.faq-item.open .faq-answer { max-height: 200px; padding: 0 1.25rem 1.1rem; }
.faq-answer p { font-size: 0.85rem; color: var(--muted); line-height: 1.7; margin: 0; padding-left: 44px; }

/* ── CTA Banner (mirrors contact-banner from about) ── */
.cta-banner-wrap { max-width: 1200px; margin: 0 auto; padding: 0 2rem 4rem; }
.cta-banner {
    background: linear-gradient(135deg, rgba(108,99,255,0.12), rgba(255,101,132,0.08));
    border: 1px solid rgba(108,99,255,0.2);
    border-radius: 20px; padding: 3rem; text-align: center; position: relative; overflow: hidden;
}
.cta-banner::before {
    content: ''; position: absolute; width: 500px; height: 500px; border-radius: 50%;
    top: -200px; left: 50%; transform: translateX(-50%);
    background: radial-gradient(circle, rgba(108,99,255,0.1) 0%, transparent 70%);
    pointer-events: none;
}
.cta-banner h2 {
    font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: var(--text);
    letter-spacing: -0.02em; margin-bottom: 0.75rem; position: relative; z-index: 1;
}
.cta-banner p {
    font-size: 0.95rem; color: var(--muted); max-width: 480px; margin: 0 auto 2rem;
    line-height: 1.7; position: relative; z-index: 1;
}
.cta-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; position: relative; z-index: 1; }

/* ── Toast ── */
#ct-toast {
    position: fixed; bottom: 2rem; right: 2rem; z-index: 9999;
    display: flex; align-items: center; gap: 10px; padding: 0.875rem 1.25rem;
    border-radius: 14px; background: var(--surface); border: 1px solid rgba(67,233,123,0.3);
    box-shadow: 0 16px 40px rgba(0,0,0,0.15); font-size: 0.813rem; font-weight: 600; color: var(--text);
    transform: translateY(80px); opacity: 0;
    transition: transform .4s cubic-bezier(.34,1.56,.64,1), opacity .4s ease; pointer-events: none;
}
#ct-toast.show { transform: translateY(0); opacity: 1; }

/* ── Fade-in (mirrors abfade from about) ── */
@keyframes ctfadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
.ctfade { animation: ctfadeUp 0.6s ease forwards; }
.ctd1   { animation-delay: 0.05s; opacity: 0; }
.ctd2   { animation-delay: 0.15s; opacity: 0; }
.ctd3   { animation-delay: 0.25s; opacity: 0; }

/* ── Responsive ── */
@media (max-width: 960px) {
    .contact-main-grid { grid-template-columns: 1fr; }
    .sidebar { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); }
}
@media (max-width: 640px) {
    .form-row { grid-template-columns: 1fr; }
    .sidebar { grid-template-columns: 1fr; }
    .cta-actions { flex-direction: column; align-items: center; }
}
</style>
@endsection

@section('content')
<div class="contact-wrap">

    {{-- ─── HERO ─── --}}
    <section class="contact-hero">
        <div class="contact-hero-glow"></div>
        <div class="contact-hero-grid"></div>

        <div class="contact-badge ctfade">
            <span class="contact-badge-dot"></span>
            We're here to help
        </div>

        <h1 class="ctfade ctd1">
            Get in touch<br><span>with our team</span>
        </h1>

        <p class="contact-hero-sub ctfade ctd2">
            Have questions about SchoolMS? Need support or want to schedule a demo?
            Our team typically responds within 2 business hours.
        </p>
    </section>

    {{-- ─── INFO CARDS ─── --}}
    <section class="ct-section" style="padding-top: 0; padding-bottom: 2rem;">
        <div class="info-cards-grid ctfade ctd3">

            <div class="info-card">
                <div class="info-icon ii-purple">
                    <svg width="20" height="20" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.18C.01.6.39.07.97.02h3C4.55.02 5.05.44 5.12 1c.12.96.37 1.9.74 2.8a2 2 0 01-.45 2.11L4.09 7.23a16 16 0 006.29 6.29l1.31-1.31a2 2 0 012.11-.45c.9.37 1.84.62 2.8.74.58.07 1.01.59.98 1.17l-.01.25z"/>
                    </svg>
                </div>
                <h3>Phone Support</h3>
                <p>Mon–Fri, 8 AM – 6 PM. Direct line to our support specialists.</p>
                <a href="tel:+15550001234" style="color: var(--accent);">+1 (555) 000-1234</a>
            </div>

            <div class="info-card">
                <div class="info-icon ii-green">
                    <svg width="20" height="20" fill="none" stroke="#43e97b" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <h3>Email Us</h3>
                <p>We reply within 2 business hours on weekdays.</p>
                <a href="mailto:support@schoolms.io" style="color: #43e97b;">support@schoolms.io</a>
            </div>

            <div class="info-card">
                <div class="info-icon ii-amber">
                    <svg width="20" height="20" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <h3>Visit Us</h3>
                <p>Come see us at our headquarters in New York City.</p>
                <a href="https://maps.google.com" target="_blank" style="color: #f59e0b;">123 Education Ave, NY</a>
            </div>

            <div class="info-card">
                <div class="info-icon ii-pink">
                    <svg width="20" height="20" fill="none" stroke="#ff6584" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                    </svg>
                </div>
                <h3>Live Chat</h3>
                <p>Available to Pro and Enterprise plan users directly from your dashboard.</p>
                <a href="#" style="color: var(--accent2);">Open Live Chat →</a>
            </div>

            <div class="info-card">
                <div class="info-icon ii-blue">
                    <svg width="20" height="20" fill="none" stroke="#38bdf8" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M2 12h20M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/>
                    </svg>
                </div>
                <h3>Help Center</h3>
                <p>Browse our docs, tutorials, and FAQs — available around the clock.</p>
                <a href="#" style="color: #38bdf8;">Visit Help Center →</a>
            </div>

        </div>
    </section>

    <div class="ct-divider"></div>

    {{-- ─── FORM + SIDEBAR ─── --}}
    <section class="ct-section">
        <div class="ct-section-label">Send a Message</div>
        <h2 class="ct-section-title">We'd love to hear from you</h2>
        <p class="ct-section-sub">Fill out the form below and a member of our team will get back to you as soon as possible.</p>

        <div class="contact-main-grid">

            {{-- ── Form ── --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-header-text">
                        <h3>Contact Form</h3>
                        <p>All fields marked <span style="color:var(--accent2);">*</span> are required</p>
                    </div>
                    <div class="form-card-header-icon">
                        <svg width="16" height="16" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="22" y1="2" x2="11" y2="13"/>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                    </div>
                </div>

                <form id="contact-form" class="form-body" onsubmit="handleCtSubmit(event)">

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">First Name <span>*</span></label>
                            <input type="text" class="form-input" placeholder="Ahmad" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name <span>*</span></label>
                            <input type="text" class="form-input" placeholder="Hassan" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email Address <span>*</span></label>
                            <input type="email" class="form-input" placeholder="you@school.edu" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-input" placeholder="+1 (555) 000-0000">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Your Role <span>*</span></label>
                            <select class="form-input" required
                                style="background-image:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23888%22 stroke-width=%222%22><polyline points=%226 9 12 15 18 9%22/></svg>');background-repeat:no-repeat;background-position:right 1rem center;">
                                <option value="" disabled selected>Select your role…</option>
                                <option>School Administrator</option>
                                <option>Principal</option>
                                <option>Teacher</option>
                                <option>Parent / Guardian</option>
                                <option>Student</option>
                                <option>IT Staff</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">School / Institution</label>
                            <input type="text" class="form-input" placeholder="e.g. Al-Nour Academy">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Subject <span>*</span></label>
                        <input type="text" class="form-input" placeholder="e.g. Demo request, billing question, technical support…" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message <span>*</span></label>
                        <textarea class="form-input" placeholder="Tell us how we can help you…" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Priority</label>
                        <div class="priority-group">
                            <button type="button" class="p-pill p-pill-green"  onclick="selectPriority(this)">Low</button>
                            <button type="button" class="p-pill p-pill-purple" onclick="selectPriority(this)">Normal</button>
                            <button type="button" class="p-pill p-pill-amber"  onclick="selectPriority(this)">Urgent</button>
                            <button type="button" class="p-pill p-pill-pink"   onclick="selectPriority(this)">Critical</button>
                        </div>
                    </div>

                    <div class="form-footer">
                        <p class="form-footer-note">
                            By submitting you agree to our
                            <a href="#">Privacy Policy</a>.
                            We never share your data.
                        </p>
                        <button type="submit" class="btn-ct-primary" id="submit-btn">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                            Send Message
                        </button>
                    </div>

                </form>
            </div>

            {{-- ── Sidebar ── --}}
            <div class="sidebar">

                {{-- Map --}}
                <div class="sidebar-card">
                    <div class="map-placeholder">
                        <div class="map-dot-ring"></div>
                        <div class="map-dot-ring map-dot-ring-2"></div>
                        <div class="map-pin">
                            <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div class="map-badge">📍 Main Campus</div>
                    </div>
                    <div class="sidebar-card-body">
                        <div style="font-size:0.9rem;font-weight:700;color:var(--text);margin-bottom:4px;">SchoolMS Headquarters</div>
                        <div style="font-size:0.8rem;color:var(--muted);line-height:1.6;margin-bottom:0.875rem;">
                            123 Education Avenue, Suite 400<br>New York, NY 10001, USA
                        </div>
                        <a href="https://maps.google.com" target="_blank" class="btn-ct-secondary" style="font-size:0.8rem;padding:0.5rem 1rem;">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/>
                                <polyline points="15 3 21 3 21 9"/>
                                <line x1="10" y1="14" x2="21" y2="3"/>
                            </svg>
                            Open in Google Maps
                        </a>
                    </div>
                </div>

                {{-- Office Hours --}}
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <div class="sidebar-card-header-icon" style="background:rgba(67,233,123,0.10);">
                            <svg width="14" height="14" fill="none" stroke="#43e97b" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <span>Office Hours</span>
                    </div>
                    <div class="sidebar-card-body">
                        <div class="hours-row"><span class="hours-row-day">Monday – Friday</span><span class="hours-row-time">8:00 AM – 6:00 PM</span></div>
                        <div class="hours-row"><span class="hours-row-day">Saturday</span><span class="hours-row-time">9:00 AM – 2:00 PM</span></div>
                        <div class="hours-row"><span class="hours-row-day">Sunday</span><span class="hours-row-time closed">Closed</span></div>
                        <div class="online-badge">
                            <span class="online-dot"></span>
                            Support team is online now
                        </div>
                    </div>
                </div>

                {{-- Social --}}
                <div class="sidebar-card">
                    <div class="sidebar-card-header">
                        <div class="sidebar-card-header-icon" style="background:rgba(108,99,255,0.12);">
                            <svg width="14" height="14" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        </div>
                        <span>Connect with us</span>
                    </div>
                    <div class="sidebar-card-body">
                        <div class="social-grid">
                            <a href="#" class="social-btn">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#6c63ff"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                                Twitter
                            </a>
                            <a href="#" class="social-btn">
                                <svg width="14" height="14" fill="none" stroke="#43e97b" stroke-width="2" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                                LinkedIn
                            </a>
                            <a href="#" class="social-btn">
                                <svg width="14" height="14" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 00-1.94-1.96C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.4 19.54C5.12 20 12 20 12 20s6.88 0 8.6-.46a2.78 2.78 0 001.94-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon fill="#f59e0b" stroke="none" points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                                YouTube
                            </a>
                            <a href="#" class="social-btn">
                                <svg width="14" height="14" fill="none" stroke="#ff6584" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                                Live Chat
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="ct-divider"></div>

    {{-- ─── FAQ ─── --}}
    <section class="ct-section">
        <div class="ct-section-label">FAQ</div>
        <h2 class="ct-section-title">Common questions</h2>
        <p class="ct-section-sub">Can't find what you're looking for? Use the form above or email us directly.</p>

        <div class="faq-list">

            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <div class="faq-q-icon" style="background:rgba(108,99,255,0.12);">
                        <svg width="14" height="14" fill="none" stroke="#6c63ff" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <span class="faq-q-text">How quickly will I receive a response?</span>
                    <svg class="faq-chevron" width="16" height="16" fill="none" stroke="#888" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-answer"><p>Our support team responds to all messages within 2 business hours during weekdays and by the next business day on weekends. For urgent issues, use the phone line or live chat.</p></div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <div class="faq-q-icon" style="background:rgba(67,233,123,0.10);">
                        <svg width="14" height="14" fill="none" stroke="#43e97b" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <span class="faq-q-text">Can I schedule a product demo?</span>
                    <svg class="faq-chevron" width="16" height="16" fill="none" stroke="#888" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-answer"><p>Absolutely! Select "Demo Request" as your subject in the contact form and a product specialist will reach out to schedule a 30-minute walkthrough tailored to your school's needs.</p></div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <div class="faq-q-icon" style="background:rgba(245,158,11,0.10);">
                        <svg width="14" height="14" fill="none" stroke="#f59e0b" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <span class="faq-q-text">Do you offer on-site setup support?</span>
                    <svg class="faq-chevron" width="16" height="16" fill="none" stroke="#888" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-answer"><p>Yes, for Enterprise plans we provide dedicated on-site implementation specialists who will configure SchoolMS for your institution, train your staff, and stay on-call during the first term.</p></div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <div class="faq-q-icon" style="background:rgba(255,101,132,0.10);">
                        <svg width="14" height="14" fill="none" stroke="#ff6584" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <span class="faq-q-text">Is there a free trial available?</span>
                    <svg class="faq-chevron" width="16" height="16" fill="none" stroke="#888" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-answer"><p>Yes! Every new school gets a full-featured 30-day free trial, no credit card required. After the trial you can choose the plan that fits your school's size and budget.</p></div>
            </div>

            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-question">
                    <div class="faq-q-icon" style="background:rgba(56,189,248,0.10);">
                        <svg width="14" height="14" fill="none" stroke="#38bdf8" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <span class="faq-q-text">How secure is our school's data?</span>
                    <svg class="faq-chevron" width="16" height="16" fill="none" stroke="#888" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-answer"><p>All data is encrypted at rest and in transit. We are SOC 2 Type II certified and fully FERPA compliant. We never share or sell student data to any third parties.</p></div>
            </div>

        </div>
    </section>

    {{-- ─── CTA BANNER ─── --}}
    <div class="cta-banner-wrap">
        <div class="cta-banner">
            <h2>Still have questions?</h2>
            <p>Our team is happy to walk you through SchoolMS and answer anything on your mind. No pressure, no sales pitch.</p>
            <div class="cta-actions">
                <a href="{{ route('register') }}" class="btn-ct-primary">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                    Start Free Trial
                </a>
                <a href="{{ url('/about') }}" class="btn-ct-secondary">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    About SchoolMS
                </a>
            </div>
        </div>
    </div>

</div>

<div id="ct-toast">
    <svg width="16" height="16" fill="none" stroke="#43e97b" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
    Message sent! We'll be in touch soon.
</div>
@endsection

@section('scripts')
<script>
    /* ── Intersection observer (mirrors about page exactly) ── */
    const ctObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';
                entry.target.style.transition = `opacity 0.5s ease ${i * 0.08}s, transform 0.5s ease ${i * 0.08}s`;
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, 50);
                ctObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.info-card, .faq-item, .sidebar-card').forEach(el => ctObserver.observe(el));

    /* ── Priority pills ── */
    function selectPriority(el) {
        document.querySelectorAll('.p-pill').forEach(p => p.style.outline = '');
        el.style.outline = '2px solid currentColor';
        el.style.outlineOffset = '2px';
    }

    /* ── FAQ accordion ── */
    function toggleFaq(el) {
        const isOpen = el.classList.contains('open');
        document.querySelectorAll('.faq-item.open').forEach(f => f.classList.remove('open'));
        if (!isOpen) el.classList.add('open');
    }

    /* ── Form submit ── */
    function handleCtSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('submit-btn');
        btn.textContent = 'Sending…';
        btn.disabled = true;
        setTimeout(() => {
            btn.innerHTML = '✓ &nbsp;Sent!';
            btn.style.background = '#43e97b';
            showCtToast();
            setTimeout(() => {
                e.target.reset();
                btn.innerHTML = `<svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Send Message`;
                btn.disabled = false;
                btn.style.background = '';
            }, 3000);
        }, 1400);
    }

    function showCtToast() {
        const t = document.getElementById('ct-toast');
        t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), 4000);
    }
</script>
@endsection
