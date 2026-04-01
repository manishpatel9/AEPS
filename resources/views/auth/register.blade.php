
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RudraxPay</title>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        /* Register-only compact overrides: tighter spacing for compact layout */
        .auth-card.compact { max-width: 520px; padding:12px 16px !important; }
        .auth-card.compact form { display:flex; flex-direction:column; gap:8px; align-items:flex-start; }
        .auth-card.compact .form-group { width:100%; margin-bottom:8px; }
        .auth-card.compact .input-wrap { width:100%; max-width:420px; margin:0 auto; }
        .auth-card.compact .form-control { width:100%; max-width:420px; padding:10px 46px 10px 38px; }
        .auth-card.compact label { max-width:420px; margin:0 auto 4px; display:block; color:var(--auth-muted); font-size:13px; }
        .auth-card.compact .btn-primary { max-width:320px; width:100%; margin:6px auto 0; padding:10px 14px; }
        .card-header{ margin-bottom:6px; }
        .card-header h2{ margin-bottom:4px; }
    </style>
</head>
<body>
    <div class="auth-shell">
        <section class="auth-brand" style="padding:0;">
            <img src="{{ asset('assets/register.png') }}" alt="Register art" loading="lazy" decoding="async" fetchpriority="low" style="width:100%;max-height:100%;height:auto;min-height:360px;object-fit:contain;display:block;" onerror="this.style.display='none'">
        </section>

        <section class="auth-card compact" aria-labelledby="registerHeading">
            <div class="card-header">
                <img src="{{ asset('assets/logo_bg.png') }}" alt="Logo" class="card-logo" decoding="async" onerror="this.onerror=null;this.src='{{ asset('assets/rudraxpay.png') }}'">
                <h2 id="registerHeading">Create your account</h2>
                <p>Complete the details to activate your profile.</p>
            </div>

            @if(session('success'))
                <div id="register-toast" class="toast success">{{ session('success') }} <span class="close" aria-hidden="true">&times;</span></div>
                <div id="register-modal" class="success-modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" aria-describedby="modalDesc">
                    <div class="success-modal-content">
                        <button class="success-modal-close" aria-label="Close">&times;</button>
                        <div class="success-icon"><i class="fas fa-check-circle"></i></div>
                        <h3 id="modalTitle">Success</h3>
                        <p id="modalDesc">{{ session('success') }}</p>
                        <button class="btn-primary" onclick="location='{{ route('login') }}'">Continue to Sign in</button>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="reveal auth-form">
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

            {{-- <div class="auth-help" style="margin-top:10px;font-size:13px;color:var(--auth-muted);">
                New here? After creating your account you'll see a confirmation popup and then be automatically redirected to the sign-in page. Admin approval may be required before your first login.
            </div> --}}
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
    <script>
        // Toast and centered modal show/dismiss for register success
        (function(){
            const toast = document.getElementById('register-toast');
            const modal = document.getElementById('register-modal');
            if(toast){
                // show toast
                setTimeout(()=> toast.classList.add('show'), 40);
                // auto hide
                const hideToast = ()=> toast.classList.remove('show');
                const t = setTimeout(hideToast, 4200);
                // manual close
                const closeBtn = toast.querySelector('.close');
                if(closeBtn){ closeBtn.addEventListener('click', ()=>{ clearTimeout(t); hideToast(); }); }
            }
            if(modal){
                // show modal slightly after toast
                setTimeout(()=> modal.classList.add('show'), 140);
                const hideModal = ()=> modal.classList.remove('show');
                // auto hide after a bit (optional)
                const m = setTimeout(hideModal, 5200);
                // also redirect to login after showing the modal
                const r = setTimeout(()=> { window.location.href = "{{ route('login') }}"; }, 3000);
                const closeBtn = modal.querySelector('.success-modal-close');
                if(closeBtn){ closeBtn.addEventListener('click', ()=>{ clearTimeout(m); clearTimeout(r); hideModal(); }); }
                // hide when clicking overlay outside content
                modal.addEventListener('click', (e)=>{ if(e.target === modal){ clearTimeout(m); clearTimeout(r); hideModal(); } });
            }
        })();
    </script>
    </body>
