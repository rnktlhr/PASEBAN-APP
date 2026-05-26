<?php

namespace App\Mail;

use App\Models\Dinas;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonevReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public Dinas $dinas;
    public array $kegiatanList;

    public function __construct(Dinas $dinas, array $kegiatanList)
    {
        $this->dinas = $dinas;
        $this->kegiatanList = $kegiatanList;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengingat Keterlambatan Kegiatan Statistik Sektoral',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.monev_reminder',
        );
    }
}
