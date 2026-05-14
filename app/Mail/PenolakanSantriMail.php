<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PenolakanSantriMail extends Mailable
{
    use Queueable, SerializesModels;

    public $santri;
    public $catatanAdmin;

    /**
     * Create a new message instance.
     */
    public function __construct($santri, $catatanAdmin)
    {
        $this->santri = $santri;
        $this->catatanAdmin = $catatanAdmin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informasi Hasil Seleksi PPDB - Pondok Pesantren Al-Mardliyyah',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.santri.penolakan',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}