<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiPenerimaanSantri extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $santri;

    public function __construct($santri)
    {
        $this->santri = $santri;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengumuman Kelulusan Santri Baru - Pondok Pesantren Al-Mardliyyah',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notifikasi-penerimaan',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}