<?php

namespace App\Http\Controllers;

use App\Mail\ContactAcknowledgement;
use App\Mail\ContactReceived;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'email' => ['required', 'email', 'max:191'],
            'role' => ['nullable', 'string', 'max:64'],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        // Add request metadata for admin follow-up and debugging.
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = substr($request->userAgent() ?? '', 0, 1000);

        $contact = Contact::create($data);

        // Send notification email to admin.
        try {
            $recipient = env('CONTACT_ADMIN_EMAIL', env('MAIL_FROM_ADDRESS'));
            if ($recipient) {
                Mail::to($recipient)->send(new ContactReceived($contact));
            }
        } catch (\Throwable $e) {
            // Don't break user flow on admin mail failure.
            report($e);
        }

        // Send acknowledgement email to the person who submitted the form.
        try {
            Mail::to($contact->email)->send(new ContactAcknowledgement($contact));
        } catch (\Throwable $e) {
            // Don't break user flow on customer mail failure.
            report($e);
        }

        return back()->with('status', 'Thanks - we will contact you shortly.');
    }
}
