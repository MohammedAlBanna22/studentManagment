<!DOCTYPE html>
<html lang="en" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay School Fees</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #f4f6f9;
            --surface: #ffffff;
            --surface2: #f0f2f5;
            --border: rgba(0,0,0,0.09);
            --accent: #6c63ff;
            --accent2: #ff6584;
            --accent3: #43e97b;
            --text: #1a1a2e;
            --muted: #6b7280;
            --shadow: 0 4px 24px rgba(0,0,0,0.08);
        }

        [data-theme="dark"] {
            --bg: #0a0a0f;
            --surface: #111118;
            --surface2: #1a1a24;
            --border: rgba(255,255,255,0.07);
            --text: #f0f0f8;
            --muted: #8888aa;
            --shadow: 0 8px 40px rgba(0,0,0,0.5);
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            transition: background 0.3s;
        }

        .page-wrap {
            width: 100%;
            max-width: 460px;
        }

        /* Theme toggle */
        .theme-toggle {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 12px;
        }

        .toggle-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            color: var(--muted);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
        }

        .toggle-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* Card */
        .payment-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: background 0.3s, border-color 0.3s;
            animation: fadeUp 0.4s ease both;
        }

        /* Header */
        .payment-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border);
        }

        .header-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(108,99,255,0.12);
            border: 1px solid rgba(108,99,255,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .payment-header h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
        }

        .payment-header p {
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
        }

        /* Alert */
        .alert-success {
            background: rgba(67,233,123,0.08);
            border: 1px solid rgba(67,233,123,0.2);
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 1.25rem;
            color: #27a75e;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        [data-theme="dark"] .alert-success { color: var(--accent3); }

        /* Form */
        .form-group { margin-bottom: 1rem; }

        .form-group label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--text);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, background 0.3s;
        }

        .form-group input::placeholder { color: var(--muted); }
        .form-group input:focus { border-color: rgba(108,99,255,0.5); }

        /* Stripe card element */
        #card-element {
            padding: 13px 14px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: border-color 0.2s, background 0.3s;
        }

        #card-element.focused { border-color: rgba(108,99,255,0.5); }

        #error-message {
            color: var(--accent2);
            font-size: 12px;
            margin-top: 6px;
            min-height: 16px;
        }

        /* Pay button */
        .pay-btn {
            width: 100%;
            padding: 13px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 1.25rem;
            letter-spacing: 0.02em;
            transition: background 0.2s, transform 0.1s;
        }

        .pay-btn:hover { background: #7c74ff; }
        .pay-btn:active { transform: scale(0.98); }
        .pay-btn:disabled {
            background: #3d3a6e;
            color: var(--muted);
            cursor: not-allowed;
        }

        /* Secure note */
        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 1rem;
            font-size: 11px;
            color: var(--muted);
        }

        /* Spinner */
        .spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            vertical-align: middle;
            margin-right: 6px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--muted);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s, color 0.2s, transform 0.1s;
            margin-bottom: 1.25rem;
        }

        .back-btn:hover {
                background: rgba(108,99,255,0.08);
                border-color: rgba(108,99,255,0.3);
                color: var(--accent);
                transform: translateX(-2px);
            }

        @keyframes spin { to { transform: rotate(360deg); } }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="page-wrap">

    {{-- Theme Toggle --}}
    <div class="theme-toggle">
        <button class="toggle-btn" id="theme-btn" onclick="toggleTheme()">
            <svg id="theme-icon" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
            </svg>
            <span id="theme-label">Light mode</span>
        </button>
    </div>

    <div class="payment-card">

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert-success">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif


       <!-- Back Button -->
        <a href="{{ route('school.index')}}"class="back-btn">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <polyline points="15 18 9 12 15 6"/>
        </svg>
        Back to Home
        </a>

        {{-- Header --}}
        <div class="payment-header">

            <div class="header-icon">
                <svg width="20" height="20" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="1" y="4" width="22" height="16" rx="2"/>
                    <line x1="1" y1="10" x2="23" y2="10"/>
                </svg>
            </div>
            <div>
                <h2>Pay School Fees</h2>
                <p>Secured by Stripe</p>
            </div>
        </div>

        {{-- Form --}}
        <div id="payment-form">

            <div class="form-group">
                <label for="amount">Amount (USD)</label>
                <input type="number" id="amount" placeholder="e.g. 500" min="1" required />
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" placeholder="e.g. Tuition Fee" required />
            </div>

            <div class="form-group">
                <label>Card details</label>
                <div id="card-element"></div>
                <div id="error-message"></div>
            </div>

            <button class="pay-btn" id="submit-btn" type="button">Pay Now</button>

            <div class="secure-note">
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
                Your payment is encrypted and secure
            </div>

        </div>
    </div>
