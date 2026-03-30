<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RudraxPay AEPS - Secure & Profitable Aadhaar Enabled Payment Solutions</title>
    <meta name="description" content="Grow your business with RudraxPay AEPS services. Secure onboarding, fast settlements, and reliable support.">
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
        .service-grid { grid-template-columns: repeat(auto-fit, minmax(180px,1fr)); }
        .feature-grid { grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); }
        .steps-grid { grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); }
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

        .feature-card {
            --feature-bg: #dbeafe;
            --feature-bg-2: #eff6ff;
            --feature-accent: #2563eb;
            --feature-accent-2: #7c3aed;
            --feature-shadow: rgba(59,130,246,0.18);
            position: relative;
            display: grid;
            gap: 14px;
            padding: 24px 24px 22px 30px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.72);
            background:
                linear-gradient(160deg, rgba(255,255,255,0.95), rgba(255,255,255,0.58) 42%, transparent 100%),
                linear-gradient(135deg, var(--feature-bg), var(--feature-bg-2));
            box-shadow: 0 20px 36px var(--feature-shadow);
            isolation: isolate;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 22px;
            bottom: 22px;
            width: 8px;
            border-radius: 999px;
            background: linear-gradient(180deg, var(--feature-accent), var(--feature-accent-2));
            box-shadow: 0 10px 24px var(--feature-shadow);
            z-index: 1;
        }
        .feature-card::after {
            content: '';
            position: absolute;
            right: -34px;
            bottom: -48px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.78) 0%, rgba(255,255,255,0.16) 42%, transparent 72%);
            transition: transform .42s cubic-bezier(.2,.9,.2,1), opacity .36s ease;
            opacity: 0.88;
            z-index: 0;
        }
        .feature-card > * { position: relative; z-index: 2; }
        .feature-grid .feature-card:nth-child(1) { --feature-bg: #dbeafe; --feature-bg-2: #eef2ff; --feature-accent: #2563eb; --feature-accent-2: #06b6d4; --feature-shadow: rgba(37,99,235,0.2); }
        .feature-grid .feature-card:nth-child(2) { --feature-bg: #ede9fe; --feature-bg-2: #fae8ff; --feature-accent: #7c3aed; --feature-accent-2: #ec4899; --feature-shadow: rgba(124,58,237,0.18); }
        .feature-grid .feature-card:nth-child(3) { --feature-bg: #cffafe; --feature-bg-2: #e0f2fe; --feature-accent: #0891b2; --feature-accent-2: #2563eb; --feature-shadow: rgba(8,145,178,0.18); }
        .feature-grid .feature-card:nth-child(4) { --feature-bg: #dcfce7; --feature-bg-2: #fef3c7; --feature-accent: #16a34a; --feature-accent-2: #f59e0b; --feature-shadow: rgba(34,197,94,0.18); }
        .feature-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--feature-accent), var(--feature-accent-2));
            color: #fff;
            font-size: 22px;
            box-shadow: 0 16px 30px var(--feature-shadow);
            position: relative;
            overflow: hidden;
            transition: transform .34s cubic-bezier(.2,.9,.2,1), box-shadow .34s ease, filter .34s ease;
        }
        .feature-icon::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.46), rgba(255,255,255,0));
            opacity: 0.9;
        }
        .feature-card strong {
            font-size: 18px;
            line-height: 1.2;
            color: #14263a;
        }
        .feature-card span {
            color: #52647c;
            font-size: 15px;
            line-height: 1.55;
            max-width: 23ch;
        }

        .steps-card {
            --step-bg: #dbeafe;
            --step-bg-2: #eff6ff;
            --step-accent: #2563eb;
            --step-accent-2: #06b6d4;
            --step-shadow: rgba(37,99,235,0.18);
            position: relative;
            display: grid;
            gap: 9px;
            padding: 13px 13px 14px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.76);
            background:
                linear-gradient(160deg, rgba(255,255,255,0.97), rgba(255,255,255,0.72) 42%, transparent 100%),
                linear-gradient(135deg, var(--step-bg), var(--step-bg-2));
            box-shadow: 0 12px 24px var(--step-shadow);
            overflow: hidden;
            isolation: isolate;
        }
        .steps-card::before {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--step-accent), var(--step-accent-2));
            opacity: 0.95;
            z-index: 1;
        }
        .steps-card::after {
            content: '';
            position: absolute;
            right: -40px;
            top: -40px;
            width: 128px;
            height: 128px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.82) 0%, rgba(255,255,255,0.1) 44%, transparent 74%);
            transition: transform .42s cubic-bezier(.2,.9,.2,1), opacity .36s ease;
            opacity: 0.75;
            z-index: 0;
        }
        .steps-card > * {
            position: relative;
            z-index: 2;
        }
        .steps-grid .steps-card:nth-child(1) { --step-bg: #dcfce7; --step-bg-2: #cffafe; --step-accent: #16a34a; --step-accent-2: #06b6d4; --step-shadow: rgba(22,163,74,0.18); }
        .steps-grid .steps-card:nth-child(2) { --step-bg: #dbeafe; --step-bg-2: #e9d5ff; --step-accent: #2563eb; --step-accent-2: #7c3aed; --step-shadow: rgba(37,99,235,0.18); }
        .steps-grid .steps-card:nth-child(3) { --step-bg: #fde68a; --step-bg-2: #fed7aa; --step-accent: #f97316; --step-accent-2: #f59e0b; --step-shadow: rgba(249,115,22,0.2); }
        .steps-media {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(2,8,23,0.1);
            min-height: 168px;
        }
        .steps-media::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(8,15,29,0.08) 0%, rgba(8,15,29,0) 38%, rgba(8,15,29,0.12) 100%);
            z-index: 1;
            pointer-events: none;
        }
        .steps-media::after {
            content: '';
            position: absolute;
            inset: auto 8px 8px auto;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(255,255,255,0.22), rgba(255,255,255,0.01));
            backdrop-filter: blur(6px);
            opacity: 0.66;
            transition: transform .36s ease, opacity .36s ease;
            z-index: 2;
        }
        .steps-card img {
            width: 100%;
            display: block;
            height: 100%;
            min-height: 168px;
            object-fit: cover;
            border-radius: 14px;
            transform: scale(1);
            transition: transform .5s cubic-bezier(.2,.9,.2,1), filter .36s ease;
        }
        .step-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .step-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 9px;
            border-radius: 999px;
            background: rgba(255,255,255,0.76);
            color: var(--step-accent);
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            box-shadow: 0 8px 18px rgba(15,23,42,0.05);
        }
        .step-badge {
            position: static;
            z-index: 1;
            width: 30px;
            height: 30px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--step-accent), var(--step-accent-2));
            border: none;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            box-shadow: 0 8px 16px var(--step-shadow);
            transition: transform .34s cubic-bezier(.2,.9,.2,1), box-shadow .34s ease, filter .34s ease;
        }
        .steps-copy {
            padding: 0 1px;
        }
        .steps-card h3 {
            font-size: 14px;
            line-height: 1.2;
            margin-bottom: 3px;
            color: #14263a;
        }
        .steps-card p {
            color: #5b6f89;
            font-size: 11px;
            line-height: 1.45;
        }

        .about-grid {
            display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 34px; align-items: center;
        }
        .about-copy .section-head {
            margin-bottom: 26px;
        }
        .about-copy .about-card {
            max-width: 560px;
        }
        .about-grid > .about-card {
            width: 100%;
            max-width: 590px;
            justify-self: end;
        }
        .about-card {
            --about-bg: #dbeafe;
            --about-bg-2: #f0fdf4;
            --about-accent: #0f766e;
            --about-accent-2: #2563eb;
            --about-shadow: rgba(37,99,235,0.18);
            position: relative;
            display: grid;
            gap: 14px;
            padding: 20px 20px 18px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.74);
            background:
                linear-gradient(158deg, rgba(255,255,255,0.96), rgba(255,255,255,0.62) 42%, transparent 100%),
                linear-gradient(135deg, var(--about-bg), var(--about-bg-2));
            box-shadow: 0 22px 44px var(--about-shadow);
            overflow: hidden;
            isolation: isolate;
        }
        .about-card::before {
            content: '';
            position: absolute;
            right: -36px;
            bottom: -42px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.85) 0%, rgba(255,255,255,0.18) 42%, transparent 74%);
            opacity: 0.92;
            transition: transform .45s cubic-bezier(.2,.9,.2,1), opacity .36s ease;
            z-index: 0;
        }
        .about-card > * {
            position: relative;
            z-index: 2;
        }
        .about-card--retail {
            --about-bg: #c7f9ff;
            --about-bg-2: #dbeafe;
            --about-accent: #0f766e;
            --about-accent-2: #2563eb;
            --about-shadow: rgba(14,165,164,0.18);
        }
        .about-card--trust {
            --about-bg: #fef3c7;
            --about-bg-2: #ede9fe;
            --about-accent: #7c3aed;
            --about-accent-2: #f59e0b;
            --about-shadow: rgba(124,58,237,0.16);
        }
        .about-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .about-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.68);
            border: 1px solid rgba(255,255,255,0.58);
            color: var(--about-accent);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            box-shadow: 0 10px 22px rgba(15,23,42,0.06);
        }
        .about-score {
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--about-accent), var(--about-accent-2));
            color: #fff;
            font-size: 17px;
            font-weight: 800;
            box-shadow: 0 14px 26px var(--about-shadow);
        }
        .about-card-title {
            font-size: 16px;
            line-height: 1.2;
            color: #122438;
            margin: 0;
        }
        .about-card-copy {
            color: #5b6f89;
            font-size: 14px;
            line-height: 1.58;
            margin: 0;
        }
        .about-card ul,
        .about-card .about-points {
            list-style: none;
            display: grid;
            gap: 10px;
            margin: 0;
        }
        .about-card li,
        .about-point {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: #20344a;
            line-height: 1.5;
        }
        .about-point-icon {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--about-accent), var(--about-accent-2));
            color: #fff;
            box-shadow: 0 12px 22px var(--about-shadow);
            transition: transform .36s cubic-bezier(.2,.9,.2,1), box-shadow .36s ease, filter .36s ease;
        }
        .about-point-icon i {
            font-size: 13px;
        }
        .about-point-text strong {
            display: block;
            font-size: 14px;
            color: #16293d;
        }
        .about-point-text span {
            display: block;
            color: #5b6f89;
            font-size: 12px;
            margin-top: 2px;
        }
        .about-chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 2px;
        }
        .about-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 11px;
            border-radius: 999px;
            background: rgba(255,255,255,0.58);
            border: 1px solid rgba(255,255,255,0.54);
            color: #35506f;
            font-size: 11px;
            font-weight: 700;
        }
        .about-chip i {
            color: var(--about-accent);
        }
        .about-card.interactive.in-view {
            animation-duration: 860ms;
        }
        .about-card:hover {
            border-color: rgba(255,255,255,0.94);
            filter: saturate(1.06);
            box-shadow: 0 30px 60px var(--about-shadow);
        }
        .about-card:hover::before {
            transform: translate3d(-10px, -14px, 0) scale(1.08);
            opacity: 1;
        }
        .about-card:hover .about-point-icon,
        .about-card:hover .about-score {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 18px 30px var(--about-shadow);
            filter: saturate(1.08);
        }
        .about-card:hover .about-card-title {
            color: #0f172a;
        }
        .about-card:hover .about-card-copy,
        .about-card:hover .about-point-text span {
            color: #495d76;
        }

        .testimonial-card {
            --testimonial-bg: #dbeafe;
            --testimonial-bg-2: #eef2ff;
            --testimonial-accent: #2563eb;
            --testimonial-accent-2: #7c3aed;
            --testimonial-shadow: rgba(37,99,235,0.18);
            position: relative;
            display: grid;
            gap: 16px;
            padding: 24px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.74);
            background:
                linear-gradient(160deg, rgba(255,255,255,0.95), rgba(255,255,255,0.6) 42%, transparent 100%),
                linear-gradient(135deg, var(--testimonial-bg), var(--testimonial-bg-2));
            box-shadow: 0 20px 38px var(--testimonial-shadow);
            overflow: hidden;
            isolation: isolate;
        }
        .testimonial-card::before {
            content: '';
            position: absolute;
            inset: 0 auto 0 0;
            width: 7px;
            background: linear-gradient(180deg, var(--testimonial-accent), var(--testimonial-accent-2));
            border-radius: 999px;
            box-shadow: 0 12px 26px var(--testimonial-shadow);
            z-index: 1;
        }
        .testimonial-card::after {
            content: '';
            position: absolute;
            right: -34px;
            bottom: -42px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.82) 0%, rgba(255,255,255,0.16) 42%, transparent 72%);
            transition: transform .42s cubic-bezier(.2,.9,.2,1), opacity .36s ease;
            opacity: 0.88;
            z-index: 0;
        }
        .testimonial-card > * { position: relative; z-index: 2; }
        .testimonials-grid .testimonial-card:nth-child(1) { --testimonial-bg: #dbeafe; --testimonial-bg-2: #eef2ff; --testimonial-accent: #2563eb; --testimonial-accent-2: #4f46e5; --testimonial-shadow: rgba(37,99,235,0.18); }
        .testimonials-grid .testimonial-card:nth-child(2) { --testimonial-bg: #ede9fe; --testimonial-bg-2: #fae8ff; --testimonial-accent: #7c3aed; --testimonial-accent-2: #ec4899; --testimonial-shadow: rgba(124,58,237,0.18); }
        .testimonials-grid .testimonial-card:nth-child(3) { --testimonial-bg: #cffafe; --testimonial-bg-2: #e0f2fe; --testimonial-accent: #0891b2; --testimonial-accent-2: #2563eb; --testimonial-shadow: rgba(8,145,178,0.18); }
        .testimonial-header {
            display: flex;
            gap: 14px;
            align-items: center;
            justify-content: space-between;
        }
        .testimonial-person {
            display: flex;
            gap: 14px;
            align-items: center;
            min-width: 0;
        }
        .testimonial-avatar {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            object-fit: cover;
            background: linear-gradient(135deg, rgba(255,255,255,0.92), rgba(255,255,255,0.62));
            border: 1px solid rgba(255,255,255,0.7);
            box-shadow: 0 14px 28px rgba(15,23,42,0.08);
            padding: 6px;
        }
        .testimonial-name {
            font-weight: 700;
            font-size: 18px;
            line-height: 1.2;
            color: #14263a;
        }
        .testimonial-sub {
            font-size: 13px;
            color: #607089;
            margin-top: 2px;
        }
        .testimonial-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.72);
            color: var(--testimonial-accent);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            white-space: nowrap;
            box-shadow: 0 10px 24px rgba(15,23,42,0.06);
        }
        .testimonial-quote {
            color: #334155;
            font-size: 15px;
            line-height: 1.75;
            font-style: italic;
        }
        .testimonial-quote-mark {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--testimonial-accent), var(--testimonial-accent-2));
            color: #fff;
            font-size: 18px;
            box-shadow: 0 16px 30px var(--testimonial-shadow);
            transition: transform .34s cubic-bezier(.2,.9,.2,1), box-shadow .34s ease, filter .34s ease;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(360px, 520px);
            gap: 24px;
            align-items: start;
            justify-content: space-between;
        }
        .contact-card {
            --contact-bg: #dbeafe;
            --contact-bg-2: #eef2ff;
            --contact-accent: #2563eb;
            --contact-accent-2: #06b6d4;
            --contact-shadow: rgba(37,99,235,0.18);
            position: relative;
            background:
                linear-gradient(160deg, rgba(255,255,255,0.96), rgba(255,255,255,0.58) 42%, transparent 100%),
                linear-gradient(135deg, var(--contact-bg), var(--contact-bg-2));
            border: 1px solid rgba(255,255,255,0.76);
            border-radius: 24px;
            padding: 22px;
            box-shadow: 0 18px 34px var(--contact-shadow);
            overflow: hidden;
            isolation: isolate;
            align-self: start;
            height: auto;
        }
        .contact-card::before {
            content: '';
            position: absolute;
            inset: 0 auto 0 0;
            width: 8px;
            border-radius: 999px;
            background: linear-gradient(180deg, var(--contact-accent), var(--contact-accent-2));
            box-shadow: 0 12px 30px var(--contact-shadow);
            z-index: 1;
        }
        .contact-card::after {
            content: '';
            position: absolute;
            right: -48px;
            bottom: -56px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.82) 0%, rgba(255,255,255,0.16) 42%, transparent 72%);
            transition: transform .42s cubic-bezier(.2,.9,.2,1), opacity .36s ease;
            opacity: 0.92;
            z-index: 0;
        }
        .contact-card > * {
            position: relative;
            z-index: 2;
        }
        .contact-card h3 { font-size: 18px; margin-bottom: 8px; }
        .contact-card p { color: #586980; font-size: 14px; }
        .contact-form {
            --contact-bg: #dff6ff;
            --contact-bg-2: #e9f7ef;
            --contact-accent: #0ea5a4;
            --contact-accent-2: #2563eb;
            --contact-shadow: rgba(14,165,164,0.18);
            width: 100%;
            max-width: 520px;
            justify-self: end;
        }
        .contact-grid .contact-card:first-child {
            --contact-bg: #e0f2fe;
            --contact-bg-2: #eef2ff;
            --contact-accent: #2563eb;
            --contact-accent-2: #7c3aed;
            --contact-shadow: rgba(59,130,246,0.18);
        }
        .contact-lead {
            font-size: 14px;
            line-height: 1.55;
            max-width: 34ch;
        }
        .contact-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 11px;
            border-radius: 999px;
            background: rgba(255,255,255,0.76);
            color: var(--contact-accent);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 12px;
            box-shadow: 0 10px 24px rgba(15,23,42,0.06);
        }
        .contact-list {
            margin-top: 16px;
            display: grid;
            gap: 10px;
        }
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 16px;
            background: rgba(255,255,255,0.68);
            border: 1px solid rgba(255,255,255,0.72);
            box-shadow: 0 10px 22px rgba(15,23,42,0.05);
            transition: transform .3s ease, box-shadow .3s ease, background .3s ease;
        }
        .contact-item i {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: #fff !important;
            box-shadow: 0 10px 20px rgba(15,23,42,0.1);
            flex-shrink: 0;
        }
        .contact-item:nth-child(1) i { background: linear-gradient(135deg, #0ea5a4, #06b6d4); }
        .contact-item:nth-child(2) i { background: linear-gradient(135deg, #2563eb, #7c3aed); }
        .contact-item:nth-child(3) i { background: linear-gradient(135deg, #f59e0b, #f97316); }
        .contact-item strong {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #64748b;
            margin-bottom: 3px;
        }
        .contact-item span {
            color: #1e293b;
            line-height: 1.45;
            font-size: 14px;
        }
        .contact-form-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }
        .contact-form-glow {
            width: 50px;
            height: 50px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 18px;
            background: linear-gradient(135deg, var(--contact-accent), var(--contact-accent-2));
            box-shadow: 0 14px 26px var(--contact-shadow);
            position: relative;
            overflow: hidden;
            transition: transform .34s cubic-bezier(.2,.9,.2,1), box-shadow .34s ease, filter .34s ease;
        }
        .contact-form-glow::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.46), rgba(255,255,255,0));
            opacity: 0.9;
        }
        .contact-form-copy p {
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 2px;
        }
        .form-control {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.82);
            font-size: 13px;
            font-family: var(--font-sans);
            background: rgba(255,255,255,0.8);
            box-shadow: 0 10px 20px rgba(15,23,42,0.05);
            transition: border-color .25s ease, box-shadow .25s ease, transform .25s ease, background .25s ease;
        }
        .form-control:focus {
            outline: none;
            border-color: rgba(14,165,164,0.42);
            background: rgba(255,255,255,0.96);
            box-shadow: 0 0 0 4px rgba(14,165,164,0.12), 0 14px 24px rgba(15,23,42,0.08);
            transform: translateY(-1px);
        }
        .form-stack { display: grid; gap: 12px; }

        .team-card {
            --team-bg: #dbeafe;
            --team-bg-2: #f5d0fe;
            --team-accent: #2563eb;
            --team-accent-2: #8b5cf6;
            --team-shadow: rgba(59,130,246,0.18);
            position: relative;
            text-align: center;
            padding: 28px 28px 26px;
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,0.78);
            background:
                linear-gradient(160deg, rgba(255,255,255,0.96), rgba(255,255,255,0.62) 44%, transparent 100%),
                linear-gradient(135deg, var(--team-bg), var(--team-bg-2));
            box-shadow: 0 24px 46px var(--team-shadow);
            overflow: hidden;
            isolation: isolate;
        }
        .team-card::before {
            content: '';
            position: absolute;
            inset: 0 auto 0 0;
            width: 8px;
            border-radius: 999px;
            background: linear-gradient(180deg, var(--team-accent), var(--team-accent-2));
            box-shadow: 0 12px 28px var(--team-shadow);
            z-index: 1;
        }
        .team-card::after {
            content: '';
            position: absolute;
            right: -48px;
            top: -38px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.78) 0%, rgba(255,255,255,0.12) 42%, transparent 72%);
            opacity: 0.92;
            transition: transform .42s cubic-bezier(.2,.9,.2,1), opacity .36s ease;
            z-index: 0;
        }
        .team-card > * {
            position: relative;
            z-index: 2;
        }
        .team-card-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 13px;
            border-radius: 999px;
            background: rgba(255,255,255,0.78);
            color: var(--team-accent);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            box-shadow: 0 10px 22px rgba(15,23,42,0.06);
            margin-bottom: 14px;
        }
        .team-card h2 {
            font-family: var(--font-display);
            font-size: clamp(34px, 4vw, 52px);
            line-height: 1.04;
            letter-spacing: -0.03em;
            margin-bottom: 12px;
            color: #102338;
        }
        .team-card-copy {
            color: #5b6f89;
            font-size: 16px;
            line-height: 1.65;
            max-width: 54ch;
            margin: 0 auto 18px;
        }
        .team-pill-row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }
        .team-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.72);
            border: 1px solid rgba(255,255,255,0.76);
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 10px 24px rgba(15,23,42,0.05);
            transition: transform .28s ease, box-shadow .28s ease, background .28s ease;
        }
        .team-pill i {
            color: var(--team-accent);
        }
        .team-card .btn-outline {
            background: linear-gradient(135deg, var(--team-accent), var(--team-accent-2));
            color: #fff;
            border: none;
            min-width: 170px;
            padding: 13px 24px;
            box-shadow: 0 16px 32px var(--team-shadow);
        }
        .team-card .btn-outline:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 22px 40px var(--team-shadow);
        }
        .team-card.reveal.in-view {
            animation: entro 860ms cubic-bezier(.2,.9,.2,1) both;
        }
        .team-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 30px 54px var(--team-shadow);
            border-color: rgba(255,255,255,0.92);
            filter: saturate(1.08);
        }
        .team-card:hover::after {
            transform: translate3d(-16px, 10px, 0) scale(1.08);
            opacity: 1;
        }
        .team-card:hover .team-pill {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(15,23,42,0.08);
            background: rgba(255,255,255,0.84);
        }

        .site-footer {
            position: relative;
            margin-top: 72px;
            padding: 68px 0 32px;
            background:
                radial-gradient(circle at 12% 18%, rgba(37,99,235,0.2), transparent 28%),
                radial-gradient(circle at 84% 18%, rgba(14,165,164,0.18), transparent 26%),
                radial-gradient(circle at 52% 92%, rgba(245,158,11,0.16), transparent 30%),
                linear-gradient(180deg, #081423 0%, #06101c 100%);
            color: #cbd5e1;
            overflow: hidden;
        }
        .site-footer::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(255,255,255,0.05), rgba(255,255,255,0)),
                radial-gradient(circle at 50% 0%, rgba(255,255,255,0.06), transparent 45%);
            pointer-events: none;
        }
        .footer-grid {
            max-width: 1220px;
            margin: 0 auto;
            padding: 0 28px;
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) repeat(3, minmax(190px, 1fr));
            gap: 34px;
            align-items: stretch;
        }
        .footer-card {
            position: relative;
            padding: 0;
            background: transparent;
            border: none;
            box-shadow: none;
            backdrop-filter: none;
            overflow: visible;
            transition: transform .28s cubic-bezier(.2,.9,.2,1), opacity .28s ease;
        }
        .footer-card::after {
            display: none;
        }
        .footer-card:hover {
            transform: translateY(-3px);
        }
        .footer-card > * {
            position: relative;
            z-index: 2;
        }
        .footer-brand-card { padding-right: 22px; }
        .footer-logo-shell {
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 18px;
        }
        .footer-logo-shell img {
            width: 148px;
            height: auto;
            filter: drop-shadow(0 14px 24px rgba(15,23,42,0.16));
            position: relative;
            z-index: 2;
        }
        .footer-brand-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            margin-bottom: 14px;
            border-radius: 999px;
            background: linear-gradient(135deg, rgba(37,99,235,0.14), rgba(14,165,164,0.12));
            border: 1px solid rgba(125,211,252,0.18);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #8dd3ff;
        }
        .footer-brand-tag::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, #38bdf8, #22c55e);
            box-shadow: 0 0 0 6px rgba(56,189,248,0.12);
        }
        .footer-brand-name {
            font-family: var(--font-display);
            font-size: 44px;
            line-height: 0.96;
            color: #f8fbff;
            margin-bottom: 14px;
            letter-spacing: -0.04em;
            text-shadow: 0 8px 24px rgba(15,23,42,0.22);
        }
        .footer-brand-copy {
            color: #c3d3e7;
            font-size: 17px;
            line-height: 1.82;
            max-width: 33ch;
            text-wrap: balance;
        }
        .footer-title {
            font-family: var(--font-display);
            font-size: 28px;
            line-height: 1.05;
            margin-bottom: 16px;
            color: #f8fbff;
            letter-spacing: -0.02em;
        }
        .footer-list {
            list-style: none;
            display: grid;
            gap: 13px;
            font-size: 16px;
        }
        .footer-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: #d7e2ef;
            line-height: 1.55;
            transition: transform .24s ease, color .24s ease, opacity .24s ease;
        }
        .footer-list li i {
            color: #69a7ff;
            margin-top: 5px;
            flex-shrink: 0;
            font-size: 16px;
        }
        .footer-list a {
            color: inherit;
            transition: color .24s ease;
        }
        .footer-card:hover .footer-list li {
            color: #eef2ff;
        }
        .footer-card:hover .footer-list li:hover {
            transform: translateX(4px);
        }
        .footer-bottom {
            max-width: 1220px;
            margin: 28px auto 0;
            padding: 0 28px;
            font-size: 14px;
            color: #a9bacf;
            border-top: 1px solid rgba(148,163,184,0.12);
            padding-top: 20px;
        }
        .footer-bottom-bar {
            padding: 0;
            border-radius: 0;
            background: transparent;
            border: none;
            box-shadow: none;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-bottom-bar strong {
            color: #e3eefc;
            font-weight: 600;
        }

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
        .card.interactive {
            --card-tilt-x: 0deg;
            --card-tilt-y: 0deg;
            --card-lift: 0px;
            --card-scale: 1;
            position: relative;
            overflow: visible;
            border-radius: 16px;
            transition: transform .4s cubic-bezier(.2,.9,.2,1), box-shadow .36s ease, filter .36s ease, border-color .36s ease;
            transform: perspective(1000px) rotateX(var(--card-tilt-y)) rotateY(var(--card-tilt-x)) translateY(calc(var(--card-lift) * -1)) scale(var(--card-scale));
            will-change: transform, box-shadow;
            cursor: pointer;
        }
        .card.interactive .card-inner { position: relative; z-index: 2; }
        .card.interactive::after {
            content: '';
            position: absolute;
            right: 18px;
            top: 18px;
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(255,255,255,0.18), rgba(255,255,255,0.03));
            box-shadow: 0 8px 20px rgba(2,8,23,0.04);
            pointer-events: none;
            transform: rotate(12deg);
            opacity: 0.6;
            transition: transform .36s ease, opacity .36s ease;
        }
        .card.interactive:hover {
            --card-lift: 12px;
            --card-scale: 1.025;
            box-shadow: 0 36px 90px rgba(11,27,43,0.14);
        }
        .card.interactive:hover::after { opacity: 0.92; transform: rotate(8deg) translateY(-3px); }
        .card.interactive:focus-within { outline: 3px solid rgba(14,165,164,0.14); }

        /* Service cards: brighter, richer, more tactile */
        .service-grid .service-card {
            --card-bg: #dbeafe;
            --card-bg-2: #eff6ff;
            --card-accent: #0f766e;
            --card-accent-2: #38bdf8;
            --card-shadow: rgba(59,130,246,0.18);
            min-height: 220px;
            padding: 20px 18px 18px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.7);
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: flex-start;
            justify-content: flex-start;
            background:
                linear-gradient(160deg, rgba(255,255,255,0.96), rgba(255,255,255,0.58) 38%, transparent 100%),
                linear-gradient(135deg, var(--card-bg-2), var(--card-bg));
            box-shadow: 0 16px 30px var(--card-shadow);
            isolation: isolate;
            overflow: hidden;
        }
        .service-card::before {
            content: '';
            position: absolute;
            inset: auto -16% -30% auto;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.75) 0%, rgba(255,255,255,0.18) 38%, transparent 72%);
            opacity: 0.9;
            transition: transform .45s cubic-bezier(.2,.9,.2,1), opacity .36s ease;
            z-index: 0;
        }
        .service-card::after {
            width: 44px;
            height: 44px;
            right: 14px;
            top: 14px;
            border-radius: 10px;
        }
        .service-card > * { position: relative; z-index: 2; }
        .service-grid .service-card:nth-child(1) { --card-bg: #bfdbfe; --card-bg-2: #e0f2fe; --card-accent: #0f766e; --card-accent-2: #2563eb; --card-shadow: rgba(37,99,235,0.18); }
        .service-grid .service-card:nth-child(2) { --card-bg: #fed7aa; --card-bg-2: #ffedd5; --card-accent: #c2410c; --card-accent-2: #f59e0b; --card-shadow: rgba(245,158,11,0.2); }
        .service-grid .service-card:nth-child(3) { --card-bg: #a5f3fc; --card-bg-2: #cffafe; --card-accent: #0f766e; --card-accent-2: #06b6d4; --card-shadow: rgba(6,182,212,0.2); }
        .service-grid .service-card:nth-child(4) { --card-bg: #fbcfe8; --card-bg-2: #fdf2f8; --card-accent: #be185d; --card-accent-2: #ec4899; --card-shadow: rgba(236,72,153,0.18); }
        .service-grid .service-card:nth-child(5) { --card-bg: #c7d2fe; --card-bg-2: #e0f2fe; --card-accent: #1d4ed8; --card-accent-2: #38bdf8; --card-shadow: rgba(56,189,248,0.18); }
        .service-grid .service-card:nth-child(6) { --card-bg: #d9f99d; --card-bg-2: #f7fee7; --card-accent: #3f6212; --card-accent-2: #84cc16; --card-shadow: rgba(132,204,22,0.18); }
        .service-grid .service-card:nth-child(7) { --card-bg: #fecdd3; --card-bg-2: #fff1f2; --card-accent: #be123c; --card-accent-2: #fb7185; --card-shadow: rgba(244,63,94,0.18); }
        .service-grid .service-card:nth-child(8) { --card-bg: #ddd6fe; --card-bg-2: #eef2ff; --card-accent: #5b21b6; --card-accent-2: #60a5fa; --card-shadow: rgba(99,102,241,0.18); }
        .service-card .icon {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-size: 21px;
            color: #fff;
            background: linear-gradient(135deg, var(--card-accent), var(--card-accent-2));
            box-shadow: 0 14px 26px var(--card-shadow);
            position: relative;
            overflow: hidden;
            transition: transform .36s cubic-bezier(.2,.9,.2,1), box-shadow .36s ease, filter .36s ease;
        }
        .service-card .icon::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.42), rgba(255,255,255,0));
            opacity: 0.85;
        }
        .service-card h3 {
            font-size: 15px;
            line-height: 1.2;
            color: #14263a;
        }
        .service-card p {
            color: #51637c;
            font-size: 13px;
            line-height: 1.45;
            max-width: 17ch;
        }

        .feature-grid .feature-card.interactive { --card-delay: 0ms; }
        .steps-grid .steps-card.interactive img { box-shadow: 0 16px 40px rgba(2,8,23,0.06); }

        /* Testimonials: portrait + quote emphasis */
        .testimonial-card.interactive { display:flex; flex-direction:column; gap:16px; }

        /* Metrics: badge-like, compact */
        .metric-card.interactive { display:flex; gap:12px; align-items:center; padding:14px 18px; border-radius:12px; }

        /* Contact cards: richer hover and entrance */
        .contact-card.interactive.in-view { animation-duration: 880ms; }
        .contact-card:hover {
            border-color: rgba(255,255,255,0.94);
            filter: saturate(1.08);
        }
        .contact-card:hover::after { transform: translate3d(-14px, -12px, 0) scale(1.08); opacity: 1; }
        .contact-card:hover .contact-form-glow {
            transform: translateY(-6px) scale(1.08) rotate(-5deg);
            box-shadow: 0 22px 38px var(--contact-shadow);
            filter: saturate(1.08);
        }
        .contact-card:hover .contact-item {
            transform: translateX(4px);
            box-shadow: 0 18px 34px rgba(15,23,42,0.08);
            background: rgba(255,255,255,0.8);
        }
        .contact-card:hover h3 { color: #0f172a; }
        .contact-card:hover p { color: #475569; }

        /* accessible focus and reduces */
        .card.interactive:focus { outline: none; }
        .card.interactive:focus-visible { outline: 3px solid rgba(37,99,235,0.12); border-radius:12px; }

        @keyframes floatSubtle { 0% { transform: translateY(0); } 50% { transform: translateY(-6px); } 100% { transform: translateY(0); } }
        .hero .metric-card { animation: floatSubtle 6s ease-in-out infinite; }

        /* Entry animation for interactive elements */
        @keyframes entro {
            0% { opacity: 0; transform: translateY(18px) scale(0.995) rotateX(4deg); filter: blur(6px); }
            60% { opacity: 1; transform: translateY(-6px) scale(1.01) rotateX(0deg); filter: blur(0); }
            100% { opacity: 1; transform: translateY(0) scale(1) rotateX(0deg); filter: blur(0); }
        }

        .interactive.in-view { animation: entro 720ms cubic-bezier(.2,.9,.2,1) var(--card-delay,0ms) both; }

        .service-card.interactive.in-view { animation-duration: 860ms; }
        .service-card:hover {
            border-color: rgba(255,255,255,0.95);
            filter: saturate(1.08);
        }
        .service-card:hover::before { transform: translate3d(-12px, -14px, 0) scale(1.08); opacity: 1; }
        .service-card:hover .icon {
            transform: translateY(-6px) scale(1.06) rotate(-4deg);
            box-shadow: 0 20px 34px var(--card-shadow);
            filter: saturate(1.08);
        }
        .service-card:hover h3 { color: #0f172a; }
        .service-card:hover p { color: #42546d; }


        @media (max-width: 980px) {
            .service-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
            .hero-grid { grid-template-columns: 1fr; }
            .hero-visual { order: 2; }
        }

        @media (prefers-reduced-motion: reduce) {
            .card.interactive, .hero .metric-card { animation: none !important; transition: none !important; }
            .reveal { transition: none !important; transform: none !important; opacity: 1 !important; }
        }

        .feature-card.interactive, .steps-card.interactive, .testimonial-card.interactive, .metric-card.interactive, .contact-card.interactive { --card-delay: 0ms; transition-delay: var(--card-delay); }
        .feature-card.interactive.in-view { animation-duration: 820ms; }
        .feature-card:hover {
            border-color: rgba(255,255,255,0.92);
            filter: saturate(1.08);
        }
        .feature-card:hover::after { transform: translate3d(-14px, -12px, 0) scale(1.08); opacity: 1; }
        .feature-card:hover .feature-icon {
            transform: translateY(-7px) scale(1.08) rotate(-5deg);
            box-shadow: 0 20px 36px var(--feature-shadow);
            filter: saturate(1.08);
        }
        .feature-card:hover strong { color: #0f172a; }
        .feature-card:hover span { color: #42546d; }
        .steps-card.interactive.in-view { animation-duration: 860ms; }
        .steps-card:hover {
            border-color: rgba(255,255,255,0.92);
            filter: saturate(1.08);
        }
        .steps-card:hover::after {
            transform: translate3d(-10px, 8px, 0) scale(1.06);
            opacity: 1;
        }
        .steps-card:hover .steps-media::after {
            transform: translateY(-3px) rotate(-6deg);
            opacity: 1;
        }
        .steps-card:hover img {
            transform: scale(1.03);
            filter: saturate(1.04) contrast(1.02);
        }
        .steps-card:hover .step-badge {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 12px 20px var(--step-shadow);
            filter: saturate(1.08);
        }
        .steps-card:hover h3 { color: #0f172a; }
        .steps-card:hover p { color: #475569; }
        .testimonial-card.interactive.in-view { animation-duration: 860ms; }
        .testimonial-card:hover {
            border-color: rgba(255,255,255,0.92);
            filter: saturate(1.08);
        }
        .testimonial-card:hover::after { transform: translate3d(-14px, -12px, 0) scale(1.08); opacity: 1; }
        .testimonial-card:hover .testimonial-quote-mark {
            transform: translateY(-6px) scale(1.08) rotate(-6deg);
            box-shadow: 0 20px 34px var(--testimonial-shadow);
            filter: saturate(1.08);
        }
        .testimonial-card:hover .testimonial-name { color: #0f172a; }
        .testimonial-card:hover .testimonial-quote { color: #1e293b; }

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
            .about-copy .about-card,
            .about-grid > .about-card { max-width: 100%; justify-self: stretch; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 28px; }
        }
        @media (max-width: 860px) {
            .nav-links { display: none; position: absolute; top: 68px; left: 20px; right: 20px; flex-direction: column; background: var(--surface); border: 1px solid var(--stroke); padding: 14px; border-radius: 16px; box-shadow: var(--shadow); }
            .nav-links.open { display: flex; }
            .nav-toggle { display: inline-flex; }
        }
        @media (max-width: 640px) {
            .service-grid { grid-template-columns: 1fr; }
            .service-grid .service-card { min-height: 200px; }
            .feature-card { padding: 22px 20px 20px 26px; }
            .steps-card { padding: 12px 12px 14px; border-radius: 18px; }
            .steps-media, .steps-card img { border-radius: 14px; min-height: 156px; }
            .step-badge { width: 28px; height: 28px; font-size: 12px; }
            .steps-card p { font-size: 11px; }
            .testimonial-card { padding: 22px 20px; }
            .testimonial-header { align-items: flex-start; flex-direction: column; }
            .testimonial-chip { align-self: flex-start; }
            .contact-card { padding: 22px 20px; border-radius: 24px; }
            .contact-form-header { align-items: flex-start; flex-direction: column; }
            .team-card { padding: 24px 20px 22px; border-radius: 24px; }
            .team-card h2 { font-size: 34px; }
            .team-card-copy { font-size: 15px; }
            .team-pill-row { gap: 8px; }
            .team-pill { font-size: 12px; padding: 9px 12px; }
            .footer-grid { grid-template-columns: 1fr; gap: 24px; padding: 0 20px; }
            .footer-logo-shell { margin-bottom: 16px; }
            .footer-logo-shell img { width: 120px; }
            .footer-brand-name { font-size: 36px; }
            .footer-brand-copy { font-size: 16px; }
            .footer-title { font-size: 24px; }
            .footer-bottom { padding: 0 20px; }
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
                <img src="{{ asset('assets/logo_bg.png') }}" alt="RudraxPay" decoding="async" onerror="this.style.display='none'" />
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
                                <img src="{{ asset('assets/slide1.png') }}" alt="slide1" decoding="async" fetchpriority="high">
                                <img src="{{ asset('assets/slide2.png') }}" alt="slide2" loading="lazy" decoding="async">
                                <img src="{{ asset('assets/slide3.png') }}" alt="slide3" loading="lazy" decoding="async">
                                <img src="{{ asset('assets/slide4.png') }}" alt="slide4" loading="lazy" decoding="async">
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
                    <div class="trusted-logo"><img src="{{ asset('assets/logo2.png') }}" alt="Bank Partner" loading="lazy" decoding="async" onerror="this.style.display='none'"></div>
                    <div class="trusted-logo"><img src="{{ asset('assets/logo3.png') }}" alt="Payment Gateway" loading="lazy" decoding="async" onerror="this.style.display='none'"></div>
                    <div class="trusted-logo"><img src="{{ asset('assets/logo_bg.png') }}" alt="Top Aggregator" loading="lazy" decoding="async" onerror="this.style.display='none'"></div>
                    <div class="trusted-logo"><img src="{{ asset('assets/slide1.png') }}" alt="Retailers" loading="lazy" decoding="async" onerror="this.style.display='none'"></div>
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
                <div class="about-copy reveal">
                    <div class="section-head">
                        <h2>Built for local retailers and distributors</h2>
                        <p>RudraxPay partners with neighborhood stores to deliver assisted digital financial services with reliable onboarding and support.</p>
                    </div>
                    <div class="card about-card about-card--retail interactive reveal">
                        <div class="about-card-top">
                            <span class="about-badge"><i class="fas fa-store"></i> Retailer Benefits</span>
                            <span class="about-score">01</span>
                        </div>
                        <h3 class="about-card-title">Why retailers choose us</h3>
                        <ul class="about-points">
                            <li class="about-point">
                                <span class="about-point-icon"><i class="fas fa-check-circle"></i></span>
                                <span class="about-point-text">
                                    <strong>Fast KYC and activation</strong>
                                    <span>Get approved quickly and start serving customers without delays.</span>
                                </span>
                            </li>
                            <li class="about-point">
                                <span class="about-point-icon"><i class="fas fa-bolt"></i></span>
                                <span class="about-point-text">
                                    <strong>Low downtime and quick settlements</strong>
                                    <span>Keep daily transactions smooth with dependable processing.</span>
                                </span>
                            </li>
                            <li class="about-point">
                                <span class="about-point-icon"><i class="fas fa-handshake-angle"></i></span>
                                <span class="about-point-text">
                                    <strong>Dedicated relationship support</strong>
                                    <span>Get real help when your store needs onboarding or service guidance.</span>
                                </span>
                            </li>
                        </ul>
                        <div class="about-chip-row">
                            <span class="about-chip"><i class="fas fa-user-check"></i> Fast onboarding</span>
                            <span class="about-chip"><i class="fas fa-wallet"></i> Daily earnings</span>
                            <span class="about-chip"><i class="fas fa-headset"></i> Active support</span>
                        </div>
                    </div>
                </div>
                <div class="card about-card about-card--trust interactive reveal">
                    <div class="about-card-top">
                        <span class="about-badge"><i class="fas fa-chart-line"></i> Reliable Platform</span>
                        <span class="about-score">02</span>
                    </div>
                    <h3 class="about-card-title">Performance you can trust</h3>
                    <p class="about-card-copy">We combine compliant processes with an efficient platform to help you serve more customers every day. From cash withdrawals to bill collections, everything is designed for speed, security, and ease of use.</p>
                    <ul class="about-points">
                        <li class="about-point">
                            <span class="about-point-icon"><i class="fas fa-bolt"></i></span>
                            <span class="about-point-text">
                                <strong>Real-time transaction updates</strong>
                                <span>Stay informed with fast activity visibility for your store.</span>
                            </span>
                        </li>
                        <li class="about-point">
                            <span class="about-point-icon"><i class="fas fa-headset"></i></span>
                            <span class="about-point-text">
                                <strong>Support team with rapid escalation</strong>
                                <span>Get timely help when operational issues need quick attention.</span>
                            </span>
                        </li>
                        <li class="about-point">
                            <span class="about-point-icon"><i class="fas fa-lock"></i></span>
                            <span class="about-point-text">
                                <strong>Secure device and API controls</strong>
                                <span>Operate with stronger protection across devices and services.</span>
                            </span>
                        </li>
                    </ul>
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
                        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                        <strong>Unified dashboard</strong>
                        <span>Track settlements, commissions, and transaction health from one place.</span>
                    </div>
                    <div class="card feature-card">
                        <div class="feature-icon"><i class="fas fa-user-shield"></i></div>
                        <strong>Role-based access</strong>
                        <span>Admin, distributor, and retailer experiences are tailored to responsibilities.</span>
                    </div>
                    <div class="card feature-card">
                        <div class="feature-icon"><i class="fas fa-shield-halved"></i></div>
                        <strong>Risk monitoring</strong>
                        <span>Automated flags and audit logs keep your operations compliant.</span>
                    </div>
                    <div class="card feature-card">
                        <div class="feature-icon"><i class="fas fa-bolt"></i></div>
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
                        <div class="step-top">
                            <div class="step-chip"><i class="fas fa-user-plus"></i> Step one</div>
                            <div class="step-badge">1</div>
                        </div>
                        <div class="steps-media">
                            <img src="{{ asset('assets/step1.png') }}" alt="Sign up" loading="lazy" decoding="async" onerror="this.src='{{ asset('assets/slide2.png') }}'">
                        </div>
                        <div class="steps-copy">
                            <h3>Register and verify</h3>
                            <p>Submit details and KYC to receive your retailer ID.</p>
                        </div>
                    </div>
                    <div class="card steps-card">
                        <div class="step-top">
                            <div class="step-chip"><i class="fas fa-fingerprint"></i> Step two</div>
                            <div class="step-badge">2</div>
                        </div>
                        <div class="steps-media">
                            <img src="{{ asset('assets/step2.png') }}" alt="Activate" loading="lazy" decoding="async" onerror="this.src='{{ asset('assets/slide3.png') }}'">
                        </div>
                        <div class="steps-copy">
                            <h3>Activate AEPS</h3>
                            <p>Connect your device and activate services with our support team.</p>
                        </div>
                    </div>
                    <div class="card steps-card">
                        <div class="step-top">
                            <div class="step-chip"><i class="fas fa-wallet"></i> Step three</div>
                            <div class="step-badge">3</div>
                        </div>
                        <div class="steps-media">
                            <img src="{{ asset('assets/step3.png') }}" alt="Earn" loading="lazy" decoding="async" onerror="this.src='{{ asset('assets/slide4.png') }}'">
                        </div>
                        <div class="steps-copy">
                            <h3>Earn daily commissions</h3>
                            <p>Serve customers and track earnings in real time.</p>
                        </div>
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
                                <div class="testimonial-person">
                                    <img src="{{ $t['image'] }}" alt="{{ $t['name'] }}" class="testimonial-avatar" loading="lazy" decoding="async" onerror="this.src='{{ asset('assets/logo_bg.png') }}'">
                                    <div>
                                        <div class="testimonial-name">{{ $t['name'] }}</div>
                                        <div class="testimonial-sub">{{ $t['sub'] }}</div>
                                    </div>
                                </div>
                                <div class="testimonial-chip"><i class="fas fa-circle-check"></i> Trusted</div>
                            </div>
                            <div class="testimonial-quote-mark"><i class="fas fa-quote-right"></i></div>
                            <div class="testimonial-quote">"{{ $t['quote'] }}"</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="contact" class="section">
            <div class="container contact-grid">
                <div class="contact-card reveal">
                    <div class="contact-badge"><i class="fas fa-headset"></i> Fast support</div>
                    <h3>Talk to our onboarding team</h3>
                    <p class="contact-lead">Share your details and we will contact you with the next steps, pricing, and device guidance.</p>
                    <div class="contact-list">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong>Call us</strong>
                                <span>+91 96343 50509</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email</strong>
                                <span>info@mudramarvel.in</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Visit office</strong>
                                <span>Ward No.06, Kunda, Partapur, Meerut, Uttar Pradesh</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-card contact-form reveal">
                    @if(session('status'))
                        <script>window.contactStatus = {!! json_encode(session('status')) !!};</script>
                    @endif
                    <div class="contact-form-header">
                        <div class="contact-form-copy">
                            <div class="contact-badge"><i class="fas fa-paper-plane"></i> Quick enquiry</div>
                            <h3>Fill the form to get started</h3>
                            <p>Tell us about your role and we will guide you with onboarding.</p>
                        </div>
                        <div class="contact-form-glow"><i class="fas fa-file-signature"></i></div>
                    </div>
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
                            <textarea name="message" class="form-control" rows="4" placeholder="Message (Optional)"></textarea>
                            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Enquire Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section id="team" class="section">
            <div class="container">
                <div class="team-card reveal">
                    <div class="team-card-badge"><i class="fas fa-users"></i> Our people</div>
                    <h2>Meet the Team</h2>
                    <p class="team-card-copy">A focused team across operations, engineering, and partnerships committed to merchant success.</p>
                    <div class="team-pill-row">
                        <div class="team-pill"><i class="fas fa-headset"></i> Operations</div>
                        <div class="team-pill"><i class="fas fa-code"></i> Engineering</div>
                        <div class="team-pill"><i class="fas fa-handshake"></i> Partnerships</div>
                    </div>
                    <a href="{{ route('team') }}" class="btn btn-outline"><i class="fas fa-arrow-right"></i> Read more</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div class="footer-card footer-brand-card reveal">
                    <div class="footer-logo-shell">
                    <img src="{{ asset('assets/logo.jpeg') }}" alt="RudraxPay" loading="lazy" decoding="async" onerror="this.style.display='none'">
                </div>
                <div class="footer-brand-tag">Trusted Retail Platform</div>
                <div class="footer-brand-name">RudraxPay</div>
                <p class="footer-brand-copy">We operate on a B2B2C model, partnering with neighborhood retail stores to offer assisted digital financial services like AEPS, bill payments, money transfer, travel, and insurance.</p>
            </div>
            <div class="footer-card reveal">
                <div class="footer-title">Services</div>
                <ul class="footer-list">
                    <li><i class="fas fa-fingerprint"></i><span>AEPS Cash Withdrawal</span></li>
                    <li><i class="fas fa-file-invoice"></i><span>Mini Statement</span></li>
                    <li><i class="fas fa-money-bill-wave"></i><span>Money Transfer</span></li>
                    <li><i class="fas fa-credit-card"></i><span>Bill Payments</span></li>
                    <li><i class="fas fa-shield-alt"></i><span>Insurance</span></li>
                </ul>
            </div>
            <div class="footer-card reveal">
                <div class="footer-title">Quick Links</div>
                <ul class="footer-list">
                    <li><i class="fas fa-arrow-right"></i><a href="#about">About Us</a></li>
                    <li><i class="fas fa-arrow-right"></i><a href="#services">Services</a></li>
                    <li><i class="fas fa-arrow-right"></i><a href="#features">Features</a></li>
                    <li><i class="fas fa-arrow-right"></i><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-card reveal">
                <div class="footer-title">Connect</div>
                <ul class="footer-list">
                    <li><i class="fas fa-location-dot"></i><span>Ward No.06, Kunda, Partapur, Meerut</span></li>
                    <li><i class="fas fa-phone"></i><span>+91 96343 50509</span></li>
                    <li><i class="fas fa-phone-volume"></i><span>+91 80771 13239</span></li>
                    <li><i class="fas fa-envelope"></i><span>info@mudramarvel.in</span></li>
                </ul>
            </div>
        </div>
        <div class="container footer-bottom">
            <div class="footer-bottom-bar">
                <div><strong>Copyright 2025</strong>, Powered by Mudramarvel Pvt Ltd</div>
                <div><strong>Working Hours:</strong> Monday-Saturday, 9am-5pm</div>
            </div>
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
            const groups = ['.service-grid', '.feature-grid', '.steps-grid', '.testimonials-grid', '.hero-metrics', '.contact-grid', '.footer-grid'];
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
                    raf = requestAnimationFrame(() => {
                        el.style.setProperty('--card-tilt-x', `${lastX.toFixed(2)}deg`);
                        el.style.setProperty('--card-tilt-y', `${lastY.toFixed(2)}deg`);
                    });
                }
                function reset(){
                    if(raf) cancelAnimationFrame(raf);
                    lastX = 0;
                    lastY = 0;
                    el.style.setProperty('--card-tilt-x', '0deg');
                    el.style.setProperty('--card-tilt-y', '0deg');
                }
                el.addEventListener('mousemove', handleMove);
                el.addEventListener('mouseleave', reset);
                // touch: disable tilt interactions on first touch
                el.addEventListener('touchstart', () => {
                    el.classList.remove('tilt-enabled');
                    reset();
                }, {passive:true});
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
