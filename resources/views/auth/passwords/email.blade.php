<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - RudraxPay</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="auth-shell">
    <section class="auth-brand" style="padding:0;">
        <img src="{{ asset('assets/login.png') }}" alt="Login art" loading="lazy" decoding="async" fetchpriority="low" style="width:100%;height:100%;min-height:420px;object-fit:cover;display:block;" onerror="this.style.display='none'">
    </section>

    <section class="auth-card" aria-labelledby="resetHeading">
        <div class="card-header">
            <img src="{{ asset('assets/logo_bg.png') }}" alt="Logo" class="card-logo" decoding="async">
            <h2 id="resetHeading">Reset your password</h2>
            <p>Enter your account email and we'll send a reset link.</p>
        </div>

        @if(session('success'))<div class="alert alert-success" role="status">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger" role="alert">{{ session('error') }}</div>@endif
        @if($errors->any())<div class="alert alert-danger" role="alert">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    <input id="email" type="email" name="email" class="form-control" placeholder="you@company.com" value="{{ old('email') }}" required aria-required="true">
                </div>
            </div>

            <div style="display:flex;gap:10px;align-items:center;">
                <a href="{{ route('login') }}">Back to sign in</a>
                <button type="submit" class="btn-primary" style="margin-left:auto;">Send reset link</button>
            </div>
        </form>

        <div class="auth-footer">Don't have an account? <a href="{{ route('register') }}">Register Now</a></div>
    </section>
</div>
</body>
</html>