</div>

<script>
    const root  = document.getElementById('html-root');
    const label = document.getElementById('theme-label');
    const icon  = document.getElementById('theme-icon');

    let isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    function applyTheme() {
        root.setAttribute('data-theme', isDark ? 'dark' : 'light');
        label.textContent = isDark ? 'Light mode' : 'Dark mode';
        icon.innerHTML = isDark
            ? '<path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>'
            : '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>';
    }

    function toggleTheme() {
        isDark = !isDark;
        applyTheme();
        remountCard(); // Recreate card with new colors
    }

    applyTheme();

    // Stripe setup
    const stripe = Stripe('{{ $stripeKey }}');
    let elements = stripe.elements();
    let card;

    function getCardStyle() {
        return {
            base: {
                fontSize: '14px',
                color: isDark ? '#f0f0f8' : '#1a1a2e',
                fontFamily: "'Plus Jakarta Sans', sans-serif",
                '::placeholder': { color: isDark ? '#8888aa' : '#6b7280' },
                iconColor: '#6c63ff',
            },
            invalid: { color: '#ff6584', iconColor: '#ff6584' }
        };
    }

    function mountCard() {
        card = elements.create('card', { style: getCardStyle() });
        card.mount('#card-element');

        card.on('focus', () => document.getElementById('card-element').classList.add('focused'));
        card.on('blur',  () => document.getElementById('card-element').classList.remove('focused'));
        card.on('change', (e) => {
            document.getElementById('error-message').innerText = e.error ? e.error.message : '';
        });
    }

    function remountCard() {
        // Destroy old card and recreate with new theme colors
        card.destroy();
        document.getElementById('card-element').innerHTML = '';
        document.getElementById('card-element').classList.remove('focused');
        elements = stripe.elements();
        mountCard();
    }

    document.addEventListener('DOMContentLoaded', function () {
        mountCard();

        document.getElementById('submit-btn').addEventListener('click', async () => {

            const amount      = document.getElementById('amount').value;
            const description = document.getElementById('description').value;
            const btn         = document.getElementById('submit-btn');
            const errorDiv    = document.getElementById('error-message');

            if (!amount || amount <= 0) { errorDiv.innerText = 'Please enter a valid amount.'; return; }
            if (!description.trim())    { errorDiv.innerText = 'Please enter a description.'; return; }

            btn.disabled  = true;
            btn.innerHTML = '<span class="spinner"></span> Processing...';
            errorDiv.innerText = '';

            try {
                const response = await fetch('{{ route("payment.intent") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ amount, description })
                });

                const data = await response.json();
                if (!data.clientSecret) throw new Error('Failed to initialize payment.');

                const result = await stripe.confirmCardPayment(data.clientSecret, {
                    payment_method: { card }
                });

                if (result.error) {
                    errorDiv.innerText = result.error.message;
                    btn.disabled  = false;
                    btn.innerHTML = 'Pay Now';
                } else {
                    btn.innerHTML = '&#10003; Payment successful! Redirecting...';
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("payment.success") }}';
                    form.innerHTML = `
                        <input type="hidden" name="_token"         value="{{ csrf_token() }}" />
                        <input type="hidden" name="amount"         value="${amount}" />
                        <input type="hidden" name="payment_intent" value="${result.paymentIntent.id}" />
                        <input type="hidden" name="description"    value="${description}" />
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }

            } catch (err) {
                errorDiv.innerText = err.message || 'Something went wrong. Please try again.';
                btn.disabled  = false;
                btn.innerHTML = 'Pay Now';
            }
        });
    });
</script>

</body>
</html>
