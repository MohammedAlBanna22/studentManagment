@extends('app.layout')

@section('head')
<title>About Us — SchoolMS</title>
@endsection

@section('styles')
<style>
/* ─── ABOUT PAGE STYLES ─── */
.about-wrap { padding-bottom: 4rem; }

/* ── Hero ── */
.about-hero {
    position: relative;
    padding: 5rem 2rem 4rem;
    text-align: center;
    overflow: hidden;
}
.about-hero-glow {
    position: absolute;
    width: 700px; height: 700px;
    border-radius: 50%;
    top: -200px; left: 50%;
    transform: translateX(-50%);
    background: radial-gradient(circle, rgba(108,99,255,0.18) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}
.about-hero-grid {
    position: absolute; inset: 0; z-index: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
    background-size: 40px 40px;
    mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
    -webkit-mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 40%, transparent 100%);
}
.about-badge {
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
.about-badge-dot {
    width: 6px; height: 6px;
    background: var(--accent3); border-radius: 50%;
    animation: abpulse 2s infinite;
}
@keyframes abpulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(1.4); }
}
.about-hero h1 {
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 800; line-height: 1.1;
    letter-spacing: -0.03em;
    position: relative; z-index: 1;
    margin-bottom: 1.25rem;
    color: var(--text);
}
.about-hero h1 span {
    background: linear-gradient(135deg, var(--accent), #a78bfa, var(--accent2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.about-hero-sub {
    font-size: 1.05rem; color: var(--muted);
    max-width: 580px; margin: 0 auto;
    line-height: 1.7; position: relative; z-index: 1;
}

/* ── Shared section ── */
.ab-section {
    padding: 4rem 2rem;
    max-width: 1200px;
    margin: 0 auto;
}
.ab-section-label {
    font-size: 0.72rem; font-weight: 700;
    color: var(--accent);
    text-transform: uppercase; letter-spacing: 0.12em;
    margin-bottom: 0.75rem;
}
.ab-section-title {
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 800; letter-spacing: -0.02em;
    margin-bottom: 0.75rem; line-height: 1.2;
    color: var(--text);
}
.ab-section-sub {
    font-size: 0.95rem; color: var(--muted);
    line-height: 1.7; max-width: 520px;
}
.ab-divider {
    height: 1px; background: var(--border);
    margin: 0 2rem;
}

/* ── Buttons ── */
.btn-ab-primary {
    padding: 0.75rem 2rem;
    background: var(--accent); color: #fff;
    border: none; border-radius: 12px;
    font-size: 0.9rem; font-weight: 600;
    cursor: pointer; transition: all 0.2s;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-ab-primary:hover {
    background: #5a52e0;
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(108,99,255,0.35);
    color: #fff; text-decoration: none;
}
.btn-ab-secondary {
    padding: 0.75rem 2rem;
    background: var(--surface2); color: var(--text);
    border: 1px solid var(--border); border-radius: 12px;
    font-size: 0.9rem; font-weight: 600;
    cursor: pointer; transition: all 0.2s;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 8px;
}
.btn-ab-secondary:hover {
    border-color: rgba(108,99,255,0.4);
    background: rgba(108,99,255,0.08);
    transform: translateY(-1px);
    color: var(--text); text-decoration: none;
}

/* ── Mission ── */
.mission-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
    margin-top: 3rem;
}
.mission-text p {
    font-size: 0.95rem; color: var(--muted);
    line-height: 1.8; margin-bottom: 1.25rem;
}
.mission-text p:last-child { margin-bottom: 0; }
.mission-visual {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 2.5rem;
    position: relative; overflow: hidden;
}
.mission-visual::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(circle at 80% 20%, rgba(108,99,255,0.08), transparent 60%);
    pointer-events: none;
}
.mission-stat-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}
.mission-stat {
    text-align: center;
    padding: 1.25rem;
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 14px;
}
.mission-stat-num {
    font-size: 2rem; font-weight: 800;
    letter-spacing: -0.03em;
    margin-bottom: 4px; line-height: 1;
}
.mission-stat-num.c-purple { color: var(--accent); }
.mission-stat-num.c-green  { color: var(--accent3); }
.mission-stat-num.c-pink   { color: var(--accent2); }
.mission-stat-num.c-amber  { color: #f59e0b; }
.mission-stat-lbl {
    font-size: 0.75rem; color: var(--muted);
    text-transform: uppercase; letter-spacing: 0.08em; font-weight: 500;
}
.mission-visual-label {
    font-size: 0.8rem; font-weight: 600; color: var(--muted);
    text-transform: uppercase; letter-spacing: 0.1em;
    margin-bottom: 1.5rem;
    display: flex; align-items: center; gap: 8px;
}
.mission-visual-label::after {
    content: ''; flex: 1; height: 1px;
    background: var(--border);
}

/* ── Values ── */
.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
    margin-top: 3rem;
}
.value-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 1.75rem;
    transition: all 0.3s;
    position: relative; overflow: hidden;
}
.value-card::before {
    content: '';
    position: absolute; inset: 0;
    border-radius: 16px;
    opacity: 0; transition: opacity 0.3s;
    pointer-events: none;
    background: radial-gradient(circle at 50% 0%, rgba(108,99,255,0.06), transparent 70%);
}
.value-card:hover { transform: translateY(-4px); border-color: rgba(108,99,255,0.3); }
.value-card:hover::before { opacity: 1; }
.value-icon {
    width: 44px; height: 44px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 1.25rem;
}
.vi-purple { background: rgba(108,99,255,0.15); }
.vi-green  { background: rgba(67,233,123,0.12); }
.vi-pink   { background: rgba(255,101,132,0.12); }
.vi-amber  { background: rgba(245,158,11,0.12); }
.vi-blue   { background: rgba(56,189,248,0.12); }
.vi-teal   { background: rgba(20,184,166,0.12); }
.value-card h3 {
    font-size: 1rem; font-weight: 700;
    margin-bottom: 0.5rem; letter-spacing: -0.01em;
    color: var(--text);
}
.value-card p { font-size: 0.85rem; color: var(--muted); line-height: 1.6; margin: 0; }

