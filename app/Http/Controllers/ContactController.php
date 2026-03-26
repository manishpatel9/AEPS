<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;

class ContactController extends Controller
{
    /**
     * Handle contact form submission from landing page.
     */
    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'string', 'max:32'],
            'role' => ['nullable', 'string', 'max:64'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        // add request metadata
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = substr($request->userAgent() ?? '', 0, 1000);

        $contact = Contact::create($data);

        // send notification email to admin (uses CONTACT_ADMIN_EMAIL env or MAIL_FROM_ADDRESS fallback)
        try {
            $recipient = env('CONTACT_ADMIN_EMAIL', env('MAIL_FROM_ADDRESS'));
            if($recipient) {
                Mail::to($recipient)->send(new ContactReceived($contact));
            }
        } catch (\Throwable $e) {
            // don't break user flow on mail failure; log for later (laravel will log automatically)
            report($e);
        }

        return back()->with('status', 'Thanks — we will contact you shortly.');
    }
}
