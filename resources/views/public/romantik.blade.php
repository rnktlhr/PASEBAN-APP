@extends('layouts.app')

@section('content')
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);">
    <div style="margin-bottom: 24px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Rekomendasi Statistik (Romantik) {{ $tahun }}</h1>
        <p style="color: var(--muted); font-size: 15px; margin: 0;">Status pengajuan dan persetujuan Romantik (Rekomendasi Kegiatan Statistik).</p>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);">
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; min-width: 900px;">
                <thead>
                    <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 40%;">OPD / Kegiatan</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status Dinas</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status Kominfo</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 20%;">Status BPS</th>
                    </tr>
                </thead>
            <tbody>
                @forelse($romantik as $item)
                <tr style="border-bottom: 1px solid var(--line);">
                    <td style="padding: 16px;">
                        <div style="font-size: 11.5px; font-weight: 700; color: var(--muted); text-transform: uppercase; margin-bottom: 4px;">{{ $item->kegiatanStatistik->dinas->singkatan ?? '-' }}</div>
                        <div style="font-weight: 600; color: var(--navy);">{{ $item->kegiatanStatistik->nama }}</div>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        @php
                            $stDinas = $item->status_dinas instanceof \App\Enums\StatusDinas ? $item->status_dinas : \App\Enums\StatusDinas::tryFrom($item->status_dinas);
                        @endphp
                        <span style="display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; color: {{ $stDinas?->cssColor() ?? 'var(--muted)' }}; background: {{ $stDinas?->cssBgColor() ?? 'var(--line)' }};">
                            {{ $stDinas?->label() ?? ucwords(str_replace('_', ' ', $item->status_dinas)) }}
                        </span>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        @php
                            $stKominfo = $item->status_kominfo instanceof \App\Enums\StatusKominfo ? $item->status_kominfo : \App\Enums\StatusKominfo::tryFrom($item->status_kominfo);
                        @endphp
                        <span style="display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; color: {{ $stKominfo?->cssColor() ?? '#F58220' }}; background: {{ $stKominfo?->cssBgColor() ?? 'rgba(245,130,32,.1)' }};">
                            {{ $stKominfo?->label() ?? ucwords(str_replace('_', ' ', $item->status_kominfo)) }}
                        </span>
                    </td>
                    <td style="padding: 16px; text-align: center;">
                        @php
                            $stBps = $item->status_bps instanceof \App\Enums\StatusBps ? $item->status_bps : \App\Enums\StatusBps::tryFrom($item->status_bps);
                        @endphp
                        <span style="display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; color: {{ $stBps?->cssColor() ?? '#F58220' }}; background: {{ $stBps?->cssBgColor() ?? 'rgba(245,130,32,.1)' }};">
                            {{ $stBps?->label() ?? ucwords(str_replace('_', ' ', $item->status_bps)) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 32px; text-align: center; color: var(--muted);">Belum ada pengajuan Romantik untuk tahun ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
