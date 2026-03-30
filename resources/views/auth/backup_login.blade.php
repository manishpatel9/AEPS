@extends('layouts.auth')

@section('title', 'Login - RudraxPay (backup)')

@section('side')
    <div class="auth2-brand">
        <img src="{{ asset('assets/rudraxpay.png') }}" alt="RudraxPay" onerror="this.onerror=null;this.src='{{ asset('assets/logo.jpeg') }}'">
        <div>
            <b>RudraxPay</b>
            <span>Retail fintech dashboard</span>
        </div>
    </div>

    <div class="auth2-hero">
        <h1>Sign in. Stay in control.</h1>
        <p>Track settlements, commissions, and service performance with a clean dashboard built for daily retail operations.</p>
    </div>

    <div class="auth2-badges" aria-label="Highlights">
        <div class="auth2-badge"><i class="fa-solid fa-shield-halved"></i> Secure access</div>
        <div class="auth2-badge"><i class="fa-solid fa-bolt"></i> Fast payouts</div>
        <div class="auth2-badge"><i class="fa-solid fa-headset"></i> Support</div>
    </div>
@endsection

@section('content')
    <div class="a2-card" aria-labelledby="loginHeading">
        <div class="a2-head">
            <div class="a2-logo" aria-hidden="true">
                <img src="{{ asset('assets/logo_bg.png') }}" alt="" onerror="this.onerror=null;this.src='{{ asset('assets/rudraxpay.png') }}'">
            </div>
            <h2 id="loginHeading">Welcome back</h2>
            <p>Enter your credentials to continue.</p>
        </div>

        @if(session('success'))
            <div class="a2-alert success" role="status"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="a2-alert danger" role="alert"><i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="a2-alert danger" role="alert">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate class="a2-form" aria-label="Login form">
            @csrf

            <div class="a2-field">
                <label class="a2-label" for="email">Email</label>
                <div class="a2-input">
                    <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                    <input id="email" type="email" name="email" class="a2-control" placeholder="you@company.com" value="{{ old('email') }}" autocomplete="username" required aria-required="true">
                </div>
            </div>

            <div class="a2-field">
                <label class="a2-label" for="password">Password</label>
                <div class="a2-input">
                    <i class="fa-solid fa-lock" aria-hidden="true"></i>
                    <input id="password" type="password" name="password" class="a2-control" placeholder="Enter your password" autocomplete="current-password" required aria-required="true">
                    <button type="button" class="a2-toggle" data-toggle-password="#password" aria-label="Show password" title="Show password"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>

            <div class="a2-row">
                <label class="a2-check">
                    <input id="remember" type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="a2-btn"><i class="fa-solid fa-right-to-bracket"></i> Sign In</button>
        </form>

        <div class="a2-foot">
            Don't have an account? <a href="{{ route('register') }}">Create one</a>
        </div>
    </div>
@endsection

