@extends('layouts.app')

@section('content')
<div class="container" style="padding: 40px 32px; min-height: calc(100vh - 74px);" x-data="{ search: '' }">
    <div class="flex-col-mobile" style="margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 28px; font-weight: 800; color: var(--navy); margin: 0 0 8px;">Aliran Data {{ $tahun }}</h1>
            <p style="color: var(--muted); font-size: 15px; margin: 0;">Status publikasi data hasil kegiatan statistik pada portal Sedata Sebantul.</p>
        </div>

        <div style="position: relative;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" x-model="search" placeholder="Cari kegiatan, data, atau OPD..." style="padding: 10px 14px 10px 36px; border: 1px solid var(--line); border-radius: 8px; font-size: 13.5px; width: 280px; outline: none; color: var(--ink); background: #fff; box-shadow: var(--shadow-sm); transition: border-color 0.2s, box-shadow 0.2s;" onfocus="this.style.borderColor='var(--orange)'; this.style.boxShadow='0 0 0 3px rgba(235, 137, 27, 0.1)';" onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='var(--shadow-sm)';">
        </div>
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
                <tr style="border-bottom: 1px solid var(--line);" x-show="search === '' || $el.dataset.search.toLowerCase().includes(search.toLowerCase())" data-search="{{ addslashes(strtolower($item->kegiatanStatistik->dinas->singkatan ?? '')) }} {{ addslashes(strtolower($item->kegiatanStatistik->nama)) }} {{ addslashes(strtolower($item->nama_data)) }}">
                    <td style="padding: 16px;">
                        <div style="font-weight: 600; color: var(--navy); margin-bottom: 4px;">{{ $item->kegiatanStatistik->nama }}</div>
                        <div style="font-size: 12px; color: var(--muted);">{{ $item->kegiatanStatistik->dinas->singkatan ?? '-' }}</div>
                    </td>
                    <td style="padding: 16px; color: var(--ink);">{{ $item->nama_data }}</td>
                    <td style="padding: 16px; color: var(--muted);">{{ ucfirst($item->frekuensi) }}</td>
                    <td style="padding: 16px; text-align: center;">
                        @if($item->sudah_tayang)
                            <span style="display: inline-flex; align-items: center; justify-content: center; gap: 4px; width: 100px; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: var(--green); background: #e6f4ea;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Sudah
                            </span>
                        @else
                            <span style="display: inline-block; width: 100px; text-align: center; padding: 4px 0; border-radius: 999px; font-size: 12px; font-weight: 600; color: var(--red); background: rgba(220,53,69,.1);">
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
