<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Reset your password</title>
  <style>
    :root{--navy:#071033;--accent:#1447a8;--muted:#6b7a8a;--bg:#eaf1fb}
    body{font-family:Inter,system-ui,Arial,Helvetica,sans-serif;background:radial-gradient(ellipse at top center, #e9f3ff 0%, #f3f6fb 40%, #eef4fb 100%);margin:0;padding:32px 12px;color:#123}
    /* Card top becomes part of the single unified card */
    .card{max-width:640px;margin:28px auto 8px;background:linear-gradient(180deg,#f8fbff,#fff);border-radius:14px;overflow:visible;box-shadow:0 20px 60px rgba(10,20,50,0.09);border:1px solid rgba(12,28,56,0.04)}
    .card-top{width:100%;padding:28px 0 16px;text-align:center;background:linear-gradient(180deg,#071033 0%, #07203a 100%);border-top-left-radius:14px;border-top-right-radius:14px;color:#fff}
    .card-top .top-logo{height:76px;object-fit:contain;display:inline-block}
    /* card-body sits directly under the dark header inside the same card */
    .card-body{padding:20px 32px 28px;color:#13202b;position:relative;background:transparent}
    h1{font-size:28px;margin:8px 0 12px;color:#0b2540;font-weight:800;letter-spacing:-0.4px;text-align:center}
    p.lead{margin:10px 0;color:var(--muted);line-height:1.7;max-width:680px;margin-left:auto;margin-right:auto}
    .hero{max-width:700px;margin:14px auto 0;text-align:center}
    .btn-wrap{text-align:center;margin:22px 0}
    .btn{background:linear-gradient(180deg,var(--accent),#0f3a86);color:#fff;padding:14px 36px;border-radius:12px;text-decoration:none;display:inline-block;font-weight:800;box-shadow:0 14px 36px rgba(23,57,130,0.18);border:1px solid rgba(255,255,255,0.08)}
    .btn small{display:block;font-weight:600}
    .note{font-size:13px;color:#98a6b3;margin-top:18px;text-align:center}
    .cta-panel{max-width:520px;margin:18px auto;padding:20px;border-radius:12px;background:linear-gradient(180deg, rgba(245,249,255,0.95), rgba(238,244,255,0.95));box-shadow:0 10px 30px rgba(12,28,56,0.04);border:1px solid rgba(15,23,42,0.04);}
    .divider{border-top:1px solid rgba(15,23,42,0.06);margin:28px 0}
    .sub-head{font-weight:700;color:#0b2540;margin-bottom:8px;text-align:center}
    .notice-box{background:linear-gradient(180deg, rgba(245,249,255,0.9), rgba(238,244,255,0.9));border-radius:10px;border:1px solid rgba(15,23,42,0.04);padding:18px;margin:16px 0;box-shadow:inset 0 6px 18px rgba(12,28,56,0.02)}
    .footer{padding:18px 24px;background:#fbfdff;text-align:center;color:#90a0b0;font-size:13px}
    .meta{font-size:13px;color:#9aa5b2;margin-top:12px;text-align:center}
    .company-wrap{max-width:700px;margin:12px auto 0;text-align:center;color:#6b7a8a}
    .company-logo{height:56px;object-fit:contain;display:inline-block;margin-bottom:8px}
    .card-footer{padding:18px 36px 36px;background:transparent;border-bottom-left-radius:18px;border-bottom-right-radius:18px}
    .bottom-band{width:100%;margin-top:18px;background:linear-gradient(180deg,#06102a,#081b33);border-radius:8px;padding:18px;color:#dbe9ff;display:flex;align-items:center;justify-content:space-between;gap:20px}
    .help{display:flex;gap:14px;align-items:center}
    .help .bubble{width:56px;height:56px;border-radius:999px;background:linear-gradient(180deg,#0c2b57,#123a6d);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-weight:700}
    .socials{display:flex;gap:10px;align-items:center}
    .socials .dot{width:36px;height:36px;border-radius:999px;display:inline-flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.06);color:#fff;font-weight:700}
    .company-links{font-size:13px;color:#90a0b0;margin-top:6px}
    @media (max-width:720px){.top-hero{padding:18px 0}.card{margin:-28px 12px 8px}.card-body{padding:20px}.btn{width:100%;padding:14px}.bottom-band{flex-direction:column;align-items:flex-start}}
  </style>
</head>
<body>
  <div class="card">
    <div class="card-top">
      <img class="top-logo" src="{{ $logo ?? asset('assets/logo.jpeg') }}" alt="RudraXPay logo">
    </div>
    <div class="card-body">
      <!-- hero icon removed for smaller card -->
      <h1>Reset Your Password</h1>
      <p class="lead">Hello <strong>{{ $name }}</strong>,</p>
      <p class="lead">We received a request to reset the password for your RudraXPay account associated with this email address. Click the button below to set a new password. This link will expire in 60 minutes for security reasons.</p>

      <div class="cta-panel">
        <div class="btn-wrap">
          <a href="{{ $url }}" class="btn" target="_blank" rel="noopener">Reset Password</a>
        </div>
        <p class="note">This link will expire in 60 minutes for security reasons.</p>
      </div>

      <div class="divider" role="separator"></div>

      <div class="notice-box">
        <div class="sub-head">Didn't request a password reset?</div>
        <p style="margin:0;color:var(--muted);">If you did not request this, please ignore this email. Rest assured your account is secure.</p>
      </div>

      <div class="meta">If the button doesn't work, copy and paste this link into your browser:<br><a href="{{ $url }}" style="color:var(--accent);word-break:break-all;">{{ $url }}</a></div>
    </div>
    <div class="footer">www.rudraxpay.com &nbsp;|&nbsp; support@rudraxpay.com</div>
    <div class="card-footer">
      <div class="company-wrap">
        <img class="company-logo" src="{{ $logo ?? asset('assets/logo.jpeg') }}" alt="RudraXPay logo">
        <div class="company-links">www.rudraxpay.com &nbsp;|&nbsp; support@rudraxpay.com</div>
        <div style="margin-top:8px;color:#b7c2d1;font-size:12px">&copy; {{ date('Y') }} RudraXPay. All rights reserved.</div>
      </div>

      <div class="bottom-band" role="contentinfo">
        <div class="help">
          <div class="bubble">?</div>
          <div>
            <div style="font-weight:700">Need Help?</div>
            <div style="font-size:13px;color:#cfe6ff">support@rudraxpay.com &nbsp;|&nbsp; +91-XXXXXXXXXX</div>
          </div>
        </div>
        <div class="socials">
          <div style="text-align:right">
            <div style="font-weight:700;margin-bottom:6px">Follow Us</div>
            <div style="display:flex;gap:8px">
              <div class="dot">in</div>
              <div class="dot">t</div>
              <div class="dot">f</div>
              <div class="dot">ig</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
