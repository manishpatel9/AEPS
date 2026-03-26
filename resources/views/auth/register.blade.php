
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RudraxPay</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        /* Register-only compact overrides: match shared compact variables */
        .auth-card.compact { max-width: 380px; }
        .auth-card.compact form { display:flex; flex-direction:column; gap:10px; align-items:flex-start; }
        .auth-card.compact .form-group { width:100%; }
        .auth-card.compact .input-wrap { width:100%; max-width:340px; margin:0 auto; }
        .auth-card.compact .form-control { width:100%; max-width:340px; }
        .auth-card.compact label { max-width:340px; margin:0 auto 6px; display:block; color:var(--auth-muted); }
        .auth-card.compact .btn-primary { max-width:260px; width:100%; margin:8px auto 0; }
    </style>
</head>
<body>
    <div class="auth-shell">
        <section class="auth-brand">
            <div class="brand-row">
                <img src="{{ asset('assets/rudraxpay.png') }}" alt="RudraxPay" onerror="this.onerror=null;this.src='{{ asset('assets/logo.jpeg') }}'">
            </div>

            <div class="hero-copy">
                <h1>Start your RudraxPay account in minutes.</h1>
                <p>Simple onboarding for AEPS, bill pay, and commission tracking built for growing outlets.</p>
            </div>

            <div class="value-grid">
                <div class="value-card">
                    <strong>Quick Onboarding</strong>
                    <span>Activate your retailer ID fast.</span>
                </div>
                <div class="value-card">
                    <strong>Daily Earnings</strong>
                    <span>Track commissions in one place.</span>
                </div>
                <div class="value-card">
                    <strong>Secure Platform</strong>
                    <span>Role-based access and logs.</span>
                </div>
                <div class="value-card">
                    <strong>Support Team</strong>
                    <span>Fast help when you need it.</span>
                </div>
            </div>

            <div class="trust-row">
                <div class="trust-pill"><i class="fas fa-shield-alt"></i> Verified onboarding</div>
                <div class="trust-pill"><i class="fas fa-bolt"></i> Live settlements</div>
                <div class="trust-pill"><i class="fas fa-headset"></i> Assisted support</div>
            </div>
        </section>

        <section class="auth-card compact" aria-labelledby="registerHeading">
            <div>
                <h2 id="registerHeading">Create your account</h2>
                <p>Complete the details to activate your profile.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger" role="alert">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="reveal">
                @csrf
                <div class="form-group">
                    <label for="name">Full name</label>
                    <div class="input-wrap">
                        <i class="fas fa-user"></i>
                        <input id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Your full name" required aria-required="true">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope"></i>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="you@example.com" required aria-required="true">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <div class="input-wrap">
                        <i class="fas fa-mobile-alt"></i>
                        <input id="mobile" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="10-digit mobile number" pattern="[0-9]{10}" aria-describedby="mobileHelp">
                    </div>
                    <div id="mobileHelp" style="font-size:12px;color:var(--auth-muted)">We use this for OTP and account verification.</div>
                </div>

                <div class="form-group">
                    <label for="role">You are a</label>
                    <div class="input-wrap">
                        <i class="fas fa-user-tag"></i>
                        <select id="role" name="role" class="form-control" aria-label="Select role">
                            <option value="retailer" {{ old('role')=='retailer' ? 'selected' : '' }}>Retailer</option>
                            <option value="distributor" {{ old('role')=='distributor' ? 'selected' : '' }}>Distributor</option>
                            <option value="other" {{ old('role')=='other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" name="password" class="form-control" placeholder="Create a strong password" required aria-required="true">
                        <button type="button" class="toggle-pass" id="togglePass" aria-label="Toggle password visibility"><i class="fas fa-eye"></i></button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Re-enter password" required aria-required="true">
                    </div>
                </div>

                <div style="display:flex;align-items:center;gap:10px;margin-top:6px">
                    <input id="terms" type="checkbox" name="terms" required aria-required="true"> <label for="terms" style="font-size:13px;color:var(--auth-muted)">I agree to the <a href="#">Terms &amp; Privacy</a></label>
                </div>

                <button type="submit" class="btn-primary">Create account</button>
            </form>

            <div class="auth-footer">Already have an account? <a href="{{ route('login') }}">Sign in</a></div>
        </section>
    </div>

    <script>
        (function(){
            const toggle = document.getElementById('togglePass');
            const pass = document.getElementById('password');
            if(!toggle || !pass) return;
            toggle.addEventListener('click', ()=>{
                const shown = pass.getAttribute('type') === 'text';
                pass.setAttribute('type', shown ? 'password' : 'text');
                toggle.innerHTML = shown ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                pass.focus();
            });
        })();
    </script>
    </body>
    </html>
