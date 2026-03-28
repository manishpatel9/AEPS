<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KYC Status Update</title>
    <style>
        img { border:0; -ms-interpolation-mode:bicubic; }
        a { color:inherit; }
        body { -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; }
        .email-card { max-width:760px; width:100%; border-radius:28px; overflow:hidden; }
        .email-header { padding:32px; text-align:center; }
        .brand-logo { max-width:260px; width:100%; height:auto; }
        .content-shell { padding:0 22px 22px; }
        .content-card { padding:34px 38px 30px; }
        .cta-btn { display:inline-block; background:linear-gradient(135deg,#0f55cb,#2b74ea); color:#ffffff; text-decoration:none; font-size:17px; font-weight:800; padding:16px 36px; border-radius:14px; }
        .footer-cell-right { text-align:right; }

        @media only screen and (max-width:600px) {
            .email-card { border-radius:18px !important; }
            .email-header { padding:22px 20px !important; }
            .content-shell { padding:0 12px 16px !important; }
            .content-card { padding:22px 20px !important; }
            .brand-logo { max-width:180px !important; }
            .cta-btn { display:block !important; width:100% !important; box-sizing:border-box !important; padding:14px 18px !important; font-size:16px !important; }
            .stack-cell, .footer-cell-right { display:block !important; width:100% !important; text-align:left !important; }
            .footer-cell-right { padding-top:16px !important; }
        }
    </style>
</head>
<body style="margin:0;padding:0;background:#eef5ff;font-family:Arial,Helvetica,sans-serif;color:#17315c;">
    @php
        $isApproved = $status === 'verified';
        $heading = $isApproved ? 'Your KYC Has Been Approved' : 'Your KYC Status Has Been Updated';
        $subheading = $isApproved
            ? 'Your identity verification is complete and your account is ready for smoother access.'
            : 'We reviewed your KYC submission and there is an update waiting for you.';
        $highlightTitle = $isApproved ? 'Verification Successful' : 'Action May Be Required';
        $highlightBody = $isApproved
            ? 'Your documents were verified successfully. You can continue using your account with confidence.'
            : 'Please log in to your account and review the latest KYC status or any further instructions from our team.';
        $noticeBody = $isApproved
            ? 'You can now continue using the platform with your verified profile.'
            : 'If your KYC was not approved, please review your submitted documents and upload corrected details if needed.';
    @endphp
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#eef5ff;margin:0;padding:0;">
        <tr>
            <td align="center" style="padding:24px 12px;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" class="email-card" style="background:linear-gradient(180deg,#0d3d91 0%,#164da8 50%,#eef5ff 100%);box-shadow:0 18px 40px rgba(13,61,145,0.18);">
                    <tr>
                        <td class="email-header">
                            @php($logoPath = public_path('assets/logo.jpeg'))
                            @if(isset($message) && file_exists($logoPath))
                                <img src="{{ $message->embed($logoPath) }}" alt="{{ $brandName }}" class="brand-logo">
                            @else
                                <div style="font-size:42px;font-weight:800;line-height:1;color:#ffffff;letter-spacing:-1px;">{{ $brandName }}</div>
                            @endif
                            <div style="font-size:22px;font-weight:800;color:#ffffff;margin-top:16px;">{{ $heading }}</div>
                            <div style="font-size:15px;line-height:1.6;color:rgba(255,255,255,0.88);margin-top:6px;">{{ $subheading }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-shell">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#ffffff;border-radius:26px;">
                                <tr>
                                    <td class="content-card">
                                        <div style="font-size:18px;font-weight:800;color:#153a7b;text-align:center;">Hi {{ $user->name }},</div>
                                        <div style="font-size:15px;line-height:1.8;color:#44526c;text-align:center;margin-top:10px;">
                                            This is to let you know that your KYC status on {{ $brandName }} is now marked as <strong>{{ ucfirst($status) }}</strong>.
                                        </div>
                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:22px;background:#eaf4ff;border-radius:16px;">
                                            <tr>
                                                <td style="padding:18px 20px;">
                                                    <div style="font-size:13px;font-weight:700;color:{{ $isApproved ? '#0b8b50' : '#d16a00' }};text-transform:uppercase;letter-spacing:0.6px;">{{ $highlightTitle }}</div>
                                                    <div style="font-size:26px;font-weight:800;color:#173d7f;margin-top:4px;">{{ ucfirst($status) }}</div>
                                                    <div style="font-size:15px;line-height:1.7;color:#4e5a70;margin-top:8px;">
                                                        {{ $highlightBody }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:16px;background:{{ $isApproved ? '#eafbf3' : '#fff2df' }};border-radius:14px;">
                                            <tr>
                                                <td style="padding:14px 18px;font-size:15px;line-height:1.7;color:{{ $isApproved ? '#0b8b50' : '#d16a00' }};font-weight:700;">
                                                    {{ $noticeBody }}
                                                </td>
                                            </tr>
                                        </table>
                                        <div style="text-align:center;margin-top:24px;">
                                            <a href="{{ $loginUrl }}" class="cta-btn">Login to Your Account</a>
                                        </div>
                                        <div style="font-size:14px;line-height:1.7;color:#637189;text-align:center;margin-top:14px;">
                                            Sign in to review your profile and continue with your account activity.
                                        </div>
                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:28px;background:#eaf4ff;border-radius:16px;">
                                            <tr>
                                                <td style="padding:16px 18px;">
                                                    <div style="font-size:18px;font-weight:800;color:#1c4da5;">Secure | Fast | Reliable</div>
                                                    <div style="font-size:15px;line-height:1.7;color:#4d5e78;margin-top:4px;">
                                                        {{ $brandName }} keeps your account journey transparent with timely updates and support.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div style="font-size:18px;font-weight:800;color:#173d7f;text-align:center;margin-top:28px;">Need help?</div>
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
                                                <td class="stack-cell" style="font-size:14px;line-height:1.8;vertical-align:top;">
                                                    <div style="font-size:28px;font-weight:800;margin-bottom:4px;">Need Help?</div>
                                                    <div>{{ $supportEmail }} | {{ $supportPhone }}</div>
                                                    <div style="color:rgba(255,255,255,0.76);">Available 24/7 to assist you</div>
                                                </td>
                                                <td class="footer-cell-right" style="font-size:14px;color:rgba(255,255,255,0.9);vertical-align:top;">
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
