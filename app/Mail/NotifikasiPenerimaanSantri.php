<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifikasiPenerimaanSantri extends Mailable
{
    use Queueable, SerializesModels;

    // 1. Tambahkan variabel untuk menampung data santri
    public $santri;

    // 2. Masukkan data santri melalui constructor
    public function __construct($santri)
    {
        $this->santri = $santri;
    }

    // 3. Atur Subjek Email
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengumuman Kelulusan Santri Baru - Pondok Pesantren Al-Mardliyyah',
        );
    }

    // 4. Atur file view (blade) mana yang akan dipakai untuk desain emailnya
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