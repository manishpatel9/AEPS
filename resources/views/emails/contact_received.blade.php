<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>New Enquiry</title>
</head>
<body style="font-family:Arial,Helvetica,sans-serif;color:#0b3a3a;">
    <h2>New Enquiry Received</h2>
    <p>A new enquiry was submitted via the landing page:</p>
    <table cellpadding="6" cellspacing="0" style="border-collapse:collapse;border:1px solid #e6eef0;">
        <tr><td><strong>Name</strong></td><td>{{ $contact->name }}</td></tr>
        <tr><td><strong>Phone</strong></td><td>{{ $contact->phone }}</td></tr>
        <tr><td><strong>Role</strong></td><td>{{ $contact->role }}</td></tr>
        <tr><td><strong>Message</strong></td><td>{{ $contact->message ?? '-' }}</td></tr>
        <tr><td><strong>IP</strong></td><td>{{ $contact->ip_address ?? '-' }}</td></tr>
        <tr><td><strong>User Agent</strong></td><td style="max-width:480px;word-break:break-word">{{ $contact->user_agent ?? '-' }}</td></tr>
        <tr><td><strong>Received</strong></td><td>{{ $contact->created_at }}</td></tr>
    </table>

    <p style="color:#6b6b6b;margin-top:14px;">This notification was sent automatically.</p>
</body>
</html>
