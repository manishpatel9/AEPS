<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password - RudraxPay</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="auth-shell">
    <section class="auth-brand" style="padding:0;">
        <img src="{{ asset('assets/login.png') }}" alt="Login art" style="width:100%;height:100%;min-height:420px;object-fit:cover;display:block;" onerror="this.style.display='none'">
    </section>

    <section class="auth-card" aria-labelledby="resetHeading">
        <div class="card-header">
            <img src="{{ asset('assets/logo.jpeg') }}" alt="Logo" class="card-logo">
            <h2 id="resetHeading">Set a new password</h2>
            <p>Enter a new password for your account.</p>
        </div>

        @if(session('success'))<div class="alert alert-success" role="status">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger" role="alert">{{ session('error') }}</div>@endif
        @if($errors->any())<div class="alert alert-danger" role="alert">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    <input id="email" type="email" name="email" class="form-control" placeholder="you@company.com" value="{{ old('email') }}" required aria-required="true">
                </div>
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Enter new password" required aria-required="true">
                    <button type="button" class="toggle-pass" aria-label="Show password"><i class="fas fa-eye"></i></button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required aria-required="true">
                </div>
            </div>

            <div style="display:flex;gap:10px;align-items:center;">
                <a href="{{ route('login') }}">Back to sign in</a>
                <button type="submit" class="btn-primary" style="margin-left:auto;">Set password</button>
            </div>
        </form>

        <div class="auth-footer">Don't have an account? <a href="{{ route('register') }}">Register Now</a></div>
    </section>
</div>
</body>
</html>
