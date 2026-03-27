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

        // Attempt to embed the logo as a base64 data URI so the image shows inside the email
        $logoPath = public_path('assets/logo.jpeg');
        $logo = null;
        if (file_exists($logoPath) && is_readable($logoPath)) {
            $data = base64_encode(file_get_contents($logoPath));
            $logo = 'data:image/jpeg;base64,' . $data;
        } else {
            // Fallback to the public asset URL
            $logo = asset('assets/logo.jpeg');
        }

        return (new MailMessage)
            ->subject('Reset your RudraXPay password')
            ->view('emails.password_reset', [
                'url' => $url,
                'name' => $notifiable->name ?? $notifiable->email,
                'logo' => $logo,
            ]);
    }
}