/* ── Team ── */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
    margin-top: 3rem;
}
.team-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 1.75rem;
    text-align: center;
    transition: all 0.3s;
    position: relative; overflow: hidden;
}
.team-card:hover { transform: translateY(-4px); border-color: rgba(108,99,255,0.3); }
.team-avatar {
    width: 72px; height: 72px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; font-weight: 800;
    margin: 0 auto 1rem;
    border: 2px solid var(--border);
}
.ta-purple { background: rgba(108,99,255,0.15); color: var(--accent); }
.ta-green  { background: rgba(67,233,123,0.12); color: #22c55e; }
.ta-pink   { background: rgba(255,101,132,0.12); color: var(--accent2); }
.ta-amber  { background: rgba(245,158,11,0.12); color: #f59e0b; }
.ta-blue   { background: rgba(56,189,248,0.12); color: #38bdf8; }
.ta-teal   { background: rgba(20,184,166,0.12); color: #14b8a6; }
.team-card h3 { font-size: 0.95rem; font-weight: 700; margin-bottom: 4px; color: var(--text); }
.team-role {
    font-size: 0.78rem; color: var(--accent);
    font-weight: 600; text-transform: uppercase;
    letter-spacing: 0.06em; margin-bottom: 0.75rem;
}
.team-card p { font-size: 0.8rem; color: var(--muted); line-height: 1.6; margin: 0; }

/* ── Timeline ── */
.timeline {
    position: relative;
    margin-top: 3rem;
    padding-left: 2rem;
}
.timeline::before {
    content: '';
    position: absolute; left: 0; top: 0; bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, var(--accent), rgba(108,99,255,0.1));
    border-radius: 2px;
}
.timeline-item {
    position: relative;
    padding: 0 0 2.5rem 2rem;
}
.timeline-item:last-child { padding-bottom: 0; }
.timeline-dot {
    position: absolute;
    left: -2.375rem;
    top: 4px;
    width: 14px; height: 14px;
    border-radius: 50%;
    background: var(--accent);
    border: 3px solid var(--surface);
    box-shadow: 0 0 0 2px var(--accent);
    flex-shrink: 0;
}
.timeline-dot.green { background: var(--accent3); box-shadow: 0 0 0 2px var(--accent3); }
.timeline-dot.pink  { background: var(--accent2); box-shadow: 0 0 0 2px var(--accent2); }
.timeline-dot.amber { background: #f59e0b; box-shadow: 0 0 0 2px #f59e0b; }
.timeline-dot.blue  { background: #38bdf8; box-shadow: 0 0 0 2px #38bdf8; }
.timeline-year {
    font-size: 0.72rem; font-weight: 700;
    color: var(--accent); text-transform: uppercase;
    letter-spacing: 0.1em; margin-bottom: 6px;
}
.timeline-title {
    font-size: 1rem; font-weight: 700;
    color: var(--text); margin-bottom: 6px;
}
.timeline-desc {
    font-size: 0.85rem; color: var(--muted);
    line-height: 1.6; max-width: 520px;
}

/* ── Contact Banner ── */
.contact-banner-wrap {
    max-width: 1200px; margin: 0 auto;
    padding: 0 2rem 4rem;
}
.contact-banner {
    background: linear-gradient(135deg, rgba(108,99,255,0.12), rgba(255,101,132,0.08));
    border: 1px solid rgba(108,99,255,0.2);
    border-radius: 20px; padding: 3rem;
    text-align: center;
    position: relative; overflow: hidden;
}
.contact-banner::before {
    content: '';
    position: absolute;
    width: 500px; height: 500px;
    border-radius: 50%;
    top: -200px; left: 50%;
    transform: translateX(-50%);
    background: radial-gradient(circle, rgba(108,99,255,0.1) 0%, transparent 70%);
    pointer-events: none;
}
.contact-banner h2 {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 800; color: var(--text);
    letter-spacing: -0.02em; margin-bottom: 0.75rem;
    position: relative; z-index: 1;
}
.contact-banner p {
    font-size: 0.95rem; color: var(--muted);
    max-width: 480px; margin: 0 auto 2rem;
    line-height: 1.7; position: relative; z-index: 1;
}
.contact-actions {
    display: flex; gap: 12px;
    justify-content: center; flex-wrap: wrap;
    position: relative; z-index: 1;
}

/* ── Partner logos strip ── */
.partners-strip {
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    padding: 2rem;
    overflow: hidden;
}
.partners-label {
    text-align: center;
    font-size: 0.72rem; font-weight: 700;
    color: var(--muted); text-transform: uppercase;
    letter-spacing: 0.12em; margin-bottom: 1.5rem;
}
.partners-row {
    display: flex; gap: 2.5rem;
    justify-content: center; flex-wrap: wrap;
    align-items: center;
}
.partner-pill {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 18px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 999px;
    font-size: 0.8rem; font-weight: 600;
    color: var(--muted);
    transition: all 0.2s;
}
.partner-pill:hover { border-color: rgba(108,99,255,0.3); color: var(--text); }
.partner-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

/* ── Fade-in ── */
@keyframes abfadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
.abfade { animation: abfadeUp 0.6s ease forwards; }
.abd1   { animation-delay: 0.05s; opacity: 0; }
.abd2   { animation-delay: 0.15s; opacity: 0; }
.abd3   { animation-delay: 0.25s; opacity: 0; }

/* ── Responsive ── */
@media (max-width: 900px) {
    .mission-grid { grid-template-columns: 1fr; gap: 2rem; }
}
@media (max-width: 768px) {
    .team-grid   { grid-template-columns: repeat(2, 1fr); }
    .contact-actions { flex-direction: column; align-items: center; }
}
@media (max-width: 480px) {
    .about-hero h1 { font-size: 2rem; }
    .team-grid     { grid-template-columns: 1fr; }
    .mission-stat-grid { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')
<div class="about-wrap">

    {{-- ─── HERO ─── --}}
    <section class="about-hero">
        <div class="about-hero-glow"></div>
        <div class="about-hero-grid"></div>

        <div class="about-badge abfade">
            <span class="about-badge-dot"></span>
            Established 2015
        </div>

        <h1 class="abfade abd1">
            Built for <span>Schools</span>,<br>Designed for People
        </h1>

        <p class="about-hero-sub abfade abd2">
            SchoolMS was founded with a single belief — that school administration
            should empower educators, not overwhelm them. A decade later, we serve
            hundreds of schools across the region.
        </p>
    </section>

    {{-- ─── PARTNERS STRIP ─── --}}
    <div class="partners-strip abfade abd3">
        <div class="partners-label">Trusted by leading schools &amp; institutions</div>
        <div class="partners-row">
            <div class="partner-pill">
                <span class="partner-dot" style="background:var(--accent)"></span>
                Al-Nour Academy
            </div>
            <div class="partner-pill">
                <span class="partner-dot" style="background:var(--accent3)"></span>
                Bright Futures School
            </div>
            <div class="partner-pill">
                <span class="partner-dot" style="background:var(--accent2)"></span>
                Pioneer Institute
            </div>
            <div class="partner-pill">
                <span class="partner-dot" style="background:#f59e0b"></span>
                Horizon College
            </div>
            <div class="partner-pill">
                <span class="partner-dot" style="background:#38bdf8"></span>
                Greenfield Academy
            </div>
            <div class="partner-pill">
                <span class="partner-dot" style="background:#14b8a6"></span>
                Sunrise Schools
            </div>
        </div>
    </div>

    {{-- ─── MISSION ─── --}}
    <section class="ab-section">
        <div class="mission-grid">
            <div>
                <div class="ab-section-label">Our Mission</div>
                <h2 class="ab-section-title">Simplifying school management, one campus at a time</h2>
                <div class="mission-text">
                    <p>
                        SchoolMS was born out of frustration. Our founders — former teachers and
                        school administrators — spent years fighting clunky spreadsheets, disconnected
                        systems, and mountains of paperwork. They knew there had to be a better way.
                    </p>
                    <p>
                        In 2015, we built the first version of SchoolMS in a small office with a team
                        of five. Today, we power student management for hundreds of schools,
                        from small private institutes to large public campuses.
                    </p>
                    <p>
                        Our mission is simple: give schools a single, unified platform that handles
                        everything — from enrollment and attendance to grades and communication —
                        so teachers can focus on what matters most: their students.
                    </p>
                </div>
            </div>

            <div class="mission-visual">
                <div class="mission-visual-label">School network at a glance</div>
                <div class="mission-stat-grid">
                    <div class="mission-stat">
                        <div class="mission-stat-num c-purple">340+</div>
                        <div class="mission-stat-lbl">Schools</div>
                    </div>
                    <div class="mission-stat">
                        <div class="mission-stat-num c-green">120k+</div>
                        <div class="mission-stat-lbl">Students</div>
                    </div>
                    <div class="mission-stat">
                        <div class="mission-stat-num c-amber">9,800+</div>
                        <div class="mission-stat-lbl">Teachers</div>
                    </div>
                    <div class="mission-stat">
                        <div class="mission-stat-num c-pink">10 yrs</div>
                        <div class="mission-stat-lbl">Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="ab-divider"></div>

    {{-- ─── VALUES ─── --}}
    <section class="ab-section">
        <div class="ab-section-label">What We Stand For</div>
        <h2 class="ab-section-title">Our core values</h2>
        <p class="ab-section-sub">Everything we build, every decision we make, is guided by these principles.</p>

        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon vi-purple">
                    <svg width="20" height="20" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h3>Trust &amp; Security</h3>
                <p>Student data is sacred. We apply rigorous security standards and never share or sell information to third parties.</p>
            </div>

            <div class="value-card">
                <div class="value-icon vi-green">
                    <svg width="20" height="20" fill="none" stroke="#43e97b" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                        <line x1="9" y1="9" x2="9.01" y2="9"/>
                        <line x1="15" y1="9" x2="15.01" y2="9"/>
                    </svg>
                </div>
                <h3>Student First</h3>
                <p>Every feature we design starts with the question: how does this help the student? Academic success drives every product decision.</p>
            </div>

            <div class="value-card">
                <div class="value-icon vi-amber">
                    <svg width="20" height="20" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </div>
                <h3>Continuous Improvement</h3>
                <p>We ship updates every two weeks, driven by feedback from the administrators, teachers, and students who use our platform daily.</p>
            </div>

            <div class="value-card">
                <div class="value-icon vi-blue">
                    <svg width="20" height="20" fill="none" stroke="#38bdf8" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <h3>Community &amp; Inclusion</h3>
                <p>We build for schools of all sizes and budgets, with flexible pricing and accessible design that leaves no campus behind.</p>
            </div>

            <div class="value-card">
                <div class="value-icon vi-pink">
                    <svg width="20" height="20" fill="none" stroke="#ff6584" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 00-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0020 4.77 5.07 5.07 0 0019.91 1S18.73.65 16 2.48a13.38 13.38 0 00-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 005 4.77a5.44 5.44 0 00-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 009 18.13V22"/>
                    </svg>
                </div>
                <h3>Open &amp; Transparent</h3>
                <p>No hidden fees, no lock-in contracts. We believe schools deserve clear pricing, open APIs, and honest communication.</p>
            </div>

            <div class="value-card">
                <div class="value-icon vi-teal">
                    <svg width="20" height="20" fill="none" stroke="#14b8a6" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 8h1a4 4 0 010 8h-1"/>
                        <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/>
                        <line x1="6" y1="1" x2="6" y2="4"/>
                        <line x1="10" y1="1" x2="10" y2="4"/>
                        <line x1="14" y1="1" x2="14" y2="4"/>
                    </svg>
                </div>
                <h3>World-Class Support</h3>
                <p>Our support team is made up of former educators who understand schools. Real humans, real answers — within hours, not days.</p>
            </div>
        </div>
    </section>

    <div class="ab-divider"></div>

    {{-- ─── TEAM ─── --}}
    <section class="ab-section">
        <div class="ab-section-label">The People</div>
        <h2 class="ab-section-title">Meet the team</h2>
        <p class="ab-section-sub">Former educators, engineers, and designers united by a passion for better schools.</p>

        <div class="team-grid">
            <div class="team-card">
                <div class="team-avatar ta-purple">KA</div>
                <h3>Khalid Al-Amin</h3>
                <div class="team-role">Co-Founder &amp; CEO</div>
                <p>Former high school principal with 15 years in education. Drives product vision and school partnerships.</p>
            </div>

            <div class="team-card">
                <div class="team-avatar ta-green">LM</div>
                <h3>Layla Mansouri</h3>
                <div class="team-role">Co-Founder &amp; CTO</div>
                <p>Full-stack engineer and former CS teacher. Architected SchoolMS from the ground up.</p>
            </div>

            <div class="team-card">
                <div class="team-avatar ta-amber">YR</div>
                <h3>Yusuf Rashid</h3>
                <div class="team-role">Head of Design</div>
                <p>UX designer focused on accessibility and simplicity. Believes great software should feel obvious.</p>
            </div>

            <div class="team-card">
                <div class="team-avatar ta-pink">NI</div>
                <h3>Nour Ibrahim</h3>
                <div class="team-role">Head of Customer Success</div>
                <p>Onboards every new school personally. Former teacher — she knows exactly what administrators need.</p>
            </div>

            <div class="team-card">
                <div class="team-avatar ta-blue">SA</div>
                <h3>Sami Al-Zein</h3>
                <div class="team-role">Lead Engineer</div>
                <p>Backend specialist who keeps SchoolMS fast and reliable for thousands of concurrent users.</p>
            </div>

            <div class="team-card">
                <div class="team-avatar ta-teal">RH</div>
                <h3>Rana Hassan</h3>
                <div class="team-role">Product Manager</div>
                <p>Translates school feedback into features. Obsessed with shipping things that actually get used.</p>
            </div>
        </div>
    </section>

    <div class="ab-divider"></div>

    {{-- ─── TIMELINE ─── --}}
    <section class="ab-section">
        <div class="ab-section-label">Our Journey</div>
        <h2 class="ab-section-title">A decade of growth</h2>
        <p class="ab-section-sub">From a five-person team to a platform trusted by hundreds of schools.</p>

        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-year">2015 — Founded</div>
                <div class="timeline-title">SchoolMS launches its first version</div>
                <div class="timeline-desc">A small team of educators and developers build the first prototype in Amman, Jordan. The first three schools sign up within a month.</div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot green"></div>
                <div class="timeline-year">2017 — Growth</div>
                <div class="timeline-title">50 schools, first mobile app</div>
                <div class="timeline-desc">We reached 50 partner schools and launched our mobile attendance app, making daily roll-call instant for teachers on the go.</div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot amber"></div>
                <div class="timeline-year">2019 — Expansion</div>
                <div class="timeline-title">Regional reach &amp; Grade Analytics</div>
                <div class="timeline-desc">SchoolMS expanded to five countries across the MENA region. Launched our grade analytics dashboard — now used by over 8,000 teachers.</div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot pink"></div>
                <div class="timeline-year">2021 — Pandemic Pivot</div>
                <div class="timeline-title">Remote learning &amp; parent portal</div>
                <div class="timeline-desc">We shipped a parent-facing portal in 30 days to support schools moving online. Over 40,000 parents signed up in the first term.</div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot blue"></div>
                <div class="timeline-year">2025 — Today</div>
                <div class="timeline-title">340+ schools, new admin suite</div>
                <div class="timeline-desc">SchoolMS now serves 340 schools and 120,000 students. We launched our redesigned admin suite and are expanding into North Africa.</div>
            </div>
        </div>
    </section>

    {{-- ─── CTA BANNER ─── --}}
    <div class="contact-banner-wrap">
        <div class="contact-banner">
            <h2>Ready to transform your school?</h2>
            <p>Join hundreds of schools already using SchoolMS to simplify administration and put students first.</p>
            <div class="contact-actions">
                <a href="{{ route('login') }}" class="btn-ab-primary">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                    Get Started Free
                </a>
                <a href="mailto:hello@schoolms.com" class="btn-ab-secondary">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    Contact Us
                </a>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
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

    document.querySelectorAll('.value-card, .team-card, .timeline-item, .partner-pill').forEach(el => observer.observe(el));
</script>
@endsection
