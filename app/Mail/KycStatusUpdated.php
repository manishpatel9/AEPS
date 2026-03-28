<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KycStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $status;
    public string $brandName;
    public string $supportEmail;
    public string $supportPhone;
    public string $loginUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $status)
    {
        $this->user = $user;
        $this->status = $status;
        $this->brandName = 'RudraxPay';
        $this->supportEmail = env('SUPPORT_EMAIL', config('mail.from.address', 'support@rudraxpay.com'));
        $this->supportPhone = env('SUPPORT_PHONE', '+91-XXXXXXXXXX');
        $this->loginUrl = route('login');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $title = $this->status === 'verified' ? 'Your KYC has been approved' : 'Your KYC status has been updated';

        return $this->subject($title . ' - ' . $this->brandName)
            ->view('emails.kyc_status_updated')
            ->with([
                'user' => $this->user,
                'status' => $this->status,
                'brandName' => $this->brandName,
                'supportEmail' => $this->supportEmail,
                'supportPhone' => $this->supportPhone,
                'loginUrl' => $this->loginUrl,
            ]);
    }
}
