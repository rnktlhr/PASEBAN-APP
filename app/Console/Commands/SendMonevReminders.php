<?php

namespace App\Console\Commands;

use App\Enums\StatusMonev;
use App\Models\Monev;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\MonevReminderMail;

class SendMonevReminders extends Command
{
    protected $signature = 'monev:remind';
    protected $description = 'Send email reminders to OPDs for late Monev tracking';

    public function handle(): int
    {
        $tahun = (int) date('Y');

        $lateMonevs = Monev::with(['kegiatanStatistik.dinas.users'])
            ->where('tahun', $tahun)
            ->where('status', StatusMonev::TERLAMBAT)
            ->get();

        $dinasGroups = [];
        foreach ($lateMonevs as $monev) {
            $dinas = $monev->kegiatanStatistik?->dinas;
            if ($dinas) {
                if (!isset($dinasGroups[$dinas->id])) {
                    $dinasGroups[$dinas->id] = [
                        'dinas' => $dinas,
                        'kegiatan' => [],
                    ];
                }
                $dinasGroups[$dinas->id]['kegiatan'][] = $monev->kegiatanStatistik;
            }
        }

        $sentCount = 0;
        foreach ($dinasGroups as $group) {
            $dinas = $group['dinas'];
            $kegiatanList = $group['kegiatan'];

            foreach ($dinas->users as $user) {
                if ($user->email) {
                    Mail::to($user->email)->send(new MonevReminderMail($dinas, $kegiatanList));
                    $this->info("Sent reminder to {$user->email}");
                    $sentCount++;
                }
            }
        }

        $this->info("Monev reminders sent successfully. Total: {$sentCount} emails.");

        return self::SUCCESS;
    }
}
