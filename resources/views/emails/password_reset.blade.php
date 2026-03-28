<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
</head>
<body style="margin:0;padding:0;background:#eef5ff;font-family:Arial,Helvetica,sans-serif;color:#17315c;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#eef5ff;margin:0;padding:0;">
        <tr>
            <td align="center" style="padding:24px 12px;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:760px;background:linear-gradient(180deg,#0d3d91 0%,#164da8 50%,#eef5ff 100%);border-radius:28px;overflow:hidden;box-shadow:0 18px 40px rgba(13,61,145,0.18);">
                    <tr>
                        <td style="padding:32px 32px 26px;text-align:center;">
                            @php($brand = $brandName ??                            @php($logoPath = public_path('assets/logo.jpeg'))
                            @if(isset($message) && file_exists($logoPath))
                                <img src="{{ $message->embed($logoPath) }}" alt="{{ $brand }}" style="max-width:260px;width:100%;height:auto;">
;height:auto;">
                            @else
                                <div style="font-size:42px;font-weight:800;line-height:1;color:#ffffff;letter-spacing:-1px;">{{ $brand }}</div>
                            @endif
                            <div style="font-size:22px;font-weight:800;color:#ffffff;margin-top:16px;">Password Reset Request</div>
                            <div style="font-size:15px;line-height:1.6;color:rgba(255,255,255,0.88);margin-top:6px;">Secure access starts with a fresh password.</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 22px 22px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#ffffff;border-radius:26px;">
                                <tr>
                                    <td style="padding:34px 38px 30px;">
                                        <div style="font-size:18px;font-weight:800;color:#153a7b;text-align:center;">Hi {{ $name }},</div>
                                        <div style="font-size:15px;line-height:1.8;color:#44526c;text-align:center;margin-top:10px;">
                                            We received a request to reset the password for your {{ $brand }} account. Use the secure button below to create a new password and regain access.
                                        </div>

                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:22px;background:#eaf4ff;border-radius:16px;">
                                            <tr>
                                                <td style="padding:18px 20px;">
                                                    <div style="font-size:13px;font-weight:700;color:#0b8b50;text-transform:uppercase;letter-spacing:0.6px;">Security Notice</div>
                                                    <div style="font-size:26px;font-weight:800;color:#173d7f;margin-top:4px;">Reset your password securely</div>
                                                    <div style="font-size:15px;line-height:1.7;color:#4e5a70;margin-top:8px;">
                                                        This reset link will expire in 60 minutes for your protection.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <div style="text-align:center;margin-top:24px;">
                                            <a href="{{ $url }}" target="_blank" rel="noopener" style="display:inline-block;background:linear-gradient(135deg,#0f55cb,#2b74ea);color:#ffffff;text-decoration:none;font-size:17px;font-weight:800;padding:16px 36px;border-radius:14px;">
                                                Reset Password
                                            </a>
                                        </div>

                                        <div style="font-size:14px;line-height:1.7;color:#637189;text-align:center;margin-top:14px;">
                                            This link will take you to the secure {{ $brand }} password reset page.
                                        </div>

                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:16px;background:#fff2df;border-radius:14px;">
                                            <tr>
                                                <td style="padding:14px 18px;font-size:15px;line-height:1.7;color:#d16a00;font-weight:700;">
                                                    If you did not request a password reset, you can safely ignore this email.
                                                </td>
                                            </tr>
                                        </table>

                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:14px;background:#f7f8fb;border-radius:14px;">
                                            <tr>
                                                <td style="padding:14px 18px;font-size:14px;line-height:1.7;color:#58657b;">
                                                    If the button does not work, copy and paste this link into your browser:<br>
                                                    <a href="{{ $url }}" style="color:#0f55cb;word-break:break-all;text-decoration:none;">{{ $url }}</a>
                                                </td>
                                            </tr>
                                        </table>

                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:28px;background:#eaf4ff;border-radius:16px;">
                                            <tr>
                                                <td style="padding:16px 18px;">
                                                    <div style="font-size:18px;font-weight:800;color:#1c4da5;">Secure • Fast • Reliable</div>
                                                    <div style="font-size:15px;line-height:1.7;color:#4d5e78;margin-top:4px;">
                                                        {{ $brand }} keeps your account protected with trusted recovery workflows.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <div style="font-size:18px;font-weight:800;color:#173d7f;text-align:center;margin-top:28px;">Need help getting back in?</div>
                                        <div style="font-size:15px;line-height:1.7;color:#536075;text-align:center;margin-top:6px;">
                                            Our support team is here for you 24/7.
                                        </div>

                                        <div style="height:1px;background:#e6ecf4;margin:28px 0 24px;"></div>

                                        <div style="font-size:15px;line-height:1.8;color:#4d5e78;">
                                            Best Regards,<br>
                                            <span style="font-size:18px;font-weight:800;color:#1a4ca0;">The {{ $brand }} Team</span><br>
                                            Powering Secure Payments, Empowering Businesses
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:6px 22px 0;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#0f2f66;border-radius:22px 22px 0 0;">
                                <tr>
                                    <td style="padding:22px 26px;color:#ffffff;">
                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td style="font-size:14px;line-height:1.8;vertical-align:top;">
                                                    <div style="font-size:28px;font-weight:800;margin-bottom:4px;">Need Help?</div>
                                                    <div>{{ $supportEmail ?? 'support@rudraxpay.com' }} | {{ $supportPhone ?? '+91-XXXXXXXXXX' }}</div>
                                                    <div style="color:rgba(255,255,255,0.76);">Available 24/7 to assist you</div>
                                                </td>
                                                <td align="right" style="font-size:14px;color:rgba(255,255,255,0.9);vertical-align:top;">
                                                    <div style="font-size:28px;font-weight:800;margin-bottom:4px;">Follow Us</div>
                                                    <div>Facebook | LinkedIn | Instagram</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 26px 20px;color:rgba(255,255,255,0.76);font-size:13px;text-align:center;">
                                        &copy; {{ now()->year }} {{ $brand }}. All rights reserved. | Secure Payment Gateway Solutions
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
/div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
