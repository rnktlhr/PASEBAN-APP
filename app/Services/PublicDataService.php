<?php

namespace App\Services;

use App\Models\KegiatanStatistik;
use App\Models\Romantik;
use App\Models\Metadata;

class PublicDataService
{
    /**
     * Menghitung rekapitulasi data Romantik.
     */
    public function getRomantikSummary(int $tahun): array
    {
        $totalKegiatan = KegiatanStatistik::where('tahun', $tahun)->count();
        
        $submittedValues = \App\Enums\StatusDinas::submittedValues();
        
        $disetujui = Romantik::where('tahun', $tahun)->whereIn('status_dinas', $submittedValues)->where('status_bps', \App\Enums\StatusBps::DISETUJUI->value)->count();
        $diperiksa = Romantik::where('tahun', $tahun)->whereIn('status_dinas', $submittedValues)->where('status_bps', \App\Enums\StatusBps::SEDANG_DIPERIKSA->value)->count();
        $perbaikan = Romantik::where('tahun', $tahun)->whereIn('status_dinas', $submittedValues)->where('status_bps', \App\Enums\StatusBps::PERLU_PERBAIKAN->value)->count();
        
        $dalamProses = $diperiksa + $perbaikan;
        $diajukan = Romantik::where('tahun', $tahun)->whereIn('status_dinas', $submittedValues)->count();
        $belumDiajukan = max(0, $totalKegiatan - $diajukan);

        $pctDisetujui = $totalKegiatan > 0 ? round(($disetujui / $totalKegiatan) * 100) : 0;
        $pctDiperiksa = $totalKegiatan > 0 ? round(($diperiksa / $totalKegiatan) * 100) : 0;
        $pctPerbaikan = $totalKegiatan > 0 ? round(($perbaikan / $totalKegiatan) * 100) : 0;
        $pctDalamProses = $totalKegiatan > 0 ? round(($dalamProses / $totalKegiatan) * 100) : 0;
        $pctBelum = $totalKegiatan > 0 ? round(($belumDiajukan / $totalKegiatan) * 100) : 0;
        $pctDiajukan = $totalKegiatan > 0 ? round(($diajukan / $totalKegiatan) * 100) : 0;

        return compact(
            'totalKegiatan', 'disetujui', 'diperiksa', 'perbaikan', 'dalamProses', 'diajukan', 'belumDiajukan',
            'pctDisetujui', 'pctDiperiksa', 'pctPerbaikan', 'pctDalamProses', 'pctBelum', 'pctDiajukan'
        );
    }

    /**
     * Menghitung rekapitulasi data Metadata.
     */
    public function getMetadataSummary(int $tahun): array
    {
        $totalKegiatan = KegiatanStatistik::where('tahun', $tahun)->count();

        // Kegiatan
        $metaKegiatanDone = Metadata::where('tahun', $tahun)->where('jenis', 'kegiatan')
            ->whereIn('status_kominfo', \App\Enums\StatusKominfo::completedValues())->count();
        $metaKegiatanDraft = Metadata::where('tahun', $tahun)->where('jenis', 'kegiatan')
            ->where('status_kominfo', \App\Enums\StatusKominfo::DRAFT->value)->count();
        $metaKegiatanBelum = max(0, $totalKegiatan - $metaKegiatanDone - $metaKegiatanDraft);

        // Variabel
        $metaVariabelDone = Metadata::where('tahun', $tahun)->where('jenis', 'variabel')
            ->whereIn('status_kominfo', \App\Enums\StatusKominfo::completedValues())->count();
        $metaVariabelDraft = Metadata::where('tahun', $tahun)->where('jenis', 'variabel')
            ->where('status_kominfo', \App\Enums\StatusKominfo::DRAFT->value)->count();
        $metaVariabelBelum = max(0, $totalKegiatan - $metaVariabelDone - $metaVariabelDraft);

        // Indikator
        $metaIndikatorDone = Metadata::where('tahun', $tahun)->where('jenis', 'indikator')
            ->whereIn('status_kominfo', \App\Enums\StatusKominfo::completedValues())->count();
        $metaIndikatorDraft = Metadata::where('tahun', $tahun)->where('jenis', 'indikator')
            ->where('status_kominfo', \App\Enums\StatusKominfo::DRAFT->value)->count();
        $metaIndikatorBelum = max(0, $totalKegiatan - $metaIndikatorDone - $metaIndikatorDraft);

        $pctKegiatan = $totalKegiatan > 0 ? round(($metaKegiatanDone / $totalKegiatan) * 100) : 0;
        $pctVariabel = $totalKegiatan > 0 ? round(($metaVariabelDone / $totalKegiatan) * 100) : 0;
        $pctIndikator = $totalKegiatan > 0 ? round(($metaIndikatorDone / $totalKegiatan) * 100) : 0;

        return compact(
            'totalKegiatan', 
            'metaKegiatanDone', 'metaKegiatanDraft', 'metaKegiatanBelum',
            'metaVariabelDone', 'metaVariabelDraft', 'metaVariabelBelum',
            'metaIndikatorDone', 'metaIndikatorDraft', 'metaIndikatorBelum',
            'pctKegiatan', 'pctVariabel', 'pctIndikator'
        );
    }

    /**
     * Menghitung rekapitulasi data Aliran Data.
     */
    public function getAliranDataSummary(int $tahun): array
    {
        $totalData = 0;
        $sudahTayang = 0;
        $belumTayang = max(0, $totalData - $sudahTayang);

        $pctTayang = $totalData > 0 ? round(($sudahTayang / $totalData) * 100) : 0;
        $pctBelum = $totalData > 0 ? round(($belumTayang / $totalData) * 100) : 0;

        return compact(
            'totalData', 'sudahTayang', 'belumTayang', 'pctTayang', 'pctBelum'
        );
    }

    /**
     * Menghitung rekapitulasi presensi kehadiran per Dinas.
     */
    public function getPembinaanRekap($sesiPembinaan, $dinasList): array
    {
        $rekapKehadiran = [];
        foreach ($dinasList as $dinas) {
            $rekapKehadiran[$dinas->id] = [
                'dinas' => $dinas,
                'kehadiran' => [],
                'total' => 0,
            ];
            foreach ($sesiPembinaan as $sesi) {
                // Berkat eager loading with('presensi'), ini tidak akan melakukan kueri ke DB lagi!
                $presensi = $sesi->presensi->where('dinas_id', $dinas->id)->first();
                $hadir = $presensi ? $presensi->hadir : false;
                $rekapKehadiran[$dinas->id]['kehadiran'][$sesi->id] = $hadir;
                if ($hadir) {
                    $rekapKehadiran[$dinas->id]['total']++;
                }
            }
        }

        $totalSesi = $sesiPembinaan->count();
        $totalOPD = $dinasList->count();
        $totalKehadiran = 0;
        foreach ($rekapKehadiran as $rekap) {
            $totalKehadiran += $rekap['total'];
        }
        
        $maxKehadiran = $totalSesi * $totalOPD;
        $persentaseKehadiran = $maxKehadiran > 0 ? round(($totalKehadiran / $maxKehadiran) * 100) : 0;

        return compact(
            'rekapKehadiran', 'totalSesi', 'totalOPD', 'totalKehadiran', 'persentaseKehadiran'
        );
    }
}
