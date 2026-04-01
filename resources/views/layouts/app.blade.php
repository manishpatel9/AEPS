<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AEPS Platform') - Aadhaar Enabled Payment System</title>
    <meta name="description" content="@yield('meta_description', 'AEPS Platform - Secure Aadhaar Enabled Payment System for Cash Withdrawal, Balance Enquiry, Mini Statement, Bill Payments & More')">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --font-sans: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            --font-display: Georgia, "Times New Roman", serif;

            --primary: #1d4ed8;
            --primary-dark: #1e40af;
            --secondary: #0ea5a4;
            --accent: #ff7a1a;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #f59e0b;
            --info: #0284c7;

            --bg: #f4f6fb;
            --bg-soft: #eef2f8;
            --surface: #ffffff;
            --surface-alt: #f8fafc;
            --header-bg: #FFFFFF;
            --text-primary: #101828;
            --text-secondary: #475467;
            --text-muted: #8b95a7;
            --border-color: #e7ebf3;

            --sidebar-bg: linear-gradient(180deg,#0f172a 0%, #111827 100%);
            --sidebar-text: #f8fafc;
            --sidebar-muted: rgba(248,250,252,0.68);
            --sidebar-border: rgba(255,255,255,0.06);
            --sidebar-hover: rgba(255,255,255,0.08);
            --sidebar-active-bg: rgba(255,255,255,0.1);
            --sidebar-active-text: #ffffff;

            --card-bg: var(--surface);
            --shadow: 0 12px 28px rgba(15,23,42,0.1);
            --shadow-lg: 0 30px 70px rgba(15,23,42,0.16);
            --glow-soft: 0 18px 60px rgba(29,78,216,0.12);
            --panel-highlight: rgba(255,255,255,0.82);

            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 22px;
            --auth-accent: #00E5FF;
            --auth-accent-fg: #08323a;
            --auth-accent-bg: rgba(0,229,255,0.10);
            --header-auth-bg: #f1b40b; /* authenticated topbar header accent (gold) */
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root, body, .card, .topbar, .sidebar, .nav-item, .btn { transition: background-color 0.35s ease, color 0.35s ease, border-color 0.35s ease, box-shadow 0.35s ease; }
        body {
            font-family: var(--font-sans);
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            inset: -20% -10% 0 -10%;
            background:
                radial-gradient(55% 35% at 10% 0%, rgba(29,78,216,0.10) 0%, transparent 60%),
                radial-gradient(40% 30% at 90% 10%, rgba(14,165,164,0.10) 0%, transparent 55%),
                radial-gradient(35% 30% at 50% 90%, rgba(255,122,26,0.14) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
            opacity: 0.85;
        }
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background:
                linear-gradient(120deg, rgba(29,78,216,0.03) 0%, rgba(14,165,164,0.03) 50%, rgba(255,122,26,0.04) 100%),
                repeating-linear-gradient(0deg, rgba(15,23,42,0.02) 0px, rgba(15,23,42,0.02) 1px, transparent 1px, transparent 88px);
            pointer-events: none;
            z-index: 0;
        }
        ::selection { background: rgba(29,78,216,0.2); color: #0f172a; }
        :focus-visible { outline: 3px solid rgba(29,78,216,0.35); outline-offset: 3px; border-radius: 8px; }

        /* ========== SIDEBAR ========== */
        .sidebar {
            position: fixed; left: 0; top: 0; bottom: 0;
            width: 260px; background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            z-index: 1000; overflow-y: auto;
            transition: transform 0.3s ease;
            box-shadow: 12px 0 30px rgba(8,15,30,0.35);
        }
        .sidebar-brand {
            padding: 18px 20px;
            border-bottom: 1px solid var(--sidebar-border);
            display: flex; align-items: center; gap: 12px;
        }
        .sidebar-brand .brand-wrap {
            width: 220px; height: 64px; display:flex; align-items:center; justify-content:flex-start;
            padding:0; background:transparent; border-radius:12px; overflow:hidden;
        }
        .sidebar-brand .brand-wrap img.brand-logo {
            max-width: 220px; max-height: 64px; width: auto; height: auto; object-fit:contain; display:block;
        }
        .sidebar { scrollbar-width: thin; }
        .sidebar::-webkit-scrollbar { width: 10px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.18); border-radius: 8px; }
        .sidebar-brand .brand-icon {
            width: 42px; height: 42px; border-radius: 14px;
            background: linear-gradient(135deg, rgba(29,78,216,0.9), rgba(249,115,22,0.9));
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; color: white; font-weight: 800;
        }
        .sidebar-brand h2 {
            font-size: 18px; font-weight: 800;
            font-family: var(--font-display);
            color: #f8fafc;
        }
        .sidebar-brand span { font-size: 11px; color: var(--sidebar-muted); display: block; }
        .sidebar-nav { padding: 14px 0; }
        .nav-section {
            padding: 10px 20px 6px; font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1.4px; color: var(--sidebar-muted);
        }
        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px; margin: 4px 14px; color: var(--sidebar-muted);
            text-decoration: none; font-size: 14px; font-weight: 600;
            transition: all 0.2s ease; border-left: 0; border-radius: 12px; position: relative;
        }
        .nav-item:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text);
        }
        .nav-item.active {
            background: var(--sidebar-active-bg);
            color: var(--sidebar-active-text);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 8px; top: 10px; bottom: 10px;
            width: 4px; border-radius: 8px;
            background: linear-gradient(180deg, #1d4ed8, #f97316);
        }
        .nav-item i { width: 20px; text-align: center; font-size: 15px; }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            margin-left: 260px; min-height: 100vh;
            background: transparent;
            position: relative;
            z-index: 2;
        }
        .topbar {
            position: sticky; top: 0; z-index: 999;
            background: var(--header-bg, rgb(248, 212, 13));
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border-color);
            padding: 0 30px; height: 72px;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 8px 24px rgba(15,23,42,0.08);
        }

        /* When authenticated, use the authenticated header accent */
        body.authenticated .topbar {
            background: var(--header-auth-bg);
            color: var(--text-primary);
            border-bottom-color: rgba(0,0,0,0.06);
        }

        /* Dark theme variant for authenticated header */
        body.dark-theme.authenticated .topbar {
            --header-auth-bg: #b37a00;
            background: var(--header-auth-bg);
            color: var(--text-primary);
            border-bottom-color: rgba(255,255,255,0.04);
        }
        .topbar h1 { font-size: 20px; font-weight: 700; color: var(--text-primary); font-family: var(--font-display); }
        .topbar-right { display: flex; align-items: center; gap: 16px; }
        .topbar-search {
            display: flex; align-items: center; gap: 8px;
            padding: 6px 12px; border-radius: 999px;
            background: var(--surface); border: 1px solid var(--border-color);
            min-width: 220px;
        }
        .topbar-search i { color: var(--text-muted); font-size: 13px; }
        .topbar-search input {
            border: none; outline: none; background: transparent; font-size: 13px; width: 100%;
            color: var(--text-primary); font-family: var(--font-sans);
        }
        .topbar-user {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 6px 12px; border-radius: 999px;
            background: rgba(29,78,216,0.08); cursor: pointer;
            border: 1px solid rgba(29,78,216,0.12);
            box-shadow: 0 6px 16px rgba(15,23,42,0.08);
        }
        .topbar-user .avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: linear-gradient(135deg,#1d4ed8,#f97316);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 12px; color: white;
            box-shadow: 0 6px 16px rgba(15,23,42,0.16);
        }
        .topbar-user small { font-size: 11px; color: var(--text-muted); display: block; }

        .page-content {
            padding: 34px 32px 48px;
            max-width: 1380px;
            margin: 0 auto;
            position: relative;
        }

        .page-hero {
            position: relative;
            display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: space-between;
            background:
                radial-gradient(circle at top right, rgba(255,122,26,0.16), transparent 30%),
                radial-gradient(circle at bottom left, rgba(29,78,216,0.14), transparent 34%),
                linear-gradient(120deg, rgba(239, 190, 14, 0.97), rgba(248,250,252,0.92));
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 28px 28px;
            box-shadow: var(--shadow), var(--glow-soft);
            margin-bottom: 26px;
            overflow: hidden;
            isolation: isolate;
        }
        .page-hero::before,
        .page-hero::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            z-index: -1;
        }
        .page-hero::before {
            width: 220px;
            height: 220px;
            right: -60px;
            top: -90px;
            background: radial-gradient(circle, rgba(255,122,26,0.18), transparent 68%);
        }
        .page-hero::after {
            width: 260px;
            height: 260px;
            left: -120px;
            bottom: -160px;
            background: radial-gradient(circle, rgba(29,78,216,0.16), transparent 70%);
        }
        .page-hero h2 {
            font-family: var(--font-display);
            font-size: clamp(28px, 3vw, 38px);
            margin-bottom: 8px;
            letter-spacing: -0.03em;
        }
        .page-hero p {
            color: var(--text-muted);
            font-size: 14px;
            max-width: 600px;
            line-height: 1.7;
        }
        .page-hero .page-kicker {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.4px;
            color: var(--primary-dark); background: rgba(29,78,216,0.1);
            padding: 8px 14px; border-radius: 999px; margin-bottom: 10px;
            border: 1px solid rgba(29,78,216,0.08);
        }
        /* Authenticated accent (shared) - make pill a solid cyan swatch like image */
        body.authenticated .page-hero .page-kicker {
            color: #001f26; /* dark foreground for contrast */
            background: var(--auth-accent);
            background-color: var(--auth-accent);
            padding: 8px 16px; border-radius: 999px; margin-bottom: 10px;
            border: none; box-shadow: 0 6px 18px rgba(0, 255, 247, 0.61) inset, 0 2px 10px rgba(0,0,0,0.05);
            color: white;
            font-weight: 800;
            letter-spacing: 1.6px;
        }

        /* Authenticated hero card */
        body.authenticated .page-hero {
            background: linear-gradient(120deg, rgba(146, 233, 249, 0.98), rgba(196, 240, 126, 0.95));
            border: 1px solid rgba(90, 183, 241, 0.89);
            box-shadow: 0 26px 54px rgba(15,23,42,0.06), 0 10px 40px rgba(0,229,255,0.06);
        }

        /* Dark theme authenticated variants */
        body.dark-theme.authenticated {
            --auth-accent: #5eeaeab7;
            --auth-accent-fg: #43f2fb;
            --auth-accent-bg: rgba(88, 185, 234, 0.82);
        }

        body.dark-theme.authenticated .page-hero {
            background: linear-gradient(120deg, rgba(0,40,50,0.92), rgba(0,60,70,0.86));
            border: 1px solid rgba(238, 255, 0, 0.64);
            box-shadow: 0 26px 54px rgba(0,0,0,0.35), 0 10px 40px rgba(0,229,255,0.04);
        }
        .page-hero-actions {
            display: flex; gap: 10px; flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            padding: 10px;
            border-radius: 18px;
            background: rgba(4, 201, 145, 0.56);
            border: 1px solid rgba(255,255,255,0.65);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.65);
        }

        /* ========== STAT CARDS ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 22px; margin-bottom: 32px;
        }
        .stat-card {
            --pointer-x: 50%;
            --pointer-y: 50%;
            background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(248,250,252,0.9));
            border: 1px solid var(--border-color);
            border-radius: 20px; padding: 24px;
            position: relative; overflow: hidden;
            transition: transform 0.28s cubic-bezier(.2,.9,.2,1), box-shadow 0.28s ease, opacity 0.6s ease;
            opacity: 0;
            transform: translateY(16px) scale(0.98);
            box-shadow: var(--shadow);
        }
        .stat-card.in-view {
            opacity: 1;
            transform: translateY(0) scale(1);
            animation: floatCard 7s ease-in-out infinite;
        }
        .stat-card::before {
            content: ''; position: absolute; inset: 0; opacity: 0.08;
            background:
                radial-gradient(circle at var(--pointer-x) var(--pointer-y), rgba(255,122,26,0.16), transparent 28%),
                radial-gradient(circle, rgba(148,163,184,0.28) 1px, transparent 1px);
            background-size: auto, 12px 12px;
            pointer-events: none;
            transition: opacity 0.28s ease, background 0.28s ease;
        }
        .stat-card::after {
            content: ''; position: absolute; left: 0; top: 0; height: 3px; width: 100%;
            background: linear-gradient(90deg, #ff9a4d, var(--accent));
            transition: height 0.24s ease, opacity 0.24s ease;
        }
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow:
                0 26px 54px rgba(15, 23, 42, 0.18),
                0 0 0 1px rgba(255,122,26,0.12);
        }
        .stat-card:hover::before { opacity: 0.18; }
        .stat-card:hover::after { height: 5px; }
        .stat-card .stat-icon {
            width: 56px; height: 56px; border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; margin-bottom: 18px; background: rgba(29,78,216,0.12); color: var(--primary);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.65);
            transition: transform 0.24s ease, box-shadow 0.24s ease, background 0.24s ease;
        }
        .stat-card .stat-icon i { color: inherit !important; }
        .stat-card.blue .stat-icon { background: rgba(14,165,164,0.12); color: var(--secondary); }
        .stat-card.green .stat-icon { background: rgba(22,163,74,0.12); color: var(--success); }
        .stat-card.amber .stat-icon { background: rgba(249,115,22,0.14); color: var(--accent); }
        .stat-card .stat-value { font-size: 30px; font-weight: 800; margin-bottom: 6px; letter-spacing: -0.03em; }
        .stat-card .stat-label { font-size: 13px; color: var(--text-muted); font-weight: 600; line-height: 1.5; }
        .stat-card:hover .stat-icon {
            transform: translateY(-4px) scale(1.06);
            box-shadow: 0 16px 28px rgba(37, 99, 235, 0.18);
        }
        .stat-card:hover .stat-value { transform: translateY(-2px); }
        .stat-card:hover .stat-label { color: var(--text-primary); }

        /* ========== CARDS ========== */
        .card {
            --pointer-x: 50%;
            --pointer-y: 50%;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(249,250,251,0.94));
            border: 1px solid var(--border-color);
            border-radius: 22px; overflow: hidden;
            margin-bottom: 24px;
            box-shadow: var(--shadow);
            position: relative;
            opacity: 0;
            transform: translateY(14px);
            transition: transform 0.4s ease, opacity 0.4s ease, box-shadow 0.28s ease;
        }
        .card.in-view {
            opacity: 1;
            transform: translateY(0);
        }
        .card:hover {
            transform: translateY(-6px);
            box-shadow:
                0 28px 58px rgba(15,23,42,0.16),
                0 0 0 1px rgba(29,78,216,0.08);
        }
        .card::before {
            content: '';
            position: absolute; inset: 0;
            border-radius: inherit;
            border: 1px solid rgba(29,78,216,0.08);
            pointer-events: none;
            transition: border-color 0.24s ease, opacity 0.24s ease;
        }
        .card::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at var(--pointer-x) var(--pointer-y), rgba(29,78,216,0.10), transparent 26%),
                radial-gradient(circle at top left, rgba(29,78,216,0.07), transparent 68%);
            pointer-events: none;
            opacity: 0.9;
            transition: opacity 0.24s ease, background 0.24s ease;
        }
        .card:hover::before { border-color: rgba(255,122,26,0.14); }
        .card:hover::after { opacity: 1; }
        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; justify-content: space-between;
            background: linear-gradient(180deg, var(--surface-alt), var(--surface));
        }
        .card-header i { color: var(--primary) !important; }
        .card-header h3 { font-size: 16px; font-weight: 700; letter-spacing: -0.02em; }
        .card-body { padding: 24px; position: relative; z-index: 1; }
        .card-header h3,
        .card-body,
        .card-header .btn { transition: transform 0.24s ease, color 0.24s ease; }
        .card:hover .card-header h3 { transform: translateX(2px); }
        .card:hover .card-body { transform: translateY(-1px); }

        /* ========== TABLE ========== */
        .table-responsive {
            overflow-x: auto;
            border-radius: 18px;
            border: 1px solid var(--border-color);
            background: var(--surface);
        }
        table {
            width: 100%; border-collapse: collapse;
        }
        table th {
            padding: 14px 18px; text-align: left;
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.7px; color: var(--text-muted);
            border-bottom: 1px solid var(--border-color);
            background: var(--surface-alt);
        }
        table td {
            padding: 14px 18px; font-size: 13px;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-secondary);
        }
        table tbody tr:nth-child(odd) td { background: rgba(248,250,252,0.72); }
        table tr:hover td { background: rgba(255,122,26,0.06); }

        /* ========== BADGES ========== */
        .badge {
            display: inline-flex; align-items: center;
            padding: 5px 10px; border-radius: 999px;
            font-size: 11px; font-weight: 700;
            border: 1px solid transparent;
        }
        .badge-success { background: rgba(22,163,74,0.12); color: #166534; border-color: rgba(22,163,74,0.12); }
        .badge-danger { background: rgba(220,38,38,0.12); color: #b91c1c; border-color: rgba(220,38,38,0.12); }
        .badge-warning { background: rgba(245,158,11,0.16); color: #92400e; border-color: rgba(245,158,11,0.14); }
        .badge-info { background: rgba(14,165,164,0.14); color: #0f766e; border-color: rgba(14,165,164,0.12); }
        .badge-primary { background: rgba(29,78,216,0.14); color: #1e40af; border-color: rgba(29,78,216,0.12); }

        /* ========== BUTTONS ========== */
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px; border-radius: 12px;
            font-size: 14px; font-weight: 700;
            border: none; cursor: pointer;
            transition: all 0.2s ease; text-decoration: none;
            position: relative; overflow: hidden;
        }
        .btn-primary {
            background: linear-gradient(90deg, var(--primary), var(--accent)); color: white;
            box-shadow: 0 10px 26px rgba(29,78,216,0.2);
        }
        .btn-primary::before,
        .btn-secondary::before {
            content: '';
            position: absolute;
            inset: 0;
            transform: translateX(-110%);
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.28), transparent);
            transition: transform 0.45s ease;
        }
        .btn:hover::before { transform: translateX(110%); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 18px 44px rgba(29,78,216,0.26); }
        .btn-success { background: linear-gradient(135deg, #16a34a, #22c55e); color: white; }
        .btn-danger { background: linear-gradient(135deg, #dc2626, #ef4444); color: white; }
        .btn-secondary { background: var(--surface-alt); color: var(--text-primary); border: 1px solid var(--border-color); box-shadow: inset 0 1px 0 rgba(255,255,255,0.55); }
        .btn-sm { padding: 6px 14px; font-size: 12px; border-radius: 10px; }
        .btn-sm:hover { transform: translateY(-1px); }

        /* ========== FORMS ========== */
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; margin-bottom: 8px;
            font-size: 13px; font-weight: 700; color: var(--text-secondary);
            letter-spacing: 0.01em;
        }
        .form-control {
            width: 100%; min-height: 48px; padding: 12px 16px;
            background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(248,250,252,0.96));
            border: 1px solid var(--border-color);
            border-radius: 12px; color: var(--text-primary);
            font-size: 14px; font-family: var(--font-sans);
            transition: box-shadow 0.25s ease, border-color 0.25s ease, transform 0.12s ease, background 0.25s ease;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.72);
        }
        .form-control:focus {
            outline: none; border-color: rgba(29,78,216,0.6);
            box-shadow: 0 0 0 4px rgba(29,78,216,0.12), 0 16px 36px rgba(29,78,216,0.08);
            transform: translateY(-1px);
        }
        .form-control::placeholder { color: #98a2b3; }
        select.form-control { cursor: pointer; }
        textarea.form-control { min-height: 110px; resize: vertical; }
        input[type="file"].form-control { padding: 10px 12px; }
        small { color: var(--text-muted); font-size: 12px; line-height: 1.5; }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        /* ========== ALERTS ========== */
        .alert {
            padding: 14px 20px; border-radius: 12px;
            margin-bottom: 20px; font-size: 14px;
            display: flex; align-items: center; gap: 10px;
            border: 1px solid transparent;
            animation: slideDown 0.3s ease;
            box-shadow: 0 10px 26px rgba(15,23,42,0.06);
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success {
            background: rgba(22,163,74,0.12);
            border-color: rgba(22,163,74,0.3);
            color: #166534;
        }
        .alert-danger, .alert-error {
            background: rgba(220,38,38,0.12);
            border-color: rgba(220,38,38,0.3);
            color: #b91c1c;
        }
        .alert-warning {
            background: rgba(245,158,11,0.12);
            border-color: rgba(245,158,11,0.3);
            color: #92400e;
        }

        /* ========== PAGINATION ========== */
        .pagination-wrapper {
            padding: 16px 0;
            display: flex; justify-content: center;
        }
        .pagination-wrapper nav { display: flex; }
        .pagination-wrapper .flex { display: flex; gap: 4px; }
        .pagination-wrapper a, .pagination-wrapper span {
            padding: 8px 14px; border-radius: 10px;
            font-size: 13px; font-weight: 600;
            background: var(--surface-alt);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            text-decoration: none;
        }
        .pagination-wrapper a:hover {
            color: var(--text-primary);
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }
        .pagination-wrapper span[aria-current] {
            background: var(--primary); color: white; border-color: var(--primary);
        }

        /* ========== MOBILE ========== */
        .mobile-toggle {
            display: none; background: none; border: none;
            color: var(--text-primary); font-size: 22px; cursor: pointer;
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .mobile-toggle { display: block; }
            .stats-grid { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
            .topbar-search { display: none; }
            .page-content { padding: 22px 18px 32px; }
            .page-hero { padding: 22px 18px; }
            .page-hero-actions { width: 100%; justify-content: flex-start; }
        }

        /* ========== MISC ========== */
        .empty-state {
            text-align: center; padding: 60px 20px;
            color: var(--text-muted);
        }
        .empty-state i { font-size: 48px; margin-bottom: 16px; opacity: 0.3; }
        .empty-state p { font-size: 15px; }

        .card-body > form[method="GET"] {
            padding: 14px;
            border-radius: 16px;
            background: rgba(248,250,252,0.88);
            border: 1px solid var(--border-color);
        }

        .modal-backdrop {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.6); z-index: 2000;
            display: none; align-items: center; justify-content: center;
        }
        .modal-backdrop.show { display: flex; }
        .modal-content {
            background: var(--surface); border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
            width: 90%; max-width: 500px; padding: 30px;
            box-shadow: var(--shadow-lg);
        }

        /* ========== THEME TOGGLE / MENU ========== */
        .theme-toggle-btn {
            background: transparent; border: none; color: var(--text-primary);
            width: 40px; height: 40px; border-radius: 10px; display:flex; align-items:center; justify-content:center;
            cursor: pointer; font-size: 16px;
        }
        .theme-menu {
            position: absolute; top: 70px; right: 30px; z-index: 2200;
            width: 220px; background: var(--surface); border-radius: 14px; padding: 12px;
            border: 1px solid var(--border-color); box-shadow: var(--shadow);
            display: none; user-select: none;
        }
        .theme-menu.show { display: block; }
        .theme-menu-inner { display:flex; flex-direction:column; gap:10px; }
        .theme-menu .option {
            display:flex; gap:12px; align-items:center; padding:10px; border-radius:12px; cursor:pointer;
        }
        .theme-menu .option:hover { background: rgba(29,78,216,0.06); }
        .theme-menu .option .option-pill {
            width: 56px; height: 36px; border-radius: 999px; display:flex; align-items:center; justify-content:center;
            background: rgba(29,78,216,0.1); color: var(--primary);
        }
        .theme-menu .option .option-title { font-size:16px; font-weight:700; color: var(--text-primary); }
        .theme-menu .option.active { background: rgba(29,78,216,0.08); }
        /* User menu dropdown */
        .user-menu {
            position: absolute; top: 70px; right: 16px; z-index: 2400;
            width: 260px; background: var(--surface); color: var(--text-primary); border-radius: 14px; padding: 10px; display:none;
            box-shadow: var(--shadow); border: 1px solid var(--border-color);
        }
        .user-menu.show { display:block; }
        .user-card { display:flex; align-items:center; padding:12px; border-bottom:1px solid var(--border-color); }
        .user-name { font-weight:800; font-size:15px; color: var(--text-primary); }
        .user-email { font-size:13px; color: var(--text-muted); }
        .user-menu-list { display:flex; flex-direction:column; gap:6px; padding:10px; }
        .user-menu-item { display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:10px; color: var(--text-secondary); text-decoration:none; background:transparent; border:none; text-align:left; cursor:pointer; }
        .user-menu-item:hover { background: rgba(29,78,216,0.06); color: var(--text-primary); }
        .user-menu-item i { width:18px; text-align:center; color: var(--primary); }
        .user-menu-item.signout { width:100%; background:transparent; border:none; font-weight:700; color: var(--danger); }

        /* ========== DARK THEME ========== */
        body.dark-theme {
            --bg: #151515;
            --bg-soft: #1c1c1c;
            --surface: #202020;
            --surface-alt: #262626;
            --header-bg: #1E293B;
            --text-primary: #F8FAFC;
            --text-secondary: #d3d7df;
            --text-muted: #98a2b3;
            --border-color: #32353b;
            --card-bg: #1f1f1f;
            --shadow: 0 14px 32px rgba(0,0,0,0.35);
            --shadow-lg: 0 30px 70px rgba(0,0,0,0.45);
            --sidebar-bg: linear-gradient(180deg,#0b1220,#0b1b2b);
            --sidebar-text: #e2e8f0;
            --sidebar-muted: rgba(226,232,240,0.7);
            --sidebar-border: rgba(255,255,255,0.06);
            --sidebar-hover: rgba(255,255,255,0.08);
            --sidebar-active-bg: rgba(255,255,255,0.1);
            --sidebar-active-text: #ffffff;
        }
        body.dark-theme::before { opacity: 0.38; }
        body.dark-theme .topbar { background: var(--header-bg) !important; border-bottom-color: var(--border-color); }
        body.dark-theme .sidebar { box-shadow: 12px 0 30px rgba(8,15,30,0.35); }
        body.dark-theme .topbar-search { background: rgba(15,23,42,0.7); border-color: var(--border-color); }
        body.dark-theme .topbar-search input { color: var(--text-primary); }
        body.dark-theme .page-hero { background: linear-gradient(120deg, rgba(36,36,36,0.96), rgba(27,27,27,0.92)); }
        body.dark-theme .page-hero-actions { background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.06); box-shadow: none; }
        body.dark-theme .stat-card {
            background: linear-gradient(180deg, rgba(30,30,31,0.98), rgba(24,24,26,0.98));
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        }
        body.dark-theme .card {
            background: linear-gradient(180deg, rgba(31,31,31,0.98), rgba(24,24,24,0.98));
        }
        body.dark-theme .stat-card:hover {
            box-shadow:
                0 28px 60px rgba(0,0,0,0.30),
                0 0 0 1px rgba(255,122,26,0.12);
        }
        body.dark-theme .card:hover {
            box-shadow:
                0 30px 64px rgba(0,0,0,0.34),
                0 0 0 1px rgba(255,122,26,0.08);
        }
        body.dark-theme .table-responsive { background: rgba(255,255,255,0.01); }
        body.dark-theme .form-control {
            background: linear-gradient(180deg, rgba(36,36,36,0.96), rgba(29,29,29,0.96));
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.03);
        }
        body.dark-theme .form-control::placeholder { color: #667085; }
        body.dark-theme .card-body > form[method="GET"] {
            background: rgba(255,255,255,0.02);
            border-color: rgba(255,255,255,0.06);
        }
        body.dark-theme .topbar-user { background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.08); }
        body.dark-theme .theme-menu,
        body.dark-theme .user-menu { background: #202020; border-color: rgba(148,163,184,0.14); }
        body.dark-theme table th { background: rgba(255,255,255,0.03); }
        body.dark-theme table tbody tr:nth-child(odd) td { background: rgba(255,255,255,0.015); }
        body.dark-theme table tr:hover td { background: rgba(255,255,255,0.04); }

        /* ========== MOTION + DYNAMICS ========== */
        .animate-on-scroll { opacity: 0; transform: translateY(8px); transition: opacity 0.6s ease, transform 0.6s cubic-bezier(.2,.9,.2,1); }
        .animate-on-scroll.in-view { opacity: 1; transform: translateY(0); }

        .stat-card { transform-origin: center top; will-change: transform, box-shadow; }
        .stat-card .stat-value { transition: transform 0.7s cubic-bezier(.2,.9,.2,1), color 0.3s; display:inline-block; }
        .stat-card:hover { transform: translateY(-8px) scale(1.01); box-shadow: var(--shadow-lg); }

        .badge { transition: transform 0.18s ease, opacity 0.18s ease; }
        .badge:hover { transform: translateY(-4px); }

        table tr { transition: background 0.18s ease, transform 0.18s ease; }
        table tr:hover { transform: translateY(-3px); }

        @keyframes floatPulse { 0% { transform: translateY(0); } 50% { transform: translateY(-6px); } 100% { transform: translateY(0); } }
        .empty-state i { animation: floatPulse 3.6s ease-in-out infinite; }
        @keyframes floatCard {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-6px) scale(1); }
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .stats-grid .stat-card:nth-child(1) { animation-delay: 0.2s; }
        .stats-grid .stat-card:nth-child(2) { animation-delay: 0.35s; }
        .stats-grid .stat-card:nth-child(3) { animation-delay: 0.5s; }
        .stats-grid .stat-card:nth-child(4) { animation-delay: 0.65s; }

        @media (prefers-reduced-motion: reduce) {
            .stat-card, .card { animation: none !important; transition: none !important; }
        }

        /* dynamic-card: unified animated card for dashboards */
        .dynamic-card {
            opacity: 0; transform: translateY(14px) scale(.998); transition: transform 420ms cubic-bezier(.2,.9,.2,1), opacity 420ms ease, box-shadow 260ms ease; will-change: transform, opacity;
        }
        .dynamic-card.in-view { opacity: 1; transform: translateY(0) scale(1); }
        .dynamic-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: var(--shadow-lg); border-color: rgba(29,78,216,0.12); }
        .dynamic-card .card-accent { position:absolute; left:0; top:0; bottom:0; width:6px; border-top-left-radius:inherit; border-bottom-left-radius:inherit; background: linear-gradient(180deg, rgba(124,58,237,1), rgba(6,182,212,1)); }


        .skeleton { background: linear-gradient(90deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.06) 100%); background-size: 200% 100%; animation: shimmer 1.6s linear infinite; border-radius:6px; }
        @keyframes shimmer { 0% { background-position: 200% 0 } 100% { background-position: -200% 0 } }

        @media (max-width: 1100px) {
            .sidebar { width: 240px; }
            .main-content { margin-left: 240px; }
        }
</style>
    @yield('styles')
</head>
<body class="@auth authenticated @endauth">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
                <div class="brand-wrap">
                <img src="{{ asset('assets/logo.jpeg') }}" alt="Brand" class="brand-logo" decoding="async" onerror="this.style.display='none'" />
            </div>
            <!-- Sidebar text removed to show only logo -->
        </div>
        <nav class="sidebar-nav">
            @auth
                @if(auth()->user()->isAdmin())
                    <div class="nav-section">Dashboard</div>
                    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>

                    <div class="nav-section">User Management</div>
                    <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}"><i class="fas fa-users"></i> Manage Users</a>
                    <a href="{{ route('admin.kyc') }}" class="nav-item {{ request()->routeIs('admin.kyc*') ? 'active' : '' }}"><i class="fas fa-id-card"></i> KYC Documents</a>

                    <div class="nav-section">Financial</div>
                    <a href="{{ route('admin.add_funds') }}" class="nav-item {{ request()->routeIs('admin.add_funds*') ? 'active' : '' }}"><i class="fas fa-wallet"></i> Add Funds</a>
                    <a href="{{ route('wallet.index') }}" class="nav-item {{ request()->routeIs('wallet.index') ? 'active' : '' }}"><i class="fas fa-credit-card"></i> Wallet</a>
                    <a href="{{ route('admin.settlements') }}" class="nav-item {{ request()->routeIs('admin.settlements*') ? 'active' : '' }}"><i class="fas fa-money-check"></i> Settlements</a>
                    <a href="{{ route('admin.commission_reports') }}" class="nav-item {{ request()->routeIs('admin.commission_reports*') ? 'active' : '' }}"><i class="fas fa-chart-bar"></i> Commissions</a>
                    <a href="{{ route('admin.reversals') }}" class="nav-item {{ request()->routeIs('admin.reversals*') ? 'active' : '' }}"><i class="fas fa-undo"></i> Reversals</a>

                    <div class="nav-section">System</div>
                    <a href="{{ route('admin.banks') }}" class="nav-item {{ request()->routeIs('admin.banks*') ? 'active' : '' }}"><i class="fas fa-university"></i> Banks</a>
                    <a href="{{ route('admin.api_providers') }}" class="nav-item {{ request()->routeIs('admin.api_providers*') ? 'active' : '' }}"><i class="fas fa-plug"></i> API Providers</a>
                    <a href="{{ route('admin.service_charges') }}" class="nav-item {{ request()->routeIs('admin.service_charges*') ? 'active' : '' }}"><i class="fas fa-receipt"></i> Service Charges</a>
                    <a href="{{ route('admin.device_mappings') }}" class="nav-item {{ request()->routeIs('admin.device_mappings*') ? 'active' : '' }}"><i class="fas fa-fingerprint"></i> Devices</a>
                    <a href="{{ route('admin.support_tickets') }}" class="nav-item {{ request()->routeIs('admin.support_tickets*') ? 'active' : '' }}"><i class="fas fa-ticket-alt"></i> Support Tickets</a>
                    <a href="{{ route('admin.general_requests') }}" class="nav-item {{ request()->routeIs('admin.general_requests*') ? 'active' : '' }}"><i class="fas fa-envelope"></i> View General Requests</a>

                    <div class="nav-section">Logs</div>
                    <a href="{{ route('admin.logs.login') }}" class="nav-item {{ request()->routeIs('admin.logs.login') ? 'active' : '' }}"><i class="fas fa-sign-in-alt"></i> Login Logs</a>
                    <a href="{{ route('admin.logs.audit') }}" class="nav-item {{ request()->routeIs('admin.logs.audit') ? 'active' : '' }}"><i class="fas fa-clipboard-list"></i> Audit Logs</a>
                    <a href="{{ route('admin.logs.transaction') }}" class="nav-item {{ request()->routeIs('admin.logs.transaction') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i> Transaction Logs</a>
                    <a href="{{ route('admin.logs.activity') }}" class="nav-item {{ request()->routeIs('admin.logs.activity') ? 'active' : '' }}"><i class="fas fa-history"></i> Activity Logs</a>
                    <a href="{{ route('admin.logs.api') }}" class="nav-item {{ request()->routeIs('admin.logs.api') ? 'active' : '' }}"><i class="fas fa-code"></i> API Logs</a>

                @elseif(auth()->user()->isDistributor())
                    <div class="nav-section">Dashboard</div>
                    <a href="{{ route('distributor.dashboard') }}" class="nav-item {{ request()->routeIs('distributor.dashboard') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>

                    <div class="nav-section">User Management</div>
                    <a href="{{ route('distributor.retailers.create') }}" class="nav-item {{ request()->routeIs('distributor.retailers*') ? 'active' : '' }}"><i class="fas fa-user-plus"></i> Create Retailer</a>

                    <div class="nav-section">Financial</div>
                    <a href="{{ route('wallet.index') }}" class="nav-item {{ request()->routeIs('wallet.index') ? 'active' : '' }}"><i class="fas fa-wallet"></i> Wallet</a>
                    <a href="{{ route('distributor.add_funds') }}" class="nav-item {{ request()->routeIs('distributor.add_funds*') ? 'active' : '' }}"><i class="fas fa-paper-plane"></i> Add Funds</a>
                    <a href="{{ route('reports.commissions') }}" class="nav-item {{ request()->routeIs('reports.commissions') ? 'active' : '' }}"><i class="fas fa-chart-bar"></i> Commissions</a>
                    <a href="{{ route('reports.settlements') }}" class="nav-item {{ request()->routeIs('reports.settlements') ? 'active' : '' }}"><i class="fas fa-money-check"></i> Settlements</a>

                    <div class="nav-section">Support</div>
                    <a href="{{ route('support.index') }}" class="nav-item {{ request()->routeIs('support.*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Support</a>

                @elseif(auth()->user()->isRetailer())
                    <div class="nav-section">Dashboard</div>
                    <a href="{{ route('retailer.dashboard') }}" class="nav-item {{ request()->routeIs('retailer.dashboard') ? 'active' : '' }}"><i class="fas fa-chart-pie"></i> Dashboard</a>

                    <div class="nav-section">AEPS Services</div>
                    <a href="{{ route('retailer.aeps.cash_withdrawal') }}" class="nav-item {{ request()->routeIs('retailer.aeps.cash_withdrawal*') ? 'active' : '' }}"><i class="fas fa-money-bill-wave"></i> Cash Withdrawal</a>
                    <a href="{{ route('retailer.aeps.balance_enquiry') }}" class="nav-item {{ request()->routeIs('retailer.aeps.balance_enquiry*') ? 'active' : '' }}"><i class="fas fa-search-dollar"></i> Balance Enquiry</a>
                    <a href="{{ route('retailer.aeps.mini_statement') }}" class="nav-item {{ request()->routeIs('retailer.aeps.mini_statement*') ? 'active' : '' }}"><i class="fas fa-list-alt"></i> Mini Statement</a>
                    <a href="{{ route('retailer.aeps.transactions') }}" class="nav-item {{ request()->routeIs('retailer.aeps.transactions') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i> Transactions</a>

                    <div class="nav-section">Services</div>
                    <a href="{{ route('retailer.bill_payments') }}" class="nav-item {{ request()->routeIs('retailer.bill_payments*') ? 'active' : '' }}"><i class="fas fa-file-invoice-dollar"></i> Bill Payments</a>
                    <a href="{{ route('wallet.index') }}" class="nav-item {{ request()->routeIs('wallet.index') ? 'active' : '' }}"><i class="fas fa-wallet"></i> Wallet</a>
                    <a href="{{ route('reports.commissions') }}" class="nav-item {{ request()->routeIs('reports.commissions') ? 'active' : '' }}"><i class="fas fa-chart-bar"></i> Commissions</a>
                    <a href="{{ route('reports.settlements') }}" class="nav-item {{ request()->routeIs('reports.settlements') ? 'active' : '' }}"><i class="fas fa-money-check"></i> Settlements</a>

                    <div class="nav-section">Support</div>
                    <a href="{{ route('support.index') }}" class="nav-item {{ request()->routeIs('support.*') ? 'active' : '' }}"><i class="fas fa-life-ring"></i> Support</a>
                @endif

                <div class="nav-section">Account</div>
                <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"><i class="fas fa-user-cog"></i> Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="nav-item" style="width:100%;border:0;background:none;cursor:pointer;text-align:left;font-family:inherit;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            @endauth
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:16px;">
                <button class="mobile-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 style="margin:0 0 0 8px;">@yield('page_title', 'Dashboard')</h1>
            </div>
            <div class="topbar-right" style="position:relative;">
                @auth
                <div class="topbar-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="text" placeholder="Search transactions, users..." aria-label="Search">
                </div>
                <button id="themeToggleBtn" class="theme-toggle-btn" aria-haspopup="true" aria-expanded="false" title="Theme">
                    <i id="themeIcon" class="fas fa-moon"></i>
                </button>
                <div id="themeMenu" class="theme-menu" role="menu" aria-label="Theme">
                    <div class="theme-menu-inner">
                        <div class="option" data-theme="light" role="menuitem">
                            <div class="option-pill"><i class="fas fa-sun"></i></div>
                            <div class="option-title">Light</div>
                        </div>
                        <div class="option" data-theme="dark" role="menuitem">
                            <div class="option-pill"><i class="fas fa-moon"></i></div>
                            <div class="option-title">Dark</div>
                        </div>
                        <div class="option" data-theme="auto" role="menuitem">
                            <div class="option-pill"><i class="fas fa-adjust"></i></div>
                            <div class="option-title">Auto</div>
                        </div>
                    </div>
                </div>
                <div style="width:10px"></div>
                <div class="topbar-user" id="topbarUser" aria-haspopup="true" aria-expanded="false" tabindex="0">
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div>
                        <span>{{ auth()->user()->name }}</span>
                        <small>{{ ucfirst(auth()->user()->role) }}</small>
                    </div>
                </div>

                <div id="userMenu" class="user-menu" role="menu" aria-label="User menu">
                    <div class="user-card">
                        <div style="padding:8px 12px;">
                            <div class="user-name">{{ auth()->user()->name }}</div>
                            <div class="user-email">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <div class="user-menu-list">
                        <a href="{{ route('profile.edit') }}" class="user-menu-item"><i class="fas fa-user"></i> Profile</a>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0">
                            @csrf
                            <button type="submit" class="user-menu-item signout"><i class="fas fa-sign-out-alt"></i> Sign Out</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </header>

        <div class="page-content">
            <div class="page-hero animate-on-scroll">
                <div>
                    <div class="page-kicker"><i class="fas fa-bolt"></i> Workspace</div>
                    <h2>@yield('page_title', 'Dashboard')</h2>
                    <p>@yield('page_subtitle', 'Monitor activity, manage users, and keep operations running smoothly from one clean control center.')</p>
                </div>
                <div class="page-hero-actions">
                    @yield('page_actions')
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success animate-on-scroll"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger animate-on-scroll"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger animate-on-scroll">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-toggle');
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    </script>
    <script>
        (function() {
            const storageKey = 'aeps_theme';
            const btn = document.getElementById('themeToggleBtn');
            const menu = document.getElementById('themeMenu');
            const icon = document.getElementById('themeIcon');
            const options = menu ? Array.from(menu.querySelectorAll('.option')) : [];

            function setActiveOption(choice) {
                options.forEach(o => o.classList.toggle('active', o.getAttribute('data-theme') === choice));
            }

            function applyTheme(choice) {
                if (choice === 'light') {
                    document.body.classList.remove('dark-theme');
                    document.body.setAttribute('data-theme', 'light');
                    icon.className = 'fas fa-sun';
                } else if (choice === 'dark') {
                    document.body.classList.add('dark-theme');
                    document.body.setAttribute('data-theme', 'dark');
                    icon.className = 'fas fa-moon';
                } else { // auto
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    document.body.classList.toggle('dark-theme', prefersDark);
                    document.body.setAttribute('data-theme', prefersDark ? 'dark' : 'light');
                    icon.className = 'fas fa-adjust';
                }
                setActiveOption(choice);
                window.dispatchEvent(new CustomEvent('aeps:theme-changed', {
                    detail: {
                        choice: choice,
                        effectiveTheme: document.body.classList.contains('dark-theme') ? 'dark' : 'light'
                    }
                }));
            }

            function init() {
                let choice = localStorage.getItem(storageKey) || 'auto';
                if (choice === 'auto') {
                    // if not set, default to system
                    applyTheme('auto');
                } else {
                    applyTheme(choice);
                }

                // listen for system changes when in auto
                window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                    const cur = localStorage.getItem(storageKey) || 'auto';
                    if (cur === 'auto') applyTheme('auto');
                });
            }

            // Toggle menu
            document.addEventListener('click', function(e) {
                if (!btn) return;
                if (btn.contains(e.target)) {
                    const open = menu.classList.toggle('show');
                    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                    return;
                }
                if (menu && !menu.contains(e.target)) {
                    menu.classList.remove('show');
                    btn.setAttribute('aria-expanded', 'false');
                }
            });

            // Option clicks
            options.forEach(opt => {
                opt.addEventListener('click', function() {
                    const choice = this.getAttribute('data-theme');
                    localStorage.setItem(storageKey, choice);
                    applyTheme(choice);
                    if (menu) menu.classList.remove('show');
                    if (btn) btn.setAttribute('aria-expanded', 'false');
                });
            });

            // initialize
            init();
        })();
    </script>
    <script>
        // Topbar user menu toggle
        (function(){
            const userBtn = document.getElementById('topbarUser');
            const userMenu = document.getElementById('userMenu');
            function closeMenu(){ if(userMenu) userMenu.classList.remove('show'); if(userBtn) userBtn.setAttribute('aria-expanded','false'); }
            function toggle(){ if(!userMenu) return; const open = userMenu.classList.toggle('show'); userBtn.setAttribute('aria-expanded', open ? 'true' : 'false'); }
            document.addEventListener('click', function(e){
                if(!userBtn || !userMenu) return;
                if(userBtn.contains(e.target)) { toggle(); return; }
                if(!userMenu.contains(e.target)) closeMenu();
            });
            document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeMenu(); });
        })();
    </script>
        <script>
            // Lightweight tilt for .dynamic-card and reveal observer (if not already present)
            (function(){
                const cards = document.querySelectorAll('.dynamic-card');
                if(cards.length === 0) return;
                // reveal
                const obs = ('IntersectionObserver' in window) ? new IntersectionObserver((entries)=>{
                    entries.forEach(en=>{
                        if(en.isIntersecting){ en.target.classList.add('in-view'); obs.unobserve(en.target); }
                    });
                }, { threshold: 0.12 }) : null;
                cards.forEach(c=>{ if(obs) obs.observe(c); else c.classList.add('in-view'); });

                // tilt
                function bindTilt(el){
                    let raf=null;
                    el.addEventListener('mousemove', function(ev){
                        const r = el.getBoundingClientRect();
                        const cx = r.left + r.width/2; const cy = r.top + r.height/2;
                        const dx = (ev.clientX - cx)/(r.width/2); const dy = (ev.clientY - cy)/(r.height/2);
                        const rx = (-dy * 4).toFixed(2); const ry = (dx * 4).toFixed(2);
                        if(raf) cancelAnimationFrame(raf);
                        raf = requestAnimationFrame(()=> el.style.transform = `translateZ(0) rotateX(${rx}deg) rotateY(${ry}deg)`);
                    });
                    el.addEventListener('mouseleave', ()=> el.style.transform = '');
                }
                cards.forEach(bindTilt);
            })();
        </script>
    <script>
        // Animated counters and on-scroll reveal
        (function(){
            function animateNumber(el, to, decimals, formatter) {
                const start = 0;
                const duration = 900;
                const resolvedDecimals = Number.isFinite(decimals) ? decimals : 0;
                const resolvedFormatter = typeof formatter === 'function'
                    ? formatter
                    : function(value) { return new Intl.NumberFormat('en-IN').format(value); };
                let startTime = null;
                function step(ts){
                    if (!startTime) startTime = ts;
                    const progress = Math.min((ts - startTime) / duration, 1);
                    const current = (progress * (to - start)) + start;
                    const rounded = Number(current.toFixed(resolvedDecimals));
                    el.textContent = resolvedFormatter(rounded, progress >= 1);
                    if (progress < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }

            // animate stat values if they look numeric
            document.addEventListener('DOMContentLoaded', function(){
                const stats = document.querySelectorAll('.stat-card .stat-value');
                stats.forEach(el => {
                    const raw = el.textContent.replace(/[\s,₹]/g,'');
                    const num = parseInt(raw, 10);
                    if (!isNaN(num)) {
                        // store original text in data-target
                        el.setAttribute('data-target', num);
                        el.textContent = '0';
                        // delay slightly to stagger
                        setTimeout(()=> animateNumber(el, num), 300);
                    }
                });
            });

            // on-scroll reveal with staggered entrance
            const observer = new IntersectionObserver((entries)=>{
                entries.forEach(entry=>{
                    if(entry.isIntersecting){
                        // apply staggered delay for children where appropriate
                        const parent = entry.target;
                        const staggerItems = parent.querySelectorAll ? parent.querySelectorAll('.stat-card, .card, .table-responsive > *') : [];
                        if(staggerItems && staggerItems.length){
                            staggerItems.forEach((it, i)=>{
                                it.style.transitionDelay = (i * 80) + 'ms';
                                it.classList.add('in-view');
                            });
                        }
                        // fallback: reveal the element itself
                        parent.classList.add('in-view');
                        // clean up observer once revealed
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            document.addEventListener('DOMContentLoaded', function(){
                // observe explicit animate-on-scroll elements and common layout components
                const autoTargets = Array.from(document.querySelectorAll('.animate-on-scroll'))
                    .concat(Array.from(document.querySelectorAll('.stat-card')))
                    .concat(Array.from(document.querySelectorAll('.card')))
                    .concat(Array.from(document.querySelectorAll('.table-responsive')));
                // dedupe
                const uniq = Array.from(new Set(autoTargets));
                uniq.forEach(el=> observer.observe(el));
            });
        })();
    </script>
    <script>
        // Correct numeric stat counters using explicit data-number attributes
        (function(){
            function animateValue(el, target, decimals, prefix, suffix) {
                const duration = 950;
                let startedAt = null;
                function frame(ts) {
                    if (!startedAt) startedAt = ts;
                    const progress = Math.min((ts - startedAt) / duration, 1);
                    const current = Number((target * progress).toFixed(decimals));
                    const options = decimals > 0 && progress >= 1
                        ? { minimumFractionDigits: decimals, maximumFractionDigits: decimals }
                        : { maximumFractionDigits: decimals };
                    el.textContent = `${prefix}${new Intl.NumberFormat('en-IN', options).format(current)}${suffix}`;
                    if (progress < 1) requestAnimationFrame(frame);
                }
                requestAnimationFrame(frame);
            }

            document.addEventListener('DOMContentLoaded', function(){
                document.querySelectorAll('.stat-card .stat-value[data-number]').forEach((el, index) => {
                    const target = Number(el.dataset.number);
                    if (Number.isNaN(target)) return;
                    const decimals = Number(el.dataset.decimals || (String(el.dataset.number).includes('.') ? 2 : 0));
                    const prefix = el.dataset.prefix || '';
                    const suffix = el.dataset.suffix || '';
                    el.textContent = `${prefix}0${suffix}`;
                    setTimeout(() => animateValue(el, target, decimals, prefix, suffix), 180 + (index * 70));
                });
            });
        })();
    </script>
    <script>
        // Pointer-reactive card glow for a more tactile logged-in experience
        (function(){
            function bindInteractiveSurface(el) {
                el.addEventListener('mousemove', function(event) {
                    const rect = el.getBoundingClientRect();
                    const x = ((event.clientX - rect.left) / rect.width) * 100;
                    const y = ((event.clientY - rect.top) / rect.height) * 100;
                    el.style.setProperty('--pointer-x', `${x}%`);
                    el.style.setProperty('--pointer-y', `${y}%`);
                });

                el.addEventListener('mouseleave', function() {
                    el.style.setProperty('--pointer-x', '50%');
                    el.style.setProperty('--pointer-y', '50%');
                });
            }

            document.addEventListener('DOMContentLoaded', function(){
                document.querySelectorAll('.card, .stat-card').forEach(bindInteractiveSurface);
            });
        })();
    </script>
    @yield('scripts')
</body>
</html>
