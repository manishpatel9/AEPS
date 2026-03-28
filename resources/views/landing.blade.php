<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RudraxPay AEPS - Secure & Profitable Aadhaar Enabled Payment Solutions</title>
    <meta name="description" content="Grow your business with RudraxPay AEPS services. Secure onboarding, fast settlements, and reliable support.">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --font-sans: 'Space Grotesk', sans-serif;
            --font-display: 'Fraunces', serif;
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
            --nav-ink: #13085d; /* darker blue-teal for header/nav text */
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

        .skip-link {
            position: absolute; left: -9999px; top: auto; width: 1px; height: 1px; overflow: hidden;
        }
        .skip-link:focus {
            left: 16px; top: 16px; width: auto; height: auto; padding: 10px 14px;
            background: var(--surface); color: var(--ink); border-radius: 8px; z-index: 9999; box-shadow: var(--shadow);
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0 12px; /* small left/right gap for breathing room */
            position: relative;
            z-index: 1;
        }

        .site-nav {
            position: sticky;
            top: 0;
            z-index: 200;
            background: linear-gradient(180deg, rgba(118, 189, 228, 0.9), rgba(231, 230, 156, 0.7));
            /* subtle bluish tint and slightly transparent for light-weight look */
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(14,165,164,0.08);
            box-shadow: 0 6px 16px rgba(14,165,164,0.06);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 14px 24px;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            color: var(--nav-ink);
        }
        .brand img { height: 52px; width: auto; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.1; }
        .brand-text span { font-family: var(--font-display); font-size: 18px; }
        .brand-text small { font-size: 12px; color: var(--muted); font-weight: 600; }

        .nav-links {
            display: flex;
            gap: 24px;
            align-items: center;
            font-weight: 600;
            color: var(--nav-ink);
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
        .btn-ghost {
            background: transparent;
            border: 1px solid rgba(14,165,164,0.35);
            color: var(--primary-dark);
        }

        .hero {
            padding: 80px 0 40px;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 40px;
            align-items: center;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.6px;
            color: var(--primary-dark);
            background: rgba(14,165,164,0.12);
            padding: 8px 14px;
            border-radius: 999px;
            margin-bottom: 18px;
        }
        .hero h1 {
            font-family: var(--font-display);
            font-size: clamp(38px, 4vw, 60px);
            line-height: 1.05;
            margin-bottom: 18px;
            color: var(--ink);
        }
        .hero h1 span { color: var(--primary-dark); }
        .hero p {
            font-size: 18px;
            color: var(--muted);
            margin-bottom: 26px;
        }
        .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; align-items: center; }
        .hero-note { font-size: 12px; color: var(--muted); margin-top: 12px; }

        .hero-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 14px;
            margin-top: 26px;
        }
        .metric-card {
            background: var(--surface);
            border: 1px solid var(--stroke);
            border-radius: 14px;
            padding: 16px;
            box-shadow: var(--shadow);
        }
        .metric-card strong { font-size: 20px; display: block; }
        .metric-card span { font-size: 12px; color: var(--muted); }

        .hero-visual {
            position: relative;
            display: grid;
            place-items: center;
        }
        .visual-frame {
            width: 100%;
            background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(240,244,248,0.9));
            border-radius: 24px;
            padding: 16px;
            box-shadow: var(--shadow-strong);
            border: 1px solid var(--stroke);
        }
        .hero-slider {
            position: relative;
            width: 100%;
            height: 420px;
            border-radius: 18px;
            overflow: hidden;
            background: #0b1b2b;
        }
        .hero-slider .slides { display: flex; height: 100%; transition: transform 0.6s ease; }
        .hero-slider .slides img { width: 100%; height: 100%; object-fit: cover; flex-shrink: 0; }
        .hero-slider .nav-btn {
            position: absolute; top: 50%; transform: translateY(-50%);
            background: rgba(0,0,0,0.45); color: white; border: none;
            width: 42px; height: 42px; border-radius: 50%; cursor: pointer;
        }
        .hero-slider .prev { left: 12px; }
        .hero-slider .next { right: 12px; }
        .hero-slider .dots {
            position: absolute; left: 50%; transform: translateX(-50%); bottom: 12px; display:flex; gap:8px;
        }
        .hero-slider .dot { width:10px;height:10px;border-radius:50%;background:rgba(255,255,255,0.5);cursor:pointer; }
        .hero-slider .dot.active { background: #0ea5a4; box-shadow: 0 4px 12px rgba(14,165,164,0.4); }

        .floating-badge {
            position: absolute; right: -12px; bottom: -18px;
            background: var(--surface);
            border-radius: 16px;
            padding: 14px 16px;
            border: 1px solid var(--stroke);
            box-shadow: var(--shadow);
            font-weight: 700;
            color: var(--ink-2);
        }


        section.section { padding: 70px 0; }
        .section-head {
            display: flex; align-items: end; justify-content: space-between; gap: 20px; flex-wrap: wrap;
            margin-bottom: 30px;
        }
        .section-head h2 {
            font-family: var(--font-display);
            font-size: clamp(28px, 3vw, 40px);
        }
        .section-head p { color: var(--muted); max-width: 560px; }

        .trusted {
            padding: 30px 0 10px;
        }
        .trusted .trusted-logos {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(140px,1fr)); gap: 14px; align-items: center;
            background: var(--surface);
            border: 1px solid var(--stroke);
            padding: 18px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        .trusted-logo {
            display: flex; align-items: center; justify-content: center; gap: 8px; padding: 10px;
            border-radius: 12px; background: var(--surface-2);
        }

        .service-grid,
        .feature-grid,
        .steps-grid,
        .testimonials-grid {
            display: grid; gap: 18px;
        }
        .service-grid { grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); }
        .feature-grid { grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); }
        .steps-grid { grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); }
        .testimonials-grid { grid-template-columns: repeat(auto-fit, minmax(260px,1fr)); }

        .card {
            background: var(--surface);
            border: 1px solid var(--stroke);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
        }
        .service-card {
            display: flex; flex-direction: column; gap: 14px; align-items: flex-start;
        }
        .service-card .icon {
            width: 44px; height: 44px; border-radius: 14px;
            display: grid; place-items: center;
            background: rgba(14,165,164,0.12); color: var(--primary-dark);
        }
        .service-card h3 { font-size: 16px; }
        .service-card p { color: var(--muted); font-size: 14px; }

        .feature-card { display: grid; gap: 10px; }
        .feature-card strong { font-size: 16px; }
        .feature-card span { color: var(--muted); font-size: 14px; }

        .steps-card img { border-radius: 14px; margin-bottom: 12px; }
        .steps-card h3 { font-size: 16px; margin-bottom: 6px; }
        .steps-card p { color: var(--muted); font-size: 14px; }

        .about-grid {
            display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 26px; align-items: center;
        }
        .about-card {
            background: linear-gradient(135deg, rgba(14,165,164,0.12), rgba(37,99,235,0.12));
            border-radius: var(--radius);
            padding: 24px;
            border: 1px solid rgba(14,165,164,0.18);
        }
        .about-card ul { list-style: none; display: grid; gap: 10px; margin-top: 16px; }
        .about-card li { display: flex; gap: 10px; align-items: center; color: var(--ink-2); }
        .about-card i { color: var(--primary-dark); }

        .testimonial-card { display: grid; gap: 12px; }
        .testimonial-header { display: flex; gap: 12px; align-items: center; }
        .testimonial-avatar { width: 46px; height: 46px; border-radius: 50%; object-fit: cover; }
        .testimonial-name { font-weight: 700; }
        .testimonial-sub { font-size: 12px; color: var(--muted); }
        .testimonial-quote { color: var(--ink-2); font-size: 14px; line-height: 1.6; }

        .contact-grid {
            display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 28px; align-items: stretch;
        }
        .contact-card {
            background: var(--surface);
            border: 1px solid var(--stroke);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
        }
        .contact-card h3 { font-size: 22px; margin-bottom: 10px; }
        .contact-card p { color: var(--muted); }
        .contact-form {
            background: linear-gradient(135deg, rgba(14,165,164,0.15), rgba(37,99,235,0.12));
            border: 1px solid rgba(14,165,164,0.2);
        }
        .form-control {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid var(--stroke);
            font-size: 14px;
            font-family: var(--font-sans);
        }
        .form-control:focus { outline: none; border-color: rgba(14,165,164,0.5); box-shadow: 0 0 0 3px rgba(14,165,164,0.15); }
        .form-stack { display: grid; gap: 12px; }

        .team-card {
            text-align: center; padding: 24px; background: var(--surface); border-radius: var(--radius);
            border: 1px solid var(--stroke); box-shadow: var(--shadow);
        }

        .site-footer {
            margin-top: 60px;
            padding: 60px 0 30px;
            background: linear-gradient(180deg,#0b1b2b 0%, #07111f 100%);
            color: #cbd5e1;
        }
        .footer-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap: 26px;
        }
        .footer-title { font-weight: 700; margin-bottom: 10px; color: #f8fafc; }
        .footer-list { list-style: none; display: grid; gap: 8px; font-size: 14px; }
        .footer-bottom { margin-top: 28px; padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.08); font-size: 13px; color: #94a3b8; display:flex; justify-content:space-between; flex-wrap: wrap; gap: 12px; }

        .reveal { opacity: 0; transform: translateY(14px); transition: transform .6s cubic-bezier(.2,.9,.2,1), opacity .6s ease; }
        .reveal.in-view { opacity: 1; transform: translateY(0); }

        /* Content wrapper: keep backgrounds full-bleed but center readable content */
        .section > .container > * {
            max-width: 1220px; margin: 0 auto; padding: 0 28px; box-sizing: border-box;
        }

        /* Hero refinements */
        .hero { padding: 84px 0 48px; }
        .hero-copy { padding-right: 20px; }
        .hero h1 { font-size: clamp(36px, 5.4vw, 64px); letter-spacing: -0.02em; }
        .hero p { font-size: 18px; max-width: 64ch; }

        /* Card system: human-crafted, unique look */
        .card.interactive { position: relative; overflow: visible; border-radius: 16px; }
        .card.interactive .card-inner { position: relative; z-index: 2; }
        .card.interactive::after { content: ''; position: absolute; right: 18px; top: 18px; width: 56px; height: 56px; border-radius: 12px; background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); box-shadow: 0 8px 20px rgba(2,8,23,0.04); pointer-events: none; transform: rotate(12deg); opacity: 0.6; }
        .card.interactive:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 32px 90px rgba(11,27,43,0.12); }
        .card.interactive:focus-within { outline: 3px solid rgba(14,165,164,0.14); }

        /* Service card gradients (distinctive) */
        .service-grid .service-card:nth-child(1) { background: linear-gradient(135deg,#eff6ff, #dbeafe); border: none; }
        .service-grid .service-card:nth-child(2) { background: linear-gradient(135deg,#fff7ed,#ffedd5); }
        .service-grid .service-card:nth-child(3) { background: linear-gradient(135deg,#ecfeff,#cffafe); }
        .service-grid .service-card:nth-child(4) { background: linear-gradient(135deg,#fdf2f8,#fce7f3); }
        .service-grid .service-card:nth-child(5) { background: linear-gradient(135deg,#f0f9ff,#e0f2fe); }
        .service-grid .service-card:nth-child(6) { background: linear-gradient(135deg,#f7fee7,#ecfccb); }
        .service-grid .service-card:nth-child(7) { background: linear-gradient(135deg,#fff1f2,#ffe4e6); }
        .service-grid .service-card:nth-child(8) { background: linear-gradient(135deg,#f8fafc,#eef2ff); }
        .service-grid .service-card { border-radius: 14px; padding: 22px; transition: transform .36s cubic-bezier(.2,.9,.2,1), box-shadow .36s ease; }
        .service-card .icon { width:56px; height:56px; border-radius:12px; display:grid;place-items:center; font-size:20px; box-shadow: 0 8px 24px rgba(2,8,23,0.06); }

        .feature-grid .feature-card.interactive { padding: 20px 22px; }
        .steps-grid .steps-card.interactive img { border-radius: 12px; box-shadow: 0 16px 40px rgba(2,8,23,0.06); }

        /* Testimonials: portrait + quote emphasis */
        .testimonial-card.interactive { padding: 20px 22px; display:flex; flex-direction:column; gap:14px; }
        .testimonial-quote { font-style: italic; color: var(--ink-2); }

        /* Metrics: badge-like, compact */
        .metric-card.interactive { display:flex; gap:12px; align-items:center; padding:14px 18px; border-radius:12px; }

        /* Contact card: accent gradient and callout */
        .contact-card.contact-form.interactive { background: linear-gradient(135deg, rgba(14,165,164,0.06), rgba(37,99,235,0.04)); padding: 22px; }

        /* accessible focus and reduces */
        .card.interactive:focus { outline: none; }
        .card.interactive:focus-visible { outline: 3px solid rgba(37,99,235,0.12); border-radius:12px; }

        @keyframes floatSubtle { 0% { transform: translateY(0); } 50% { transform: translateY(-6px); } 100% { transform: translateY(0); } }
        .hero .metric-card { animation: floatSubtle 6s ease-in-out infinite; }

        /* Entro (entrance) animation for interactive elements */
        @keyframes entro {
            0% { opacity: 0; transform: translateY(18px) scale(0.995) rotateX(4deg); filter: blur(6px); }
            60% { opacity: 1; transform: translateY(-6px) scale(1.01) rotateX(0deg); filter: blur(0); }
            100% { opacity: 1; transform: translateY(0) scale(1) rotateX(0deg); filter: blur(0); }
        }

        .interactive.in-view { animation: entro 720ms cubic-bezier(.2,.9,.2,1) var(--card-delay,0ms) both; }

        /* stronger hover accent and glare */
        .card.interactive:hover { box-shadow: 0 40px 120px rgba(11,27,43,0.14); transform: translateY(-12px) scale(1.028); }
        .card.interactive:hover::after { opacity: 0.9; transform: rotate(8deg) translateY(-2px); }
        .service-card .icon { transition: transform .28s cubic-bezier(.2,.9,.2,1), box-shadow .28s ease, background .28s ease; }
        .service-card:hover .icon { transform: translateY(-8px) scale(1.08); box-shadow: 0 16px 44px rgba(14,165,164,0.16); }


        @media (max-width: 980px) {
            .service-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
            .hero-grid { grid-template-columns: 1fr; }
            .hero-visual { order: 2; }
        }

        @media (prefers-reduced-motion: reduce) {
            .card.interactive, .hero .metric-card { animation: none !important; transition: none !important; }
            .reveal { transition: none !important; transform: none !important; opacity: 1 !important; }
        }

        /* Interactive, handcrafted card treatments */
        .card.interactive { transition: transform .36s cubic-bezier(.2,.9,.2,1), box-shadow .36s ease, filter .36s ease; will-change: transform, box-shadow; cursor: pointer; position: relative; overflow: visible; }
        .card.interactive::after { content: ''; position: absolute; right: 18px; top: 18px; width: 56px; height: 56px; border-radius: 12px; background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)); box-shadow: 0 8px 20px rgba(2,8,23,0.04); pointer-events: none; transform: rotate(12deg); opacity: 0.6; }
        .card.interactive:hover { transform: translateY(-8px) rotate(-0.2deg) scale(1.02); box-shadow: 0 28px 80px rgba(11,27,43,0.12); }

        .service-card .icon { transition: transform .36s cubic-bezier(.2,.9,.2,1), box-shadow .36s ease; }
        .service-card:hover .icon { transform: translateY(-6px) scale(1.04); box-shadow: 0 12px 30px rgba(14,165,164,0.12); }

        .feature-card.interactive, .steps-card.interactive, .testimonial-card.interactive, .metric-card.interactive, .contact-card.interactive { --card-delay: 0ms; transition-delay: var(--card-delay); }

        /* subtle accent ribbon for feature cards */
        .feature-card.interactive::before { content: ''; position: absolute; left: -12px; top: 18px; width: 6px; height: calc(100% - 36px); background: linear-gradient(180deg,#60a5fa,#7c3aed); border-radius: 6px; opacity: 0.95; }

        /* small scale tilt helpers (JS applied) */
        .tilt-enabled { transform-style: preserve-3d; will-change: transform; }

        /* humanized stagger timing - JS will set --card-delay per item */

        @media (prefers-reduced-motion: reduce) {
            .card.interactive, .service-card .icon { transition: none !important; animation: none !important; }
            .reveal { transition: none !important; transform: none !important; opacity: 1 !important; }
        }

        @media (max-width: 980px) {
            .hero-grid, .about-grid, .contact-grid { grid-template-columns: 1fr; }
            .hero { padding-top: 50px; }
            .hero-visual { order: 2; }
            .hero-copy { order: 1; }
        }
        @media (max-width: 860px) {
            .nav-links { display: none; position: absolute; top: 68px; left: 20px; right: 20px; flex-direction: column; background: var(--surface); border: 1px solid var(--stroke); padding: 14px; border-radius: 16px; box-shadow: var(--shadow); }
            .nav-links.open { display: flex; }
            .nav-toggle { display: inline-flex; }
        }
        @media (max-width: 640px) {
            .hero-slider { height: 280px; }
            .hero-metrics { grid-template-columns: 1fr; }
            .btn { width: 100%; justify-content: center; }
            .nav-actions { flex-direction: column; align-items: stretch; }
        }

        .modal-overlay{position:fixed;inset:0;background:linear-gradient(180deg,rgba(2,6,23,0.55),rgba(2,6,23,0.75));display:none;align-items:center;justify-content:center;z-index:1200;padding:28px}
        .modal-box{background:linear-gradient(180deg,#ffffff,#f7fffe);color:#073040;border-radius:14px;max-width:680px;width:100%;padding:26px 28px;box-shadow:0 30px 90px rgba(2,16,31,0.65);text-align:center;position:relative;overflow:hidden}
        .modal-brand{position:absolute;right:18px;top:18px;opacity:0.08;font-weight:900;font-size:36px;color:#0ea5a4}
        .modal-check{width:90px;height:90px;margin:0 auto 12px;display:grid;place-items:center}
        .check-circle{width:90px;height:90px;border-radius:50%;display:inline-grid;place-items:center;background:linear-gradient(180deg,#0ea5a4,#2563eb);box-shadow:0 10px 30px rgba(14,165,164,0.24);}
        .check-svg{width:52px;height:52px;stroke:#fff;stroke-width:6;fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:120;stroke-dashoffset:120;animation:draw 420ms ease forwards 220ms}
        @keyframes draw{to{stroke-dashoffset:0}}
        .modal-title{font-size:22px;font-weight:900;margin-bottom:6px;color:#073040}
        .modal-body{color:#0b5460;margin-bottom:18px;font-size:16px}
        .modal-actions{display:flex;justify-content:center;gap:12px;flex-wrap:wrap}
        .btn-modal-primary{background:linear-gradient(90deg,#0ea5a4,#2563eb);color:#fff;border:0;padding:12px 20px;border-radius:10px;font-weight:800;box-shadow:0 10px 30px rgba(14,165,164,0.18);cursor:pointer}
        .btn-modal-secondary{background:transparent;border:2px solid rgba(7,48,64,0.08);padding:10px 16px;border-radius:10px;color:#073040;cursor:pointer}
        .close-x{position:absolute;top:10px;right:12px;background:transparent;border:0;color:rgba(7,48,64,0.45);font-size:20px;padding:8px;cursor:pointer}
    </style>
</head>
<body>
    <a href="#maincontent" class="skip-link">Skip to content</a>

    <nav class="site-nav" role="navigation" aria-label="Main navigation">
        <div class="container nav-inner">
            <a href="/" class="brand" aria-label="Home">
                <img src="{{ asset('assets/logo.jpeg') }}" alt="RudraxPay" onerror="this.style.display='none'" />
            </a>
            <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links" id="navLinks">
                <a href="#maincontent">Home</a>
                <a href="#services">Services</a>
                <a href="#about">About</a>
                <a href="#features">Features</a>
                <a href="#team">Team</a>
                <a href="#contact">Contact</a>
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

    <main id="maincontent">
        <section class="hero">
            <div class="container hero-grid">
                <div class="hero-copy reveal">
                    <span class="eyebrow"><i class="fas fa-shield-alt"></i> Secure AEPS Platform</span>
                    <h1>Grow your retail income with <span>RudraxPay AEPS</span> and assisted financial services.</h1>
                    <p>Fast onboarding, biometric withdrawals, mini statements, bill payments, and real-time support built for daily retail operations.</p>
                    <div class="hero-actions">
                        <a href="{{ route('register') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Get Started</a>
                        <a href="{{ route('login') }}" class="btn btn-ghost"><i class="fas fa-lock"></i> Retailer Login</a>
                    </div>
                    <div class="hero-note">No credit card required. Approval in 24 to 48 hours.</div>

                    <div class="hero-metrics">
                        <div class="metric-card">
                            <strong>99.9%</strong>
                            <span>Uptime for transactions</span>
                        </div>
                        <div class="metric-card">
                            <strong>2 mins</strong>
                            <span>Typical settlement time</span>
                        </div>
                        <div class="metric-card">
                            <strong>10k+</strong>
                            <span>Retailers onboarded</span>
                        </div>
                    </div>
                </div>

                <div class="hero-visual reveal">
                    <div class="visual-frame">
                        <div class="hero-slider" id="heroSlider" tabindex="0" aria-roledescription="carousel" aria-label="Promotional slides">
                            <div class="slides">
                                <img src="{{ asset('assets/slide1.png') }}" alt="slide1">
                                <img src="{{ asset('assets/slide2.png') }}" alt="slide2">
                                <img src="{{ asset('assets/slide3.png') }}" alt="slide3">
                                <img src="{{ asset('assets/slide4.png') }}" alt="slide4">
                            </div>
                            <button class="nav-btn prev" id="sliderPrev" aria-label="Previous slide">&#8249;</button>
                            <button class="nav-btn next" id="sliderNext" aria-label="Next slide">&#8250;</button>
                            <div class="dots" id="sliderDots">
                                <div class="dot" data-index="0"></div>
                                <div class="dot" data-index="1"></div>
                                <div class="dot" data-index="2"></div>
                                <div class="dot" data-index="3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="floating-badge"><i class="fas fa-check-circle" style="color:#0ea5a4"></i> Verified AEPS Network</div>
                </div>
            </div>
        </section>

        <section class="trusted">
            <div class="container">
                <div class="trusted-logos">
                    <div class="trusted-logo"><img src="{{ asset('assets/logo2.png') }}" alt="Bank Partner" onerror="this.style.display='none'"></div>
                    <div class="trusted-logo"><img src="{{ asset('assets/logo3.png') }}" alt="Payment Gateway" onerror="this.style.display='none'"></div>
                    <div class="trusted-logo"><img src="{{ asset('assets/logo.jpeg') }}" alt="Top Aggregator" onerror="this.style.display='none'"></div>
                    <div class="trusted-logo"><img src="{{ asset('assets/slide1.png') }}" alt="Retailers" onerror="this.style.display='none'"></div>
                </div>
            </div>
        </section>

        <section id="services" class="section">
            <div class="container">
                <div class="section-head">
                    <h2>Services that keep your store profitable</h2>
                    <p>Offer daily financial services with a single platform. AEPS, transfers, bill payments, and more backed by support and compliance.</p>
                </div>
                <div class="service-grid">
                    <a href="{{ route('login') }}" class="card service-card">
                        <div class="icon"><i class="fas fa-fingerprint"></i></div>
                        <h3>AEPS Withdrawals</h3>
                        <p>Biometric cash withdrawals with instant confirmation.</p>
                    </a>
                    <a href="{{ route('login') }}" class="card service-card">
                        <div class="icon"><i class="fas fa-file-invoice"></i></div>
                        <h3>Mini Statement</h3>
                        <p>Provide account mini statements in seconds.</p>
                    </a>
                    <a href="{{ route('login') }}" class="card service-card">
                        <div class="icon"><i class="fas fa-money-bill-wave"></i></div>
                        <h3>Money Transfer</h3>
                        <p>Secure domestic money transfer services.</p>
                    </a>
                    <a href="{{ route('login') }}" class="card service-card">
                        <div class="icon"><i class="fas fa-credit-card"></i></div>
                        <h3>Bill Payments</h3>
                        <p>Utility, DTH, and recharge collections.</p>
                    </a>
                    <a href="{{ route('login') }}" class="card service-card">
                        <div class="icon"><i class="fas fa-laptop"></i></div>
                        <h3>Micro ATM</h3>
                        <p>Enable card-based withdrawals and receipts.</p>
                    </a>
                    <a href="{{ route('login') }}" class="card service-card">
                        <div class="icon"><i class="fas fa-shield-alt"></i></div>
                        <h3>Insurance</h3>
                        <p>Assist customers with affordable plans.</p>
                    </a>
                    <a href="{{ route('login') }}" class="card service-card">
                        <div class="icon"><i class="fas fa-building"></i></div>
                        <h3>Bank CSP</h3>
                        <p>Customer service point banking support.</p>
                    </a>
                    <a href="{{ route('login') }}" class="card service-card">
                        <div class="icon"><i class="fas fa-plane"></i></div>
                        <h3>Travel Services</h3>
                        <p>IRCTC, ticketing, and travel assistance.</p>
                    </a>
                </div>
            </div>
        </section>

        <section id="about" class="section">
            <div class="container about-grid">
                <div class="reveal">
                    <div class="section-head">
                        <h2>Built for local retailers and distributors</h2>
                        <p>RudraxPay partners with neighborhood stores to deliver assisted digital financial services with reliable onboarding and support.</p>
                    </div>
                    <div class="about-card">
                        <strong>Why retailers choose us</strong>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Fast KYC and activation</li>
                            <li><i class="fas fa-check-circle"></i> Low downtime and quick settlements</li>
                            <li><i class="fas fa-check-circle"></i> Dedicated relationship support</li>
                        </ul>
                    </div>
                </div>
                <div class="card reveal">
                    <h3 style="margin-bottom:12px;">Performance you can trust</h3>
                    <p style="color:var(--muted);">We combine compliant processes with an efficient platform to help you serve more customers every day. From cash withdrawals to bill collections, everything is designed for speed, security, and ease of use.</p>
                    <div style="display:grid;gap:10px;margin-top:14px;">
                        <div style="display:flex;gap:10px;align-items:center;"><i class="fas fa-bolt" style="color:#0ea5a4"></i> Real-time transaction updates</div>
                        <div style="display:flex;gap:10px;align-items:center;"><i class="fas fa-headset" style="color:#2563eb"></i> Support team with rapid escalation</div>
                        <div style="display:flex;gap:10px;align-items:center;"><i class="fas fa-lock" style="color:#f59e0b"></i> Secure device and API controls</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="section">
            <div class="container">
                <div class="section-head">
                    <h2>Platform features built for daily growth</h2>
                    <p>Every feature is designed to help you serve more customers in less time while keeping compliance in check.</p>
                </div>
                <div class="feature-grid">
                    <div class="card feature-card">
                        <strong>Unified dashboard</strong>
                        <span>Track settlements, commissions, and transaction health from one place.</span>
                    </div>
                    <div class="card feature-card">
                        <strong>Role-based access</strong>
                        <span>Admin, distributor, and retailer experiences are tailored to responsibilities.</span>
                    </div>
                    <div class="card feature-card">
                        <strong>Risk monitoring</strong>
                        <span>Automated flags and audit logs keep your operations compliant.</span>
                    </div>
                    <div class="card feature-card">
                        <strong>Fast onboarding</strong>
                        <span>Digital KYC flow and document tracking for quick approvals.</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-head">
                    <h2>Start earning in three steps</h2>
                    <p>Get your retailer ID, activate AEPS, and begin serving customers right away.</p>
                </div>
                <div class="steps-grid">
                    <div class="card steps-card">
                        <img src="{{ asset('assets/step1.png') }}" alt="Sign up" onerror="this.src='{{ asset('assets/slide2.png') }}'">
                        <h3>Register and verify</h3>
                        <p>Submit details and KYC to receive your retailer ID.</p>
                    </div>
                    <div class="card steps-card">
                        <img src="{{ asset('assets/step2.png') }}" alt="Activate" onerror="this.src='{{ asset('assets/slide3.png') }}'">
                        <h3>Activate AEPS</h3>
                        <p>Connect your device and activate services with our support team.</p>
                    </div>
                    <div class="card steps-card">
                        <img src="{{ asset('assets/step3.png') }}" alt="Earn" onerror="this.src='{{ asset('assets/slide4.png') }}'">
                        <h3>Earn daily commissions</h3>
                        <p>Serve customers and track earnings in real time.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-head">
                    <h2>What our partners say</h2>
                    <p>Retailers trust RudraxPay to keep transactions smooth and customers happy.</p>
                </div>
                <div class="testimonials-grid">
                    @foreach($testimonials as $t)
                        <div class="card testimonial-card">
                            <div class="testimonial-header">
                                <img src="{{ $t['image'] }}" alt="{{ $t['name'] }}" class="testimonial-avatar" onerror="this.src='{{ asset('assets/logo.jpeg') }}'">
                                <div>
                                    <div class="testimonial-name">{{ $t['name'] }}</div>
                                    <div class="testimonial-sub">{{ $t['sub'] }}</div>
                                </div>
                            </div>
                            <div class="testimonial-quote">"{{ $t['quote'] }}"</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="contact" class="section">
            <div class="container contact-grid">
                <div class="contact-card reveal">
                    <h3>Talk to our onboarding team</h3>
                    <p>Share your details and we will contact you with the next steps, pricing, and device guidance.</p>
                    <div style="margin-top:18px; display:grid; gap:12px;">
                        <div><i class="fas fa-phone" style="color:#0ea5a4"></i> +91 96343 50509</div>
                        <div><i class="fas fa-envelope" style="color:#2563eb"></i> info@mudramarvel.in</div>
                        <div><i class="fas fa-map-marker-alt" style="color:#f59e0b"></i> Ward No.06, Kunda, Partapur, Meerut, Uttar Pradesh</div>
                    </div>
                </div>
                <div class="contact-card contact-form reveal">
                    @if(session('status'))
                        <script>window.contactStatus = {!! json_encode(session('status')) !!};</script>
                    @endif
                    <h3>Fill the form to get started</h3>
                    <form id="contactForm" method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="form-stack">
                            <input name="name" type="text" class="form-control" placeholder="Full Name" required>
                            <input name="phone" type="tel" class="form-control" placeholder="Phone Number" required>
                            <input name="email" type="email" class="form-control" placeholder="Email Address" required>
                            <select name="role" class="form-control" aria-label="Role">
                                <option value="retailer">Retailer</option>
                                <option value="distributor">Distributor</option>
                                <option value="other">Other</option>
                            </select>
                            <textarea name="message" class="form-control" rows="6" placeholder="Message (Optional)"></textarea>
                            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Enquire Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section id="team" class="section">
            <div class="container">
                <div class="team-card">
                    <h2 style="font-family:var(--font-display);">Meet the Team</h2>
                    <p style="color:var(--muted);margin:10px 0 16px;">A focused team across operations, engineering, and partnerships committed to merchant success.</p>
                    <a href="{{ route('team') }}" class="btn btn-outline">Read more</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <img src="{{ asset('assets/logo.jpeg') }}" alt="RudraxPay" style="height:48px;margin-bottom:10px;display:block" onerror="this.style.display='none'">
                <div class="footer-title">RudraxPay</div>
                <p style="color:#94a3b8;font-size:14px;line-height:1.7;">We operate on a B2B2C model, partnering with neighborhood retail stores to offer assisted digital financial services like AEPS, bill payments, money transfer, travel, and insurance.</p>
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
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#contact">Contact</a></li>
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

    <div id="contactSuccessModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="contactSuccessTitle" aria-hidden="true">
        <div class="modal-box" role="document">
            <button class="close-x" id="contactModalX" aria-label="Close dialog">x</button>
            <div class="modal-brand">OK</div>
            <div class="modal-check" aria-hidden="true">
                <div class="check-circle">
                    <svg class="check-svg" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
                        <path d="M14 27l6 6 18-18" />
                    </svg>
                </div>
            </div>
            <div id="contactSuccessTitle" class="modal-title">Thanks - request received</div>
            <div id="contactSuccessMessage" class="modal-body">We will contact you shortly.</div>
            <div class="modal-actions">
                <button id="contactModalOk" class="btn-modal-primary">Got it</button>
                <button id="contactModalClose" class="btn-modal-secondary">Close</button>
            </div>
        </div>
    </div>

    <script>
        (function(){
            const toggle = document.getElementById('navToggle');
            const links = document.getElementById('navLinks');
            if (toggle && links) {
                toggle.addEventListener('click', () => {
                    const open = links.classList.toggle('open');
                    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                });
            }
        })();
    </script>
    <script>
        (function(){
            const slider = document.getElementById('heroSlider');
            if(!slider) return;
            const slides = slider.querySelector('.slides');
            const imgs = slides.querySelectorAll('img');
            const total = imgs.length;
            const dotsContainer = document.getElementById('sliderDots');
            const dots = dotsContainer ? Array.from(dotsContainer.querySelectorAll('.dot')) : [];
            const nextBtn = document.getElementById('sliderNext');
            const prevBtn = document.getElementById('sliderPrev');
            let idx = 0;
            function update() {
                slides.style.transform = `translateX(${-idx * 100}%)`;
                dots.forEach(d=>d.classList.remove('active'));
                if(dots[idx]) dots[idx].classList.add('active');
            }
            if(nextBtn) nextBtn.addEventListener('click', ()=>{ idx = (idx+1)%total; update(); resetAuto(); });
            if(prevBtn) prevBtn.addEventListener('click', ()=>{ idx = (idx-1+total)%total; update(); resetAuto(); });
            dots.forEach(d=> d.addEventListener('click', (e)=>{ idx = Number(e.target.dataset.index) || 0; update(); resetAuto(); }));
            update();
            let auto = setInterval(()=>{ idx = (idx+1)%total; update(); }, 4500);
            function resetAuto(){ clearInterval(auto); auto = setInterval(()=>{ idx = (idx+1)%total; update(); }, 4500); }
        })();
    </script>
    <script>
        (function(){
            const revealEls = Array.from(document.querySelectorAll('.reveal'));
            if(!('IntersectionObserver' in window)) {
                revealEls.forEach(el => el.classList.add('in-view'));
                return;
            }
            const observer = new IntersectionObserver((entries)=>{
                entries.forEach(entry=>{
                    if(entry.isIntersecting){
                        entry.target.classList.add('in-view');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });
            revealEls.forEach(el => observer.observe(el));
        })();
    </script>
    <script>
        // Staggered reveal and lightweight tilt for interactive cards
        (function(){
            const groups = ['.service-grid', '.feature-grid', '.steps-grid', '.testimonials-grid', '.hero-metrics', '.contact-grid'];
            groups.forEach(sel => {
                const container = document.querySelector(sel);
                if(!container) return;
                const items = Array.from(container.children).filter(Boolean);
                items.forEach((it, i) => {
                    it.classList.add('interactive');
                    // humanized stagger with slight randomness
                    const base = Math.max(60, Math.round(80 * Math.log(i+2)));
                    const delay = base + Math.round(Math.random()*40);
                    it.style.setProperty('--card-delay', delay + 'ms');
                    it.style.transitionDelay = delay + 'ms';
                    // enable tilt on desktop-like pointers
                    if(window.matchMedia && window.matchMedia('(pointer: fine)').matches){
                        it.classList.add('tilt-enabled');
                    }
                });
                // Observe items for entrance if IntersectionObserver available
                if('IntersectionObserver' in window){
                    const io = new IntersectionObserver((entries, ob) => {
                        entries.forEach(en => {
                            if(en.isIntersecting){ en.target.classList.add('in-view'); ob.unobserve(en.target); }
                        });
                    }, { threshold: 0.12 });
                    items.forEach(it=> io.observe(it));
                } else {
                    items.forEach(it=> it.classList.add('in-view'));
                }
            });

            // lightweight tilt effect
            const tiltEls = Array.from(document.querySelectorAll('.tilt-enabled'));
            tiltEls.forEach(el => {
                let raf = null, lastX = 0, lastY = 0;
                function handleMove(e){
                    const r = el.getBoundingClientRect();
                    const cx = r.left + r.width/2; const cy = r.top + r.height/2;
                    const dx = (e.clientX - cx) / (r.width/2); const dy = (e.clientY - cy) / (r.height/2);
                    const rx = (-dy * 4); const ry = (dx * 4);
                    // smooth the movement
                    lastX = lastX + (ry - lastX) * 0.18;
                    lastY = lastY + (rx - lastY) * 0.18;
                    if(raf) cancelAnimationFrame(raf);
                    raf = requestAnimationFrame(()=> el.style.transform = `perspective(900px) rotateX(${lastY.toFixed(2)}deg) rotateY(${lastX.toFixed(2)}deg) translateZ(6px)`);
                }
                function reset(){ if(raf) cancelAnimationFrame(raf); el.style.transform = ''; }
                el.addEventListener('mousemove', handleMove);
                el.addEventListener('mouseleave', reset);
                // touch: disable tilt interactions on first touch
                el.addEventListener('touchstart', ()=> el.classList.remove('tilt-enabled'), {passive:true});
            });
        })();
    </script>
    <script>
        (function(){
            const modal = document.getElementById('contactSuccessModal');
            const msgEl = document.getElementById('contactSuccessMessage');
            const btnOk = document.getElementById('contactModalOk');
            const btnClose = document.getElementById('contactModalClose');
            const btnX = document.getElementById('contactModalX');
            let lastFocused = null;

            function showModal(message){
                if(!modal) return;
                msgEl.textContent = message || msgEl.textContent;
                modal.setAttribute('aria-hidden','false');
                modal.style.display = 'flex';
                lastFocused = document.activeElement;
                btnOk.focus();
                window.__contactModalTimer = setTimeout(hideModal, 5000);
            }

            function hideModal(){
                if(!modal) return;
                modal.style.display = 'none';
                modal.setAttribute('aria-hidden','true');
                try{ if(window.__contactModalTimer){ clearTimeout(window.__contactModalTimer); window.__contactModalTimer = null; } }catch(e){}
                if(lastFocused && lastFocused.focus) lastFocused.focus();
            }

            [btnOk, btnClose, btnX].forEach(btn => { if(btn) btn.addEventListener('click', hideModal); });
            if(modal) modal.addEventListener('click', function(e){ if(e.target === modal) hideModal(); });
            document.addEventListener('keydown', function(e){ if(e.key === 'Escape') hideModal(); });

            if(window.contactStatus){
                try{ const el = document.querySelector('form[action="{{ route('contact.submit') }}"]'); if(el && el.scrollIntoView){ el.scrollIntoView({behavior:'smooth', block:'center'}); } }catch(e){}
                setTimeout(()=> showModal(window.contactStatus), 240);
            }
        })();
    </script>
</body>
</html>
