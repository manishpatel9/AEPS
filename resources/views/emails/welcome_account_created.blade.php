<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ $brandName }}</title>
</head>
<body style="margin:0;padding:0;background:#eef5ff;font-family:Arial,Helvetica,sans-serif;color:#17315c;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#eef5ff;margin:0;padding:0;">
        <tr>
            <td align="center" style="padding:24px 12px;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:760px;background:linear-gradient(180deg,#0d3d91 0%,#164da8 50%,#eef5ff 100%);border-radius:28px;overflow:hidden;box-shadow:0 18px 40px rgba(13,61,145,0.18);">
                    <tr>
                        <td style="padding:32px 32px 26px;text-align:center;">
                            @php($logoPath = public_path('assets/logo.jpeg'))
                            @if(isset($message) && file_exists($logoPath))
                                <img src="{{ $message->embed($logoPath) }}" alt="{{ $brandName }}" style="max-width:260px;width:100%;height:auto;">
                            @else
                                <div style="font-size:42px;font-weight:800;line-height:1;color:#ffffff;letter-spacing:-1px;">{{ $brandName }}</div>
                            @endif
                            <div style="font-size:22px;font-weight:800;color:#ffffff;margin-top:16px;">Welcome to {{ $brandName }}!</div>
                            <div style="font-size:15px;line-height:1.6;color:rgba(255,255,255,0.88);margin-top:6px;">We're excited to have you on board.</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 22px 22px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#ffffff;border-radius:26px;">
                                <tr>
                                    <td style="padding:34px 38px 30px;">
                                        <div style="font-size:18px;font-weight:800;color:#153a7b;text-align:center;">Hi {{ $user->name }},</div>
                                        <div style="font-size:15px;line-height:1.8;color:#44526c;text-align:center;margin-top:10px;">
                                            Thank you for choosing {{ $brandName }} - your trusted partner in secure and seamless digital payments.
                                        </div>

                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:22px;background:#eaf4ff;border-radius:16px;">
                                            <tr>
                                                <td style="padding:18px 20px;">
                                                    <div style="font-size:13px;font-weight:700;color:#0b8b50;text-transform:uppercase;letter-spacing:0.6px;">Account Created</div>
                                                    <div style="font-size:26px;font-weight:800;color:#173d7f;margin-top:4px;">Your account has been successfully created!</div>
                                                    <div style="font-size:15px;line-height:1.7;color:#4e5a70;margin-top:8px;">
                                                        You're all set to start exploring the future of payments with {{ $brandName }}.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <div style="font-size:18px;font-weight:800;color:#173d7f;margin-top:26px;">Your Login Credentials</div>

                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:14px;border:1px solid #d7dfeb;border-radius:16px;">
                                            <tr>
                                                <td style="padding:18px 22px;">
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td style="font-size:14px;color:#64748b;padding:6px 0;">Email Address:</td>
                                                            <td align="right" style="font-size:18px;font-weight:800;color:#17315c;padding:6px 0;">{{ $user->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size:14px;color:#64748b;padding:6px 0;">Temporary Password:</td>
                                                            <td align="right" style="font-size:18px;font-weight:800;color:#17315c;padding:6px 0;">{{ $plainPassword }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size:14px;color:#64748b;padding:6px 0;">Role:</td>
                                                            <td align="right" style="font-size:16px;font-weight:700;color:#17315c;padding:6px 0;">{{ ucfirst($user->role) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size:14px;color:#64748b;padding:6px 0;">Account Status:</td>
                                                            <td align="right" style="font-size:16px;font-weight:700;color:#17315c;padding:6px 0;">{{ ucfirst($accountStatus) }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:16px;background:#fff2df;border-radius:14px;">
                                            <tr>
                                                <td style="padding:14px 18px;font-size:15px;line-height:1.7;color:#d16a00;font-weight:700;">
                                                    For your security, please reset your password after your first login.
                                                </td>
                                            </tr>
                                        </table>

                                        @if($accountStatus === 'pending')
                                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:14px;background:#f7f8fb;border-radius:14px;">
                                                <tr>
                                                    <td style="padding:14px 18px;font-size:14px;line-height:1.7;color:#58657b;">
                                                        Your profile is currently under review by our team. You can still keep this email for your credentials and use them once your account is activated.
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif

                                        <div style="text-align:center;margin-top:24px;">
                                            <a href="{{ $loginUrl }}" style="display:inline-block;background:linear-gradient(135deg,#0f55cb,#2b74ea);color:#ffffff;text-decoration:none;font-size:17px;font-weight:800;padding:16px 36px;border-radius:14px;">
                                                Login to Your Account
                                            </a>
                                        </div>

                                        <div style="font-size:14px;line-height:1.7;color:#637189;text-align:center;margin-top:14px;">
                                            This link will take you to the secure {{ $brandName }} dashboard.
                                        </div>

                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:28px;background:#eaf4ff;border-radius:16px;">
                                            <tr>
                                                <td style="padding:16px 18px;">
                                                    <div style="font-size:18px;font-weight:800;color:#1c4da5;">Secure • Fast • Reliable</div>
                                                    <div style="font-size:15px;line-height:1.7;color:#4d5e78;margin-top:4px;">
                                                        Experience next-gen payment solutions with {{ $brandName }}.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <div style="font-size:18px;font-weight:800;color:#173d7f;text-align:center;margin-top:28px;">Need help getting started?</div>
                                        <div style="font-size:15px;line-height:1.7;color:#536075;text-align:center;margin-top:6px;">
                                            Our support team is here for you 24/7.
                                        </div>

                                        <div style="height:1px;background:#e6ecf4;margin:28px 0 24px;"></div>

                                        <div style="font-size:15px;line-height:1.8;color:#4d5e78;">
                                            Best Regards,<br>
                                            <span style="font-size:18px;font-weight:800;color:#1a4ca0;">The {{ $brandName }} Team</span><br>
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
                                                    <div>{{ $supportEmail }} | {{ $supportPhone }}</div>
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
                                        &copy; {{ now()->year }} {{ $brandName }}. All rights reserved. | Secure Payment Gateway Solutions
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
