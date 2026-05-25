<?php

namespace App\Mail;

use App\Models\Dinas;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MonevReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dinas;
    public $kegiatanList;

    public function __construct(Dinas $dinas, $kegiatanList)
    {
        $this->dinas = $dinas;
        $this->kegiatanList = $kegiatanList;
    }

    public function build()
    {
        return $this->subject('Pengingat Keterlambatan Kegiatan Statistik Sektoral')
                    ->view('emails.monev_reminder');
    }
}
