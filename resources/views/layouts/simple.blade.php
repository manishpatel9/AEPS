<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RudraxPay')</title>
    <meta name="description" content="RudraxPay AEPS - secure, professional, and user-friendly fintech services for retailers.">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --font-sans: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            --font-display: Georgia, "Times New Roman", serif;
            --ink: #0b1b2b;
            --ink-2: #1f2a44;
            --muted: #5b6b82;
            --primary: #0ea5a4;
            --primary-dark: #0f766e;
            --secondary: #2563eb;
            --accent: #f59e0b;
            --bg: #f4f7fb;
            --surface: #ffffff;
            --surface-2: #f0f4f8;
            --stroke: rgba(11,27,43,0.1);
            --shadow: 0 18px 50px rgba(11,27,43,0.12);
            --shadow-strong: 0 30px 80px rgba(11,27,43,0.18);
            --radius: 18px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-sans);
            background: var(--bg);
            color: var(--ink);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            inset: -20% -10% 0 -10%;
            background:
                radial-gradient(60% 40% at 12% 8%, rgba(14,165,164,0.22) 0%, transparent 60%),
                radial-gradient(45% 35% at 88% 12%, rgba(37,99,235,0.18) 0%, transparent 60%),
                radial-gradient(50% 35% at 50% 90%, rgba(245,158,11,0.2) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(120deg, rgba(14,165,164,0.05) 0%, rgba(37,99,235,0.06) 50%, rgba(245,158,11,0.05) 100%);
            pointer-events: none;
            z-index: 0;
        }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .simple-nav {
            position: sticky;
            top: 0;
            z-index: 200;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--stroke);
            box-shadow: 0 8px 24px rgba(11,27,43,0.08);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 14px 0;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            color: var(--ink);
        }
        .brand img { height: 48px; width: auto; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.1; }
        .brand-text span { font-family: var(--font-display); font-size: 18px; }
        .brand-text small { font-size: 12px; color: var(--muted); font-weight: 600; }

        .nav-links {
            display: flex;
            gap: 22px;
            align-items: center;
            font-weight: 600;
            color: var(--ink-2);
        }
        .nav-links a { position: relative; padding: 6px 0; }
        .nav-links a::after {
            content: '';
            position: absolute;
            left: 0; right: 0; bottom: -6px;
            height: 2px; background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0); transform-origin: left; transition: transform .2s ease;
        }
        .nav-links a:hover::after { transform: scaleX(1); }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .nav-toggle {
            display: none;
            width: 44px; height: 44px; border-radius: 12px;
            border: 1px solid var(--stroke); background: var(--surface);
            align-items: center; justify-content: center; cursor: pointer;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .btn-primary {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 10px 24px rgba(14,165,164,0.22);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 16px 32px rgba(14,165,164,0.28); }
        .btn-outline {
            background: var(--surface);
            border: 1px solid var(--stroke);
            color: var(--ink-2);
        }
        .btn-outline:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(11,27,43,0.12); }

        .simple-main { padding: 70px 0; }
        .hero {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 28px;
            align-items: center;
        }
        .hero-left h1 {
            font-family: var(--font-display);
            font-size: clamp(30px, 3.4vw, 44px);
            margin-bottom: 12px;
        }
        .hero-left p { color: var(--muted); line-height: 1.6; font-size: 16px; }
        .hero-right { display: grid; gap: 16px; }
        .card {
            background: var(--surface);
            border: 1px solid var(--stroke);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
        }
        .cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 12px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: #fff;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(14,165,164,0.22);
        }
        .grid { display: grid; gap: 12px; }
        .feature { padding: 10px 0; border-bottom: 1px dashed rgba(11,27,43,0.1); }
        .feature:last-child { border-bottom: none; }
        .page-animate { animation: rise .5s ease both; }
        @keyframes rise { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }

        .simple-footer {
            margin-top: 60px;
            padding: 50px 0 30px;
            background: linear-gradient(180deg,#0b1b2b 0%, #07111f 100%);
            color: #cbd5e1;
        }
        .footer-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap: 26px;
        }
        .footer-title { font-weight: 700; margin-bottom: 10px; color: #f8fafc; }
        .footer-list { list-style: none; display: grid; gap: 8px; font-size: 14px; }
        .footer-bottom { margin-top: 24px; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.08); font-size: 13px; color: #94a3b8; display:flex; justify-content:space-between; flex-wrap: wrap; gap: 12px; }

        @media (max-width: 980px) {
            .hero { grid-template-columns: 1fr; }
            .simple-main { padding-top: 40px; }
        }
        @media (max-width: 860px) {
            .nav-links { display: none; position: absolute; top: 68px; left: 20px; right: 20px; flex-direction: column; background: var(--surface); border: 1px solid var(--stroke); padding: 14px; border-radius: 16px; box-shadow: var(--shadow); }
            .nav-links.open { display: flex; }
            .nav-toggle { display: inline-flex; }
        }
        @media (max-width: 640px) {
            .btn, .cta { width: 100%; justify-content: center; }
            .nav-actions { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <nav class="simple-nav" role="navigation" aria-label="Main navigation">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('assets/rudraxpay.png') }}" alt="RudraxPay" decoding="async" onerror="this.onerror=null;this.src='{{ asset('assets/logo_bg.png') }}'" />
                <div class="brand-text">
                    <span>RudraxPay</span>
                    <small>AEPS Platform</small>
                </div>
            </a>
            <button class="nav-toggle" id="navToggleSimple" aria-label="Toggle navigation" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links" id="navLinksSimple">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('services') }}">Services</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('features') }}">Features</a>
                <a href="{{ route('team') }}">Team</a>
                <a href="{{ route('home') }}#contact">Contact</a>
            </div>
            <div class="nav-actions">
                @auth
                    <a href="{{ match(auth()->user()->role) { 'admin' => route('admin.dashboard'), 'distributor' => route('distributor.dashboard'), default => route('retailer.dashboard') } }}" class="btn btn-outline"><i class="fas fa-lock"></i> Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline"><i class="fas fa-lock"></i> Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary"><i class="fas fa-user"></i> Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="simple-main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="simple-footer">
        <div class="container footer-grid">
            <div>
                <div class="footer-title">RudraxPay</div>
                <p style="color:#94a3b8;font-size:14px;line-height:1.7;">We partner with neighborhood retail stores to offer assisted digital financial services like AEPS, bill payments, money transfer, travel, and insurance.</p>
            </div>
            <div>
                <div class="footer-title">Services</div>
                <ul class="footer-list">
                    <li>AEPS Cash Withdrawal</li>
                    <li>Mini Statement</li>
                    <li>Money Transfer</li>
                    <li>Bill Payments</li>
                    <li>Insurance</li>
                </ul>
            </div>
            <div>
                <div class="footer-title">Quick Links</div>
                <ul class="footer-list">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('features') }}">Features</a></li>
                    <li><a href="{{ route('home') }}#contact">Contact</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-title">Connect</div>
                <ul class="footer-list">
                    <li>Ward No.06, Kunda, Partapur, Meerut</li>
                    <li>+91 96343 50509</li>
                    <li>+91 80771 13239</li>
                    <li>info@mudramarvel.in</li>
                </ul>
            </div>
        </div>
        <div class="container footer-bottom">
            <div>Copyright 2025, Powered by Mudramarvel Pvt Ltd</div>
            <div>Working Hours: Monday-Saturday, 9am-5pm</div>
        </div>
    </footer>

    <script>
        (function(){
            const toggle = document.getElementById('navToggleSimple');
            const links = document.getElementById('navLinksSimple');
            if (toggle && links) {
                toggle.addEventListener('click', () => {
                    const open = links.classList.toggle('open');
                    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                });
            }
        })();
    </script>
</body>
</html>
