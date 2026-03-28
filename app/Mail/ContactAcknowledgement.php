<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAcknowledgement extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $contact;
    public string $brandName;
    public string $supportEmail;
    public string $supportPhone;

    /**
     * Create a new message instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->brandName = 'RudraxPay';
        $this->supportEmail = env('SUPPORT_EMAIL', config('mail.from.address', 'support@rudraxpay.com'));
        $this->supportPhone = env('SUPPORT_PHONE', '+91-XXXXXXXXXX');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Thank you for your inquiry - ' . $this->brandName)
            ->view('emails.contact_acknowledgement')
            ->with([
                'contact' => $this->contact,
                'brandName' => $this->brandName,
                'supportEmail' => $this->supportEmail,
                'supportPhone' => $this->supportPhone,
            ]);
    }
}
