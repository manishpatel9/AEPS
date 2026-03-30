@extends('layouts.auth')

@section('title', 'Register - RudraxPay')

@section('side')
    <div class="auth2-brand">
        <img src="{{ asset('assets/rudraxpay.png') }}" alt="RudraxPay" onerror="this.onerror=null;this.src='{{ asset('assets/logo.jpeg') }}'">
        <div>
            <b>RudraxPay</b>
            <span>Start earning today</span>
        </div>
    </div>

    <div class="auth2-hero">
        <h1>Create your account in minutes.</h1>
        <p>Simple onboarding for AEPS, bill pay, and commission tracking — built for growing outlets and teams.</p>
    </div>

    <div class="auth2-badges" aria-label="Highlights">
        <div class="auth2-badge"><i class="fa-solid fa-user-check"></i> Verified onboarding</div>
        <div class="auth2-badge"><i class="fa-solid fa-chart-line"></i> Daily tracking</div>
        <div class="auth2-badge"><i class="fa-solid fa-lock"></i> Protected data</div>
    </div>
@endsection

@section('content')
    <div class="a2-card" aria-labelledby="registerHeading">
        <div class="a2-head">
            <div class="a2-logo" aria-hidden="true">
                <img src="{{ asset('assets/logo_bg.png') }}" alt="" onerror="this.onerror=null;this.src='{{ asset('assets/rudraxpay.png') }}'">
            </div>
            <h2 id="registerHeading">Create your account</h2>
            <p>Fill the details below to get started.</p>
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

        <form method="POST" action="{{ route('register') }}" class="a2-form" aria-label="Register form">
            @csrf

            <div class="a2-field">
                <label class="a2-label" for="name">Full name</label>
                <div class="a2-input">
                    <i class="fa-solid fa-user" aria-hidden="true"></i>
                    <input id="name" name="name" class="a2-control" value="{{ old('name') }}" placeholder="Your full name" autocomplete="name" required aria-required="true">
                </div>
            </div>

            <div class="a2-field">
                <label class="a2-label" for="email">Email</label>
                <div class="a2-input">
                    <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                    <input id="email" name="email" type="email" class="a2-control" value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email" required aria-required="true">
                </div>
            </div>

            <div class="a2-field">
                <label class="a2-label" for="mobile">Mobile</label>
                <div class="a2-input">
                    <i class="fa-solid fa-mobile-screen" aria-hidden="true"></i>
                    <input id="mobile" name="mobile" class="a2-control" value="{{ old('mobile') }}" placeholder="10-digit mobile number" inputmode="numeric" pattern="[0-9]{10}" autocomplete="tel" required aria-required="true" aria-describedby="mobileHelp">
                </div>
                <div id="mobileHelp" class="a2-help">We use this for OTP and account verification.</div>
            </div>

            <div class="a2-field">
                <label class="a2-label" for="role">You are a</label>
                <div class="a2-input">
                    <i class="fa-solid fa-user-tag" aria-hidden="true"></i>
                    <select id="role" name="role" class="a2-control" aria-label="Select role">
                        <option value="retailer" {{ old('role')=='retailer' ? 'selected' : '' }}>Retailer</option>
                        <option value="distributor" {{ old('role')=='distributor' ? 'selected' : '' }}>Distributor</option>
                        <option value="other" {{ old('role')=='other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>

            <div class="a2-field">
                <label class="a2-label" for="password">Password</label>
                <div class="a2-input">
                    <i class="fa-solid fa-lock" aria-hidden="true"></i>
                    <input id="password" type="password" name="password" class="a2-control" placeholder="Create a strong password" autocomplete="new-password" required aria-required="true">
                    <button type="button" class="a2-toggle" data-toggle-password="#password" aria-label="Show password" title="Show password"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>

            <div class="a2-field">
                <label class="a2-label" for="password_confirmation">Confirm password</label>
                <div class="a2-input">
                    <i class="fa-solid fa-lock" aria-hidden="true"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="a2-control" placeholder="Re-enter password" autocomplete="new-password" required aria-required="true">
                    <button type="button" class="a2-toggle" data-toggle-password="#password_confirmation" aria-label="Show password" title="Show password"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>

            <div class="a2-row" style="justify-content:flex-start;">
                <label class="a2-check">
                    <input id="terms" type="checkbox" name="terms" required aria-required="true">
                    <span>I agree to the <a href="#">Terms</a> &amp; <a href="#">Privacy</a></span>
                </label>
            </div>

            <button type="submit" class="a2-btn"><i class="fa-solid fa-user-plus"></i> Create account</button>
        </form>

        <div class="a2-foot">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>
    </div>
@endsection

