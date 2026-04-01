
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RudraxPay</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        /* Login-only overrides: keep login larger and more prominent */
        .auth-card{ max-width:520px !important; }
        .auth-card h2{ font-size:26px !important; }
    </style>
</head>
<body>
    <div class="auth-shell">
        <section class="auth-brand" style="padding:0;">
            <img src="{{ asset('assets/login.png') }}" alt="Login art" loading="lazy" decoding="async" fetchpriority="low" style="width:100%;max-height:720px;height:auto;min-height:360px;object-fit:contain;display:block;" onerror="this.style.display='none'">
        </section>

        <section class="auth-card" aria-labelledby="loginHeading">
            <div class="card-header">
                <img src="{{ asset('assets/logo_bg.png') }}" alt="Logo" class="card-logo" decoding="async" onerror="this.onerror=null;this.src='{{ asset('assets/rudraxpay.png') }}'">
                <h2 id="loginHeading">Welcome back</h2>
                <p>Sign in to continue your workday.</p>
            </div>

            @if(session('success'))<div class="alert alert-success" role="status"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif
            @if($errors->any())<div class="alert alert-danger" role="alert">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif

            <form method="POST" action="{{ route('login') }}" novalidate class="auth-form">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                        <input id="email" type="email" name="email" class="form-control" placeholder="you@company.com" value="{{ old('email') }}" required aria-required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock" aria-hidden="true"></i>
                        <input id="password" type="password" name="password" class="form-control" placeholder="Enter your password" required aria-required="true">
                        <button type="button" class="toggle-pass" aria-label="Show password" title="Show password"><i class="fas fa-eye"></i></button>
                    </div>
                </div>
                <div class="form-actions">
                    <label><input id="remember" type="checkbox" name="remember" style="accent-color:var(--auth-gradient-1);"> Remember me</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>
                <button type="submit" class="btn-primary"><i class="fas fa-sign-in-alt"></i> Sign In</button>
            </form>

            <div class="auth-footer">Don't have an account? <a href="{{ route('register') }}">Register Now</a></div>
        </section>
    </div>

    <script>
        document.addEventListener('click', function(e){
            if(e.target.closest('.toggle-pass')){
                var btn = e.target.closest('.toggle-pass');
                var input = document.getElementById('password');
                if(!input) return;
                if(input.type === 'password'){
                    input.type = 'text';
                    btn.innerHTML = '<i class="fas fa-eye-slash"></i>';
                    btn.setAttribute('aria-label','Hide password');
                } else {
                    input.type = 'password';
                    btn.innerHTML = '<i class="fas fa-eye"></i>';
                    btn.setAttribute('aria-label','Show password');
                }
            }
        });
    </script>
</body>
</html>
