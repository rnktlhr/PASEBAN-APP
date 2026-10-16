<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use App\Enums\StatusBps;
use App\Enums\StatusMonev;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monev extends Model
{
    use LogsActivity;

    protected $table = 'monev';

    protected $fillable = [
        'id_kegiatan',
        'tahun',
        'bulan',
        'status',
    ];

    public function kegiatanStatistik(): BelongsTo
    {
        return $this->belongsTo(KegiatanStatistik::class, 'id_kegiatan');
    }

    /**
     * Romantik terkait, diambil lewat relasi kegiatan (monev tidak menyimpan data romantik).
     * Eager load: 'kegiatanStatistik.romantik'.
     */
    public function getRomantikAttribute(): ?Romantik
    {
        return $this->kegiatanStatistik?->romantik;
    }

    /**
     * Metadata terkait, lewat kegiatan → romantik.
     * Eager load: 'kegiatanStatistik.romantik.metadata'.
     */
    public function getMetadataAttribute(): ?Metadata
    {
        return $this->romantik?->metadata;
    }

    /**
     * Label status_bps romantik/metadata untuk tampilan ('-' jika belum ada).
     */
    public function statusBpsLabel(string $jenis): string
    {
        $record = $jenis === 'metadata' ? $this->metadata : $this->romantik;
        if (!$record) {
            return '-';
        }

        return self::bpsEnum($record->status_bps)?->label() ?? '-';
    }

    /**
     * State jadwal pada bulan monev: 'realisasi', 'rencana', atau null (tidak ada data).
     * - kegiatan : realisasi jika status monev tepat_waktu/terlambat.
     * - romantik/metadata : realisasi jika status_bps disetujui.
     */
    public function jadwalState(string $jenis = 'kegiatan'): ?string
    {
        if ($jenis === 'kegiatan') {
            $status = $this->status instanceof StatusMonev
                ? $this->status
                : StatusMonev::tryFrom((string) $this->status);

            return in_array($status, [StatusMonev::TEPAT_WAKTU, StatusMonev::TERLAMBAT], true)
                ? 'realisasi'
                : 'rencana';
        }

        $record = $jenis === 'metadata' ? $this->metadata : $this->romantik;
        if (!$record) {
            return null;
        }

        return self::bpsEnum($record->status_bps) === StatusBps::DISETUJUI ? 'realisasi' : 'rencana';
    }

    private static function bpsEnum($value): ?StatusBps
    {
        return $value instanceof StatusBps ? $value : StatusBps::tryFrom((string) $value);
    }
}
