<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Inquiry</title>
    <style>
        img { border:0; -ms-interpolation-mode:bicubic; }
        a { color:inherit; }
        body { -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; }
        .email-card { max-width:760px; width:100%; border-radius:28px; overflow:hidden; }
        .email-header { padding:30px 32px 12px; text-align:center; }
        .brand-logo { max-width:280px; width:100%; height:auto; }
        .content-shell { padding:8px 22px 22px; }
        .content-card { padding:30px 36px 32px; }
        .footer-cell-right { text-align:right; }

        @media only screen and (max-width:600px) {
            .email-card { border-radius:18px !important; }
            .email-header { padding:22px 20px 10px !important; }
            .content-shell { padding:8px 12px 16px !important; }
            .content-card { padding:22px 20px !important; }
            .brand-logo { max-width:180px !important; }
            .stack-cell, .footer-cell-right { display:block !important; width:100% !important; text-align:left !important; }
            .footer-cell-right { padding-top:16px !important; }
        }
    </style>
</head>
<body style="margin:0;padding:0;background:#eaf2ff;font-family:Arial,Helvetica,sans-serif;color:#17315c;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#eaf2ff;margin:0;padding:0;">
        <tr>
            <td align="center" style="padding:24px 12px;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" class="email-card" style="background:linear-gradient(180deg,#0d2f74 0%,#1b4ca8 48%,#dfeeff 100%);box-shadow:0 18px 40px rgba(13,61,145,0.18);">
                    <tr>
                        <td class="email-header">
                            @php($logoPath = public_path('assets/logo.jpeg'))
                            @if(isset($message) && file_exists($logoPath))
                                <img src="{{ $message->embed($logoPath) }}" alt="{{ $brandName }}" class="brand-logo">
                            @else
                                <div style="font-size:42px;font-weight:800;line-height:1;color:#ffffff;letter-spacing:-1px;">{{ $brandName }}</div>
                            @endif
                            <div style="font-size:22px;font-weight:800;color:#ffffff;margin-top:18px;">Thank You for Your Inquiry!</div>
                            <div style="font-size:15px;line-height:1.7;color:rgba(255,255,255,0.9);margin-top:8px;max-width:520px;margin-left:auto;margin-right:auto;">
                                We've received your message. One of our support team members will get back to you shortly.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-shell">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:rgba(255,255,255,0.78);border:1px solid rgba(255,255,255,0.55);border-radius:28px;">
                                <tr>
                                    <td class="content-card">
                                        <div style="font-size:18px;font-weight:800;color:#153a7b;text-align:center;">Hi {{ $contact->name }},</div>
                                        <div style="font-size:15px;line-height:1.8;color:#334155;text-align:center;margin-top:14px;max-width:560px;margin-left:auto;margin-right:auto;">
                                            Thank you for reaching out to {{ $brandName }}. We have received your inquiry and a member of our support team will review your message shortly.
                                        </div>
                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:26px;background:rgba(255,255,255,0.66);border:1px solid rgba(255,255,255,0.7);border-radius:16px;">
                                            <tr>
                                                <td style="padding:18px 22px;">
                                                    <div style="font-size:18px;font-weight:800;color:#173d7f;">We're Here to Help!</div>
                                                    <div style="font-size:15px;line-height:1.8;color:#4b5b73;margin-top:8px;">
                                                        Our support team is dedicated to resolving your queries promptly. Typically, you can expect to hear from us within 24 hours.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:18px;background:rgba(255,255,255,0.66);border:1px solid rgba(255,255,255,0.7);border-radius:16px;">
                                            <tr>
                                                <td style="padding:18px 22px;">
                                                    <div style="font-size:18px;font-weight:800;color:#173d7f;">Your Payment Partners, Anytime, Anywhere!</div>
                                                    <div style="font-size:15px;line-height:1.8;color:#4b5b73;margin-top:8px;">
                                                        For any urgent assistance, don't hesitate to contact us right away.
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div style="height:1px;background:rgba(23,61,127,0.12);margin:28px 0 22px;"></div>
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
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#0b2558;border-radius:22px 22px 0 0;">
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
                                                    <div>X | LinkedIn | Facebook | Instagram</div>
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
