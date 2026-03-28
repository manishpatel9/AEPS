<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordHtml extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false));
        $brandName = 'RudraxPay';
        $supportEmail = env('SUPPORT_EMAIL', config('mail.from.address', 'support@rudraxpay.com'));
        $supportPhone = env('SUPPORT_PHONE', '+91-XXXXXXXXXX');

        return (new MailMessage)
            ->subject('Reset your ' . $brandName . ' password')
            ->view('emails.password_reset', [
                'url' => $url,
                'name' => $notifiable->name ?? $notifiable->email,
                'brandName' => $brandName,
                'supportEmail' => $supportEmail,
                'supportPhone' => $supportPhone,
            ]);
    }
}
