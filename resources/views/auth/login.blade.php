
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RudraxPay</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        /* Login-only overrides: keep login larger and more prominent */
        .auth-card{ max-width:420px !important; padding:22px 20px !important; border-radius:12px !important; box-shadow:0 12px 30px rgba(2,6,23,0.06) !important; }
        .auth-card h2{ font-size:24px !important; }
        .form-control{ padding:12px 14px 12px 48px !important; border-radius:12px !important; }
        .btn-primary{ padding:12px 18px !important; font-size:15px !important; box-shadow:0 12px 30px rgba(37,99,235,0.12) !important; }
    </style>
</head>
<body>
    <div class="auth-shell">
        <section class="auth-brand" style="padding:0;">
            <img src="{{ asset('assets/login.png') }}" alt="Login art" style="width:100%;height:100%;min-height:420px;object-fit:cover;display:block;" onerror="this.style.display='none'">
        </section>

        <section class="auth-card" aria-labelledby="loginHeading">
            <div class="card-header">
                <img src="{{ asset('assets/logo.jpeg') }}" alt="Logo" class="card-logo" onerror="this.onerror=null;this.src='{{ asset('assets/rudraxpay.png') }}'">
                <h2 id="loginHeading">Welcome back</h2>
                <p>Sign in to continue your workday.</p>
            </div>

            @if(session('success'))<div class="alert alert-success" role="status"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif
            @if($errors->any())<div class="alert alert-danger" role="alert">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif

            <form method="POST" action="{{ route('login') }}" novalidate>
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
                    <label><input id="remember" type="checkbox" name="remember" style="accent-color:#0ea5a4;"> Remember me</label>
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
