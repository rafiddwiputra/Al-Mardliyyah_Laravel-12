<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        // Membuat URL verifikasi bawaan Laravel yang aman dan terenkripsi
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Alamat Email Anda - Ponpes Al-Mardliyyah')
            ->view('emails.verify', [
                'url' => $verificationUrl,
                'notifiable' => $notifiable
            ]);
    }
}