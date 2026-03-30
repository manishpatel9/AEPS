<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RudraxPay — secure, professional, user-friendly fintech services for retailers.">
    <meta name="theme-color" content="#0f766e">
    <title>@yield('title', 'RudraxPay')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&family=Sora:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth2.css') }}">
</head>
<body>
    <div class="auth2-wrap">
        <main class="auth2-shell">
            <section class="auth2-side">
                @yield('side')
            </section>
            <section class="auth2-card">
                @yield('content')
            </section>
        </main>
    </div>

    <script>
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-toggle-password]');
            if (!btn) return;
            var sel = btn.getAttribute('data-toggle-password');
            var input = sel ? document.querySelector(sel) : null;
            if (!input) return;

            var shown = input.type === 'text';
            input.type = shown ? 'password' : 'text';
            btn.innerHTML = shown ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            btn.setAttribute('aria-label', shown ? 'Show password' : 'Hide password');
            input.focus();
        });
    </script>
    @stack('scripts')
</body>
</html>

