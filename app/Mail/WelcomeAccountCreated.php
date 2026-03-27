<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $plainPassword;
    public string $loginUrl;
    public string $supportEmail;
    public string $supportPhone;
    public string $brandName;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
        $this->loginUrl = route('login');
        $this->supportEmail = env('SUPPORT_EMAIL', config('mail.from.address', 'support@rudraxpay.com'));
        $this->supportPhone = env('SUPPORT_PHONE', '+91-XXXXXXXXXX');
        $this->brandName = 'RudraxPay';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Welcome to ' . $this->brandName . ' - Your account has been created')
            ->view('emails.welcome_account_created')
            ->with([
                'user' => $this->user,
                'plainPassword' => $this->plainPassword,
                'loginUrl' => $this->loginUrl,
                'supportEmail' => $this->supportEmail,
                'supportPhone' => $this->supportPhone,
                'brandName' => $this->brandName,
                'accountStatus' => $this->user->status,
            ]);
    }
}
