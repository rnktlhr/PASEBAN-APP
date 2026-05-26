@extends('layouts.app')

@section('content')
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);">
    <div style="margin-bottom: 24px;">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Aliran Data {{ $tahun }}</h1>
        <p style="color: var(--muted); font-size: 15px; margin: 0;">Status publikasi data hasil kegiatan statistik pada portal Sedata Sebantul.</p>
    </div>

    <div style="background: #fff; border: 1px solid var(--line); border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);">
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; min-width: 900px;">
                <thead>
                    <tr style="background: var(--navy-50); border-bottom: 1px solid var(--line);">
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 35%;">Kegiatan / OPD</th>
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 30%;">Nama Data</th>
                        <th style="padding: 16px; text-align: left; font-weight: 700; color: var(--navy); width: 15%;">Frekuensi</th>
                        <th style="padding: 16px; text-align: center; font-weight: 700; color: var(--navy); width: 10%;">Status Tayang</th>
                        <th style="padding: 16px; text-align: right; font-weight: 700; color: var(--navy); width: 10%;">Tgl Tayang</th>
                    </tr>
                </thead>
            <tbody>
                @forelse($aliranData as $item)
                <tr style="border-bottom: 1px solid var(--line);">
                    <td style="padding: 16px;">
                        <div style="font-weight: 600; color: var(--navy); margin-bottom: 4px;">{{ $item->kegiatanStatistik->nama }}</div>
                        <div style="font-size: 12px; color: var(--muted);">{{ $item->kegiatanStatistik->dinas->singkatan ?? '-' }}</div>
                    </td>
                    <td style="padding: 16px; color: var(--ink);">{{ $item->nama_data }}</td>
                    <td style="padding: 16px; color: var(--muted);">{{ ucfirst($item->frekuensi) }}</td>
                    <td style="padding: 16px; text-align: center;">
                        @if($item->sudah_tayang)
                            <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; color: var(--green); background: #e6f4ea;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Sudah
                            </span>
                        @else
                            <span style="display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; color: var(--red); background: rgba(220,53,69,.1);">
                                Belum
                            </span>
                        @endif
                    </td>
                    <td style="padding: 16px; text-align: right; color: var(--muted); font-size: 13px;">
                        {{ $item->tanggal_tayang ? \Carbon\Carbon::parse($item->tanggal_tayang)->format('d M Y') : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 32px; text-align: center; color: var(--muted);">Belum ada catatan aliran data untuk tahun ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
